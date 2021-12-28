<?php
	session_start();
	if(!isset($_SESSION["username"]) && !isset($_SESSION["username"]))
	{
		$_SESSION["resturi"]=$_SERVER["REQUEST_URI"];
		die(header('Location: login.php'));
	}
	else
	{
		$_SESSION["resturi"]="";
	}
	require("database.php");
	$out="";
	$error= "";
	if(isset($_POST["send"]))
	{
		if(is_uploaded_file($_FILES['Filedata']['tmp_name']))
		{
			if(isset($_POST["share_with"]))
			{
				$share_with=implode(",",$_POST["share_with"]);
			}
			$ftp_host=$_POST["ipaddress"];
			$ftp_user_name=$_POST["username"];
			$ftp_user_pass=$_POST["password"];
			$destination=$_POST["destination"];
			$file_ext=pathinfo($_FILES['Filedata']['name'], PATHINFO_EXTENSION);
			$basefile=basename($_FILES['Filedata']['name'],".".$file_ext);
				$filename=$basefile.uniqid().".".$file_ext;
				$local_file   = $_FILES['Filedata']['tmp_name'];
				$remote_file = $destination.$filename;
				/* Connect using basic FTP */
				$connect_it = ftp_connect( $ftp_host );

				/* Login to FTP */
				$login_result = ftp_login( $connect_it, $ftp_user_name, $ftp_user_pass );
				
				/* Send $local_file to FTP */
				if ( ftp_put( $connect_it, $remote_file, $local_file, FTP_BINARY ) ) {
					$error= "<h1 style='text-align:center; color:red'>Wow! Successfully transfered</h5>\n";
				}
				else {
					$error=  "<h1 > There was a problem\n</h1>";
				}

				/* Close the connection */
				ftp_close( $connect_it );
		}
		else
		{
			$out="*Please give all inputs";
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Share File</title>
	<link rel="stylesheet" href="style.css">
</head>
<body style="min-height:600px">
<div class="menu">
	<ul>
		<li class="center"><h1 style='color:white;padding-left:10px' class="center">NETWORK FILE TRANSFER PROTOCOL</h1></li>
	</ul>
	<div class="menu" style="margin-top:10px">
     <ul >
	<?php
	if(isset($_SESSION["username"]) && !empty($_SESSION["username"]))
	{
		echo '<li class="inline">Logined as : <span style="color:brown">'.$_SESSION["username"].'</span></li>';
	}
	?>
      <li class="inline"><a href="index.php">Home</a></li>
      <li class="inline"><a href="about.php" >About</a></li>
	  <li class="inline active"><a href="share.php" >Share File</a></li>
	  <?php 
			if(isset($_SESSION["username"]) && !empty($_SESSION["username"]))
			{	
				echo '<li class="inline" style="float:right"><a href="logout.php">Logout</a></li>';
			}
			else
			{
				echo '<li class=" inline"><a href="register.php">Register</a></li>';
				echo '<li class="inline" style="float:right"><a href="login.php">Login</a></li>';
			}
		?>
    </ul>
  </div>
</div>
    <div style="width:60%;margin:auto;margin-top:2%" class="background">
		<?=$error;?>
		<h1>Share files Server to server using File Transfer Protocol</h1>
		<form action = "<?php echo $_SERVER["REQUEST_URI"]; ?>" method="POST" enctype="multipart/form-data">
		<h4 style="text-align:center;">You are logined as <?=$_SESSION["username"]?></h4>
		Browse File<input type="file" name="Filedata">
		<label for="key"><h5>Enter IP Address</h5></label>
		<input type="text" name="ipaddress" id="ipaddress" placeholder="Enter ip address" required>
		<label for="username"><h5>Enter FTP user name</h5></label>
		<input type="text" name="username" id="username" placeholder="Enter User name" required>
		<label for="password"><h5>FTP Password</h5></label>
		<input type="text" name="password" id="password" placeholder="Enter Password" required>
		<label for="destination"><h5>Destination Path ( From server root path )</h5></label>
		<input type="text" name="destination" id="destination" placeholder="Enter destination path" required>
		<input type="submit" name="send" value="upload">
	</form>
	</div>

<script>
	function makeid() {
	var length=6;
   var result           = '';
   var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
   var charactersLength = characters.length;
   for ( var i = 0; i < length; i++ ) {
      result += characters.charAt(Math.floor(Math.random() * charactersLength));
   }
   document.getElementById("key").value=result;
}

</script>

</body>
</html>
