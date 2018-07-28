<html>
    <head>
        <title>Sign Up</title>
        <link rel="shortcut icon" href="/texto/images/ic.png" />
        <link rel="stylesheet" href="style2.css">
        <script src="/texto/scr1.js"></script>
        
    </head>
    <body>
          <?php
            $host="localhost";
            $username="root";
            $password="";
            $db_name="texto";
            $conn=mysqli_connect($host,$username,$password,$db_name);
            $ok=false;
            ?>

        <div id="frm">
            <form name="signup" method="post" action="signup.php" onsubmit="return validateform();">
                <table cellpadding="1px" >
                    <tr>  
                        <td><a href="/texto/index.html"><img src="/texto/images/icw.png" alt="logo" height="50" width="50"/></a></td>
                        <td><font face="Calibri" size="8px" color="white">Sign Up</font></td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                            <td colspan="2"><input type="text" name="Name" id="U" placeholder="Full Name" required="required"/></td></tr>
                    <tr>    
                            <td colspan="2"><input type="date" name="DOB" required="required" /></td></tr>
                    <tr>
                        <td><input type="radio" name="gender" value="male" ><font face="sans-serif" size="4px" color="white"> Male</td>
                        <td><input type="radio" name="gender" value="female"><font face="sans-serif" size="4px" color="white"> Female</td>
                        <td><input type="radio" name="gender" value="other" checked ><font face="sans-serif" size="4px" color="white" > Other</td>
                    <tr>      
                        <td colspan="2"><input type="text" name="email" id="U" placeholder="Email Id" required="required"/></td>
                                            <?php
                        if(isset($_POST['signup'])){
                            $e=$_POST['email'];
                            $flag=false;
                            $sql="SELECT email, password FROM login where email='$e'";
                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                echo'</tr><tr><td colspan="3"><font face="Calibri" size="4px" color="RED">Email-id is already registered!</td>';                         }
                            else{
                                $ok=true;
                            }
                        }
                    ?></tr>
                    <tr>
                         <td colspan="2"><input type="password" name="pwd1" id="P" placeholder="Password" required="required"/></td>
                    </tr>
                     <tr>
                        <td colspan="2"><input type="password" name="pwd2" id="P" placeholder="Password Again" required="required"/></td>
                    </tr>
                    <tr>    
                        <td colspan="2"><input type="checkbox" name="check" required="required"/>
                        <font face="sans-serif" size="3px" color="white">I agree to <a href="/texto/terms.html">Texto terms.</a></font></td></tr>
                </table>
                <input type="submit" name="signup" value="SignUp"/>
            </form>
        </div>
        <?php
        if($ok){
          $n=$_POST['Name'];
          $d=$_POST['DOB'];
          $g=$_POST['gender'];
          $e=$_POST['email'];
          $p=$_POST['pwd1'];
          $p=md5($p);
          $sql  = "INSERT INTO info ( Fullname, email, DOB, gender ) values ('$n','$e','$d','$g');";
          $sql .= "INSERT INto Login( email, password, verified) values ('$e','$p',0)";

          if(mysqli_multi_query($conn, $sql)){
                $sql = "SELECT id FROM Info where email='$e'";
                $result = mysqli_query($conn, $sql);
                while($row = mysqli_fetch_assoc($result)){
                $id=$row['id'];
                $sql= "CREATE TABLE Inbox'.$id.'( sender_id INT(6) not null,
                msg varchar(100) not null,
                sent TIMESTAMP DEFAULT CURRENT_TIMESTAMP  PRIMARY KEY)";  
                if (mysqli_query($conn, $sql)) {
                    echo'<script type="text/javascript">window.location.href="login.php";</script>';
                }
                }
        }
           mysqli_close($conn);
        }
        ?>     
    </body>
</html>