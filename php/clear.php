<?php
require_once "db_connect.php";
require_once "functions.php";

if (isset($_GET['clear'])) {
    queryMysql("DROP TABLE WALL");
    die("The ImgWall has been cleared of all images. <a href='../form.php'> Click here</a> to return to the upload screen.");
}
?>

<a href="?clear">Clear all images</a>

<?php $db->close(); ?>