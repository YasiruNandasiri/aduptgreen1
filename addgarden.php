<?php
include_once('lib/DB_connection.php');

$conn = OpenCon();

if (isset($_POST['add'])) {

    $title = $_POST['title'];
    $crop = $_POST['plant'];

    if ($title === '' || $title == null) {
        echo '<script>alert(\'Title cannot be empty\');</script>';
    } else {
        $query = $conn->query("INSERT INTO `garden` VALUES  (NULL ,'$title','$crop','$userid');");

        if ($query !== true) {
            die("Error while executing query!");
        }
    }
}

if (isset($_POST['delete'])) {
    $id = $_POST['id'];

    $query = $conn->query("DELETE FROM `garden` WHERE `gardenID`=$id");

    if ($query !== true) {
        die("Error while executing query!");
    }
}


$result = $conn->query("SELECT * FROM `crop`");

$result2 = $conn->query("SELECT * FROM `garden` where `userID`=$userid;");

if (!$result || !$result2) {
    die("Error while executing query!");
}
?>


<div>
<h2>Create your gardens:</h2>

<div id="myDIV">
    <form method="post">
        <input type="text" name="title" id="myInput" placeholder="Title...">
        <select name="plant">
            <?php
            while ($rows = $result->fetch_assoc()) {
                echo '<option value="' . $rows['cropID'] . '">' . $rows['cropName'] . '</option>';
            }
            ?>
        </select>

        <button type="submit" name="add" class="addBtn">Add</button>
    </form>
</div>

<table class="table">
    <?php
    while ($rows = $result2->fetch_assoc()) {
        echo '<tr>
        <form method="post">
          <input type="hidden" name="id" value="' . $rows['gardenID'] . '" />
          <td><a href="/user-registration/garden.php?gardenID=' . $rows['gardenID'] . '& userName='.  $username .'& userID='.  $userid .'" class="crop-link">' . $rows['gardenName'] . '</a></td>
          <td style="width:calc(1.5rem + 20px);">
            <button type="submit" name="delete" class="btn-delete">X</button>
          </td>
        </form>
      </tr>';
    }
    ?>
</table>


</div>


<?php CloseCon($conn); ?>