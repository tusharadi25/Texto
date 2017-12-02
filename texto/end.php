<?php
session_start();
date_default_timezone_set("Asia/Kolkata");
$time=date("Y-d-m h:i:s");
    $host="localhost";
    $username="root";
    $password="";
    $db_name="texto";
    $login=false;
    $conn=mysqli_connect($host,$username,$password,$db_name);
            $id=$_SESSION['uid'];
            $sql = "SELECT email FROM Info where id='$id'";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                $e=$row['email'];
                
$sql = "UPDATE Login SET last_log_out='$time' WHERE email='$e'";
mysqli_query($conn, $sql);            
session_destroy();
mysqli_close($conn);
echo'<script type="text/javascript">window.location.href="Login.php";</script>';
?>
