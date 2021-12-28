<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Home</title>
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
      <li class="inline active"><a href="index.php">Home</a></li>
      <li class="inline "><a href="about.php" >About</a></li>
	  <li class="inline"><a href="share.php" >Share File</a></li>
	  <?php 
			if(isset($_SESSION["username"]) && !empty($_SESSION["username"]))
			{	
				echo '<li class="inline" style="float:right"><a href="logout.php">Logout</a></li>';
			}
			else
			{
				echo '<li class="inline"><a href="register.php">Register</a></li>';
				echo '<li class="inline" style="float:right"><a href="login.php">Login</a></li>';
			}
		?>
    </ul>
  </div>
	
</div>

    <div style="width:60%;margin:auto;margin-top:2%">
		<h1 style="color:white">Proposed System:</h1>
		<img src="ftp.webp">
		<p>	 </p>
	</div>
</body>
</html>
