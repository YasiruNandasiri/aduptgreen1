<?php
include_once('lib/DB_connection.php');

$gardenID = $_GET['gardenID'];
$username = $_GET['userName'];
$userID = $_GET['userID'];
$conn = OpenCon();
function callhead($username) {
    include_once __DIR__ .'/Header.php';
}


$result = $conn->query("SELECT * FROM `garden` WHERE `gardenID`=$gardenID;");

if(!$result){
    die("Error while executing query!");
}

$row = $result->fetch_assoc();
$cropID= $row['cropID'];
$result1 = $conn->query("SELECT * FROM `crop` WHERE `cropID`=$cropID;");

if(!$result1){
    die("Error while executing query!");
}

$row1 = $result1->fetch_assoc();

$result2 = $conn->query("SELECT * FROM `data` WHERE `gardenID`=$gardenID AND`userID`=$userID ORDER BY `ID` DESC LIMIT 1;");

if(!$result2){
    die("Error while executing query!");
}

$row2 = $result2->fetch_assoc();

?>


<HTML>
<?php callhead($username);?>




<div class="header">
    <h1><?php echo $row['gardenName']; ?></h1>

</div>
<br>
<br>

<h3>Here are the recommended environmental states and current states for <?php echo $row1['cropName']; ?></h3>
<table class="table">
    <tr>
        <td></td>
        <td>Recommended State</td>
        <td>Current State</td>
    </tr>
    <tr>
        <td>Temperature (&deg;C)</td>
        <td><?php echo " $row1[temp_L] to $row1[temp_H]"; ?></td>
        <td><?php echo " $row2[temp]"; ?></td>
    </tr>
    <tr>
        <td>Humidity (%)</td>
        <td><?php echo " $row1[humidity_L] to $row1[humidity_H]"; ?></td>
        <td><?php echo " $row2[humidity]"; ?></td>
    </tr>
    <tr>
        <td>Soil moisture (%)</td>
        <td><?php echo " $row1[moist_L] to $row1[moist_H]"; ?></td>
        <td><?php echo " $row2[moist]"; ?></td>
    </tr>
    <tr>
        <td>NPK Level (unit)</td>
        <td><?php echo " $row1[NPK_L] to $row1[NPK_H]"; ?></td>
        <td><?php echo " $row2[NPK]"; ?></td>
    </tr>

</table>
<table class="table">
    <tr>
        <td>Control device</td>
        <td>State</td>
        <td></td>
    </tr>
    <tr>
        <td>Exhaust Fan</td>
        <td><?php if((int)$row2[temp] > (int)$row1[temp_H] && (int)$row2[humidity] > (int)$row1[humidity_H]){
            echo"ON";}
            else{
                echo"OFF";
            }

        ?></td>
        <td></td>
    </tr>
    <tr>
        <td>Heater</td>
        <td><?php if((int)$row2[temp] < (int)$row1[temp_L]){
                echo"ON";}
            else{
                echo"OFF";
            }

            ?></td>
        <td></td>
    </tr>
    <tr>
        <td>Foggers</td>
        <td><?php if((int)$row2[humidity] < (int)$row1[humidity_L]){
                echo"ON";}
            else{
                echo"OFF";
            }

            ?></td>
        <td></td>
    </tr>
    <tr>
        <td>water showers</td>
        <td><?php if((int)$row2[moist] < (int)$row1[moist_L]){
                echo"ON";}
            else{
                echo"OFF";
            }

            ?></td>
        <td></td>
    </tr>

</table>

<div>
    <a href="home.php"><button class=" back">BACK TO HOME</button></a>
</div>


</div>

</BODY>
</HTML>
