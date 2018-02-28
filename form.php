<?php
require_once "php/db_connect.php";
require_once "php/functions.php";


//queryMysql("DROP TABLE WALL");
createTable("WALL",
            "USER_USERNAME VARCHAR(20) NOT NULL,
            STATUS_TITLE VARCHAR(20) NOT NULL,
            STATUS_TEXT VARCHAR(140) NOT NULL,
            IMAGE_NAME VARCHAR(50) NOT NULL,
            TIME_STAMP VARCHAR(50) NOT NULL,
            IMAGE_FILTER VARCHAR(20) NOT NULL,
            PRIMARY KEY (TIME_STAMP)");

if (!$loggedin) {
    header("Location: index.php");
}

$error = "Welcome to ImgWall!";

if(isset($_POST['name']) && isset($_POST['title']) && isset($_POST['text']))
{    
    $name = sanitizeString($db, $_POST['name']);
    $title = sanitizeString($db, $_POST['title']);
    $text = sanitizeString($db, $_POST['text']);
    $filter = $_POST['filter'];

    $time = $_SERVER['REQUEST_TIME'];
    $file_name = $time . '.jpg';

    if ($_FILES)
    {
        $tmp_name = $_FILES['upload']['name'];
        $dstFolder = 'users';
        move_uploaded_file($_FILES['upload']['tmp_name'], $dstFolder . DIRECTORY_SEPARATOR . $file_name);
        $error = "Image upload successful!";
    }

    SavePostToDB($db, $name, $title, $text, $time, $file_name, $filter);
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
    
    <body onload="initialize();">
        <div class="container">    
            <div class="row">
                <div id="formParent" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                    <div class="panel panel-info">

                        <div class="panel-heading">
                            <div class="panel-title">Upload Image</div>
                        </div> 
                        
                        <div style="padding-top:30px" class="panel-body">
                            
                            <p><?php echo $error?></p><br>
                            
                            <form id="form" class="form-horizontal" method="POST" action="form.php" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="name" class="control-label col-xs-1">Name</label>
                                    <div class="col-xs-11">
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-user fa-fw"></span></span>
                                            <input type="text" class="form-control" id="name" name="name" 
                                                   maxlength="20" size="20" value="<?php echo $user?>" required autofocus>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="title" class="control-label col-xs-1">Title</label>
                                    <div class="col-xs-11">
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-header fa-fw"></span></span>
                                            <input type="text" class="form-control" id="title" name="title" 
                                                   maxlength="20" size="20" value="" required placeholder="title your picture" autofocus>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="text" class="control-label col-xs-1">Text</label>
                                    <div class="col-xs-11">
                                        <textarea class="form-control" id="text" name="text" maxlength="140" placeholder="describe your picture" required></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="sr-only" for="image">Original Image</label>
                                    <img id="image" name="image" src="/" width="100%">
                                    <input type="file" id="upload" name="upload" accept="image/*">
                                </div>

                                <div class="form-group">
                                    <h3>Filter Photo</h3>
                                    <div class="checkbox-inline">
                                        <label for="myNostalgia">My Nostalgia</label>
                                        <input type="radio" name="filter" id="myNostalgia" value="myNostalgia" onclick="applyMyNostalgiaFilter();">
                                    </div>
                                    <div class="checkbox-inline">
                                        <label for="grayscale">Grayscale</label>
                                        <input type="radio" name="filter" id="grayscale" value="grayscale" onclick="applyGrayscaleFilter();">
                                    </div>
                                    <div class="checkbox-inline">
                                        <label for="original">Original</label>
                                        <input type="radio" name="filter" id="lomo" value="lomo" onclick="revertToOriginal();" checked="checked">
                                    </div>
                                </div>                

                                <input type="submit" value="Upload image" class="btn btn-success col-md-offset-1">
                                <input type="button" id="resetForm" value="Reset form" class="btn btn-default">
                                <a href="wall.php" class="btn btn-default" role="button">View the ImgWall</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- JavaScript placed at bottom for faster page loadtimes. -->
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

        <!-- Latest compiled and minified JavaScript -->
        <script src="js/bootstrap.min.js"></script>

        <script src="js/functions.js"></script>

    </body>
</html>
<?php $db->close(); ?>