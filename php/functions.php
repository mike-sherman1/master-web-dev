<?php
function sanitizeString($_db, $str)
{
    $str = strip_tags($str);
    $str = htmlentities($str);
    $str = stripslashes($str);
    return mysqli_real_escape_string($_db, $str);
}

function createTable($name, $query)
{
    queryMysql("CREATE TABLE IF NOT EXISTS $name($query)");
}

function queryMysql($query)
{
    global $db;
    $result = $db->query($query);
    if (!$result) die($db->error);
    return $result;
}

function destroySession()
{
    $_SESSION=array();

    if (session_id() != "" || isset($_COOKIE[session_name()]))
        setcookie(session_name(), '', time()-2592000, '/');

    session_destroy();
}

function SavePostToDB($_db, $_user, $_title, $_text, $_time, $_file_name, $_filter)
{
    queryMysql("INSERT INTO WALL(USER_USERNAME, STATUS_TITLE, STATUS_TEXT, TIME_STAMP, IMAGE_NAME, IMAGE_FILTER) VALUES ('$_user', '$_title', '$_text', '$_time', '$_file_name', '$_filter')");
}

function getPostcards($_db)
{
    $query = "SELECT USER_USERNAME, STATUS_TITLE, STATUS_TEXT, TIME_STAMP, IMAGE_NAME, IMAGE_FILTER FROM WALL ORDER BY TIME_STAMP DESC";
    
    if(!$result = $_db->query($query))
    {
        die('There was an error running the query [' . $_db->error . ']');
    }
    
    $output = '';
    while($row = $result->fetch_assoc())
    {
        $output = $output . '<div class="panel panel-info"><div class="panel-heading">"' . $row['STATUS_TITLE']
        . '" posted by ' . $row['USER_USERNAME'] 
        . '</div><div class="body"><img src="users/' . $row['IMAGE_NAME'] . '" width="300px" class="' . $row['IMAGE_FILTER'] . '"><br>' . $row['STATUS_TEXT'] . '</div></div>' ;
    }
    
    return $output;
}

?>