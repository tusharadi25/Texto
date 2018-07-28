<?php
session_start();
?>
<html>
    <head>
        <title>Login</title>
        <link rel="shortcut icon" href="/texto/images/ic.png" />
        <link rel="stylesheet" href="/texto/style.css">
        <script src="/texto/scr.js"></script>
        <script src="https://apis.google.com/js/platform.js" async defer></script>
        <meta name="google-signin-client_id" content="524501687893-utarjbqokomaf7svmqhu842q4ugpkb8u.apps.googleusercontent.com">    </head>
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
        <div id="frm">
            <form name="Login" method="post" action="Login.php" onsubmit="return validateform();">
            <table cellpadding="1px" >
                <tr>  
                    <td><a href="/texto/index.html"><img src="/texto/images/icw.png" alt="logo" height="50" width="50"/></a></td>
                    <td><font face="Calibri" size="8px" color="white">Login</font></td>
                    <td></td>
                <tr>  
                    <td colspan="3"><input type="text" name="email" id="U" placeholder="Email Id" required="required"/></td>
                    <?php
                        if(isset($_POST['Login'])){
                            $e=$_POST['email'];
                            $flag=false;
                            $sql="SELECT email, password FROM login where email='$e'";
                            if($result = mysqli_query($conn, $sql)){
                                if (mysqli_num_rows($result) >0) {
                                $row = mysqli_fetch_assoc($result);
                                $p=$row['password'];
                                $flag=true;
                             }else 
                             {     echo'</tr><tr><td colspan="2"><font face="Calibri" size="4px" color="RED">Invalid Email-id !</td>';                         }
                             }else 
                             {     echo'</tr><tr><td colspan="2"><font face="Calibri" size="4px" color="RED">Invalid Email-id !</td>';                         }
        
                        }
                    ?>
                </tr><tr>
                    <td colspan="3"><input type="password" name="passwd" id="P" placeholder="Password" required="required"/></td>
                    <?php
                        if(isset($_POST['Login'])&&$flag){
                            $p0=$_POST['passwd'];
                            $p0=md5($p0);
                            if($p==$p0){
                                $login=true;
                            }else{
                                echo '</tr><tr><td colspan="2"><font face="Calibri" size="4px" color="RED">Wrong Password !</td>';
                            }
                        }
                    ?>
                </tr>
                <tr><td colspan="2"><input type="checkbox" name="check"  style="border:2px;">
                    <font face="sans-serif" size="4px" color="white">Keep me login.</font></td></tr>
                <tr>
                    <td colspan="2"><input type="submit" name="Login" value="Login"/></form></td>
                    <td><div class="g-signin2" data-onsuccess="onSignIn"></div></td>    
                </tr>
            </table>
        </div>

        <?php
        if($login){
            date_default_timezone_set("Asia/Kolkata");
            $time=date("Y-d-m h:i:s");
            $sql = "UPDATE Login SET last_log_in='$time' WHERE email='$e'";
            if (mysqli_query($conn, $sql)) {
                $sql = "SELECT id, Fullname FROM Info where email='$e'";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                $_SESSION["uid"]=$row['id'];
                $_SESSION["name"]=$row['Fullname']; 
                mysqli_close($conn);               
                echo'<script type="text/javascript">window.location.href="Home.php";</script>';
            } 
          }
        ?>
</body>
</html>