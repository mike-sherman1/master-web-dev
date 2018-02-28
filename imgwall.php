<?php
require_once 'php/db_connect.php';
require_once 'php/functions.php';

//queryMysql("DROP TABLE users");
createTable('users',
            'userid VARCHAR(16),
              password VARCHAR(32),
              INDEX(userid(6))');

if($loggedin) {
    $error = "<span class='error'>You are already logged in as $user. <a href='wall.php'>Click here</a> to go to the ImgWall.</span><br><br>";
}
else {
    $user = "";
    $error = "Welcome to ImgWall!<br><br>";
}

$pass = "";

if (isset($_POST['user']))
{
    $user = sanitizeString($db, $_POST['user']);
    $pass = sanitizeString($db, $_POST['pass']);

    if ($user == "" || $pass == "")
        $error = "<span class='error'>Must enter both username and password</span><br><br>";
    else
    {
        $result = queryMysql("SELECT * FROM users WHERE userid='$user'");
        if ($result->num_rows)
        {
            $row = $result->fetch_array(MYSQLI_NUM);
            $result->close();
            $salt1 = "f:4H1";
            $salt2 = "*^v1w";
            $token = hash('ripemd128', "$salt1$pass$salt2");

            if ($token == $row[1]) 
            {
                $error = "<span class='error'>Login successful!<a href='form.php'> Click here</a> to start sharing your pictures.</span><br><br>";
                $_SESSION['user'] = $user;
                $_SESSION['pass'] = $token;
            }
            else//invalid 
            {
                $error = "<span class='error'>Username or password invalid</span><br><br>";
            }
        }
        else//invalid
        {
            $error = "<span class='error'>Username or password invalid</span><br><br>";
        }
    }
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
            <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <div class="panel-title">Log In</div>
                    </div>     

                    <div style="padding-top:30px" class="panel-body">

                        <form class="form-horizontal" role="form" method="post" action="index.php"><?php echo $error?>

                            <div style="margin-bottom: 25px" class="input-group">
                                <span class="input-group-addon"><span class="fa fa-user fa-fw"></span></span>
                                <input type="text" class="form-control" name="user" value="<?php echo $user?>" placeholder="username" maxlength="16">
                            </div>

                            <div style="margin-bottom: 25px" class="input-group">
                                <span class="input-group-addon"><span class="fa fa-lock fa-fw"></span></span>
                                <input type="password" class="form-control" name="pass" value="<?php echo $pass?>" placeholder="password" maxlength="16">
                            </div>

                            <div style="margin-top:10px" class="form-group">
                                <!-- Button -->
                                <div class="col-sm-12 controls">
                                    <input class="btn btn-success" type="submit" value="Log In" />
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12 control">
                                    <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                                        Don't have an account?
                                        <a href="php/signup.php">
                                            Sign Up Here
                                        </a>
                                    </div>
                                </div>
                            </div>    
                        </form>     
                    </div>                     
                </div>  
            </div>
        </div>

        <!-- JavaScript placed at bottom for faster page loadtimes. -->
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>

        <!-- Latest compiled and minified JavaScript -->
        <script src="js/bootstrap.min.js"></script>

        <script src="js/functions.js"></script>

    </body>
</html>
<?php $db->close(); ?>