<?php
	session_start();
	if(isset($_SESSION["username"]) && !empty($_SESSION["username"]))
	{
		header("Location: index.php");
	}
	require("database.php"); 
	$error="";
	if(isset($_POST["login"]))
	{
		$username=test_data($_POST["username"]);
		$password=$_POST["password"];
		$mobile=$_POST["mobile"];
		$email=$_POST["email"];
		$address=$_POST["address"];
		if(!empty($username) && !empty($password) && !empty($mobile) && !empty($email) && !empty($address))
		{
			$sql="INSERT into user(`username`,`password`,`mobile`,`email`,`address`)VALUES('$username','$password','$mobile','$email','$address') ";
			if($conn->query($sql))
			{
				$last_id=$conn->insert_id;
				$id=$last_id;
				$_SESSION["user_id"]=$id;
				$_SESSION["username"]=$username;
				$_SESSION["mobile"]=$mobile;
				$_SESSION["email"]=$email;
				$_SESSION["address"]=$address;
				echo "<script>location.replace('index.php');</script>";
			}
			else
			{
				$error="<br><p class='bold text-danger'>Already Existing username!</p>";
			}
		}
		else
		{
			$error="<br><p class='bold text-danger'>Please fill empty fields</p>";
		}		
	}
	function test_data($data)
	{
		$data=trim($data);
		$data=stripslashes($data);
		$data=htmlspecialchars($data);
		return $data;
	}
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Register</title>
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
	  <li class="inline"><a href="share.php" >Share File</a></li>
	  <?php 
			if(isset($_SESSION["username"]) && !empty($_SESSION["username"]))
			{	
				echo '<li class="inline" style="float:right"><a href="logout.php">Logout</a></li>';
			}
			else
			{
				echo '<li class="active inline"><a href="register.php">Register</a></li>';
				echo '<li class="inline" style="float:right"><a href="login.php">Login</a></li>';
			}
		?>
    </ul>
  </div>
</div>
<div class="row" style='margin-top:2%'>

     <div style="width:60%;margin:auto;" class="background">
	 <?=$error?>
		<h1>Register:</h1>
		<form name="addform" action="<?php echo $_SERVER["REQUEST_URI"]?>" method="post" enctype="multipart/form-data" novalidate>
			<label for="username"><h5>Username</h5></label>
			<input type="text" name="username" id="username" placeholder="Enter your username" required>
			<label for="password" ><h5>Password</h5></label>
			<input type="password" name="password" id="password" placeholder="Enter your password" required>
			<label for="mobile"><h5>Mobile No</h5></label>
			<input type="number" name="mobile" id="mobile" placeholder="Mobile No" required>
			<label for="email" ><h5>E-mail</h5></label>
			<input type="email" name="email" id="email" placeholder="Enter your email" required>
			<label for="address" ><h5>Address</h5></label>
			<textarea name="address" placeholder="Enter Your Address" required></textarea>
			<input type="submit" name="login" value="Submit">
			
		</form>
	</div>

</div>
</body>
</html>
