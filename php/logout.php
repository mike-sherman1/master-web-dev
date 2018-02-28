<?php
require_once 'db_connect.php';
require_once 'functions.php';

if (isset($_SESSION['user']))
{
    destroySession();
    echo "<div class='main'>You have been logged out. Please " .
        "<a href='../index.php'>click here</a> to return to the login screen.";
}
else echo "<div class='main'><br>" .
    "You cannot log out because you are not logged in!";
?>

<?php $db->close(); ?>
