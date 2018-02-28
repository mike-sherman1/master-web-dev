<?php
require_once "php/db_connect.php";
require_once "php/functions.php";

if (!$loggedin) {
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>ImgWall</title>

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="css/bootstrap.min.css">

        <!-- Custom styles -->
        <link rel="stylesheet" href="css/styles.css">

        <link href="http://netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    </head>

    <body>
        <div class="container">
            <div class="header" style="margin:15px 0px">
                <a href="form.php" class="btn btn-success" role="button">Upload an image</a>
                <a href="php/logout.php" class="btn btn-default" role="button">Log out</a>
                <a href="php/clear.php" class="btn btn-default" role="button">Admin tools</a>
            </div>
            <?php echo getPostcards($db); ?>
        </div>
    </body>
</html>

<?php $db->close(); ?>
