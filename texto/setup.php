<html>
	<head>
  	<title>Texto setup page</title>
	  	<link rel="shortcut icon" href="/texto/images/ic.png" />
	</head>
		<body>
  <?php
$host="localhost";
$username="root";
$password="";
$db_name="texto";
$ok=true;
$conn=mysqli_connect($host,$username,$password);

// Check connection
if (!$conn) {
	$ok=false;
	die('Connection <img src="/texto/images/no.png" alt="no" height="15" width="15"/>');
}else echo 'Connection <img src="/texto/images/yes.png" alt="yes" height="15" width="15"/>';

// Create database
$sql = "CREATE DATABASE $db_name";
if (mysqli_query($conn, $sql)) {
	echo '<br>Database <img src="/texto/images/yes.png" alt="yes" height="15" width="15"/>';
} else {
	$ok=false;
	echo '<br>Error creating database: '.mysqli_error($conn);
}

mysqli_select_db($conn,$db_name) or die("Cannot Select DB");

// sql to create table
$sql = "CREATE TABLE Info(
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
Fullname VARCHAR(30) NOT NULL,
Email VARCHAR(50) NOT null  ,
DOB date ,
Gender varchar(10),
dp varchar(30) DEFAULT '/texto/images/default.png',
reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP)";

if (mysqli_query($conn, $sql)) {
	echo '<br>Info <img src="/texto/images/yes.png" alt="yes" height="15" width="15"/> ';
} else {    $ok= false;
	echo "Error creating table: " . mysqli_error($conn);
}

$sql = "CREATE TABLE Login (
email VARCHAR(50) Not null PRIMARY KEY,
password varchar(100) not null,
verified boolean,
last_log_in TIMESTAMP NULL ,
last_log_out Timestamp null )";

if (mysqli_query($conn, $sql)) {
	echo '<br>Login <img src="/texto/images/yes.png" alt="yes" height="15" width="15"/> ';
} else {    $ok =false;
	echo "Error creating table: " . mysqli_error($conn);
}


$sql = "ALTER TABLE info ADD UNIQUE('Email')";
mysqli_query($conn, $sql);


//Inserting Admin
$pass=md5("TextoAdmin");
$sql = "INSERT INTO Info (Fullname, Email) VALUES ('Admin', 'admin@texto.com');";
$sql .= "INSERT INTO Login (email, password, verified ) VALUES ('admin@texto.com','$pass', 1 )";
if(mysqli_multi_query($conn, $sql)){
	echo '<br>Admin <img src="/texto/images/yes.png" alt="yes" height="15" width="15"/> ';
} else { $ok=false;
	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
if(!$ok)
{  echo '<br>Check settings';
}else echo'<br><br><font face="Calibri" size="8px">Setup</font> <img src="/texto/images/yes.png" alt="yes" height="50" width="50"/>';
?>
</body>

</html>