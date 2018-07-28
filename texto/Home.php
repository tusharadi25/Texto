<?php
session_start();
if(!isset($_SESSION['uid']))
{echo'<script type="text/javascript">window.location.href="Login.php";</script>';}
?>
<html>
    <head>
        <title>Texto</title>
        <link rel="shortcut icon" href="/texto/images/ic.png" />
        <link rel="stylesheet" href="main.css">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <link href="assets/css/bootstrap.css" rel="stylesheet" />
        <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <link href="assets/css/style.css" rel="stylesheet" />
    </head>
    <body>
        <?php
            $host="localhost";
            $username="root";
            $password="";
            $db_name="texto";
            $login=false;
            $conn=mysqli_connect($host,$username,$password,$db_name);
        ?>
        <div class="container">
            <div class="row pad-top pad-bottom">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="chat-box-online-div" id="vh">
                        <div class="chat-box-online-head">
                                ONLINE USERS 
                        </div>
                        <div class="panel-body chat-box-online">
                            <?php
                                $sql="SELECT * from info";
                                $result = mysqli_query($conn, $sql);
                                while($row = mysqli_fetch_assoc($result)) {
                                    $sql='SELECT last_log_in from Logn where email="'.$row['Email'].'"';
                                    $res = mysqli_query($conn, $sql);
                                    echo'<div class="chat-box-online-left">
                                    <img src="'.$row["dp"].'" alt="bootstrap Chat box user image" class="img-circle" />'.$row["Fullname"].'
                                    <br /> ( <small>Active At '.$row['reg_date'].' </small> )</div><hr class="hr-clas-low" />';
                                }
                            ?>
                        </div>
                    </div>
                </div>                
            <div class=" col-lg-6 col-md-6 col-sm-6" id="frm">
                <div class="chat-box-div">
                    <div class="chat-box-head">
                        GROUP CHAT HISTORY
                        <div class="btn-group pull-right">
                            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <span class="fa fa-cogs"></span>
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#"><span class="fa fa-map-marker"></span>&nbsp;Invisible</a></li>
                                <li><a href="#"><span class="fa fa-comments-o"></span>&nbsp;Online</a></li>
                                <li><a href="#"><span class="fa fa-lock"></span>&nbsp;Busy</a></li>
                                <li class="divider"></li>
                                <li><a href="end.php"><span class="fa fa-circle-o-notch"></span>&nbsp;Logout</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="panel-body chat-box-main">











                    </div>
                    <div class="chat-box-footer">
                        <div class="input-group">
                            <form nane="chat" action="ab.php" method="post">
                                <table>
                                    <tr>
                                    <td width="490px"><input type="text" placeholder="Enter Text Here..." required="required"/></td>
                                    <td>&nbsp;</td>
                                    <td>   <button class="btn btn-info" type="Submit">SEND</button>
                                    </td>
                                    </tr>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery-1.11.1.js"></script>
    <script src="assets/js/bootstrap.js"></script>
<?php
mysqli_close($conn);
?>
</body>
</html>   
       