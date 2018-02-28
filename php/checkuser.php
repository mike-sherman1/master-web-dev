<?php
require_once 'db_connect.php';
require_once 'functions.php';

if(!empty($_POST["user"])) {
    $user   = sanitizeString($db, $_POST['user']);
    $result = queryMysql("SELECT * FROM users WHERE userid='$user'");

    if($result->num_rows) {
        echo "<span class='status-not-available'> Username Not Available.</span>";
    }else{
        echo "<span class='status-available'> Username Available.</span>";
    }
}

?>