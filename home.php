<?php
session_start();
if (isset($_SESSION["username"])) {
    $username = $_SESSION["username"];
    $userid = $_SESSION["id"]; //grabbing id of the user

    session_write_close();
} else {
    // since the username is not set in session, the user is not-logged-in
    // he is trying to access this page unauthorized
    // so let's clear all session variables and redirect him to index -- require_once __DIR__ .'/Header.php';   include_once __DIR__ .'/addgarden.php';
    session_unset();
    session_write_close();
    $url = "./index.php";
    header("Location: $url");
}

function callhead($username) {
    include_once __DIR__ .'/Header.php';
}
function calladdgarden($userid,$username) {
    include_once __DIR__ .'/addgarden.php';
}


?>
<HTML>

<?php callhead($username);?>
<?php calladdgarden($userid,$username);?>
</div>

</BODY>
</HTML>
