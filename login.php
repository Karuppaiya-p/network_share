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
		if(!empty($username) && !empty($password))
		{
			$sql="SELECT * from user where binary username='".$username."' and password='".$password."'";
			$result=$conn->query($sql);
			if(mysqli_num_rows($result)==1)
			{
				while($row = $result->fetch_assoc()) 
				{
					$id=$row["id"];
					$username=$row["username"];
					$mobile=$row["mobile"];
					$email=$row["email"];
					$address=$row["address"];
					$public=$row["public"];
					$_SESSION["user_id"]=$id;
					$_SESSION["username"]=$username;
					$_SESSION["mobile"]=$mobile;
					$_SESSION["email"]=$email;
					$_SESSION["address"]=$address;
					$_SESSION["public"]=$public;
					if(isset($_SESSION["resturi"]) && !empty($_SESSION["resturi"]))
					{
						$resturi=$_SESSION["resturi"];
						$_SESSION["resturi"]="";
						echo "<script>location.replace('".$resturi."');</script>";
					}
					else
					{
						echo "<script>location.replace('index.php');</script>";
					}
				}
			}
			else
			{
				$error="<br><p class='bold text-danger'>Username or Password mismatch</p>";
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
	  <li class="inline "><a href="share.php" >Share File</a></li>
	  <?php 
			if(isset($_SESSION["username"]) && !empty($_SESSION["username"]))
			{	
				echo '<li class="inline" style="float:right"><a href="logout.php">Logout</a></li>';
			}
			else
			{
				echo '<li class=" inline"><a href="register.php">Register</a></li>';
				echo '<li class="inline active" style="float:right"><a href="login.php">Login</a></li>';
			}
		?>
    </ul>
  </div>
</div>
<div class="row" style='margin-top:2%'>
     <div style="width:60%;margin:auto;" class="background">
		<h1>Login:</h1>
		<?=$error;?>
		<form name="addform" action="<?php echo $_SERVER["REQUEST_URI"]?>" method="post" enctype="multipart/form-data" novalidate>
			<label for="username"><h5>Username</h5></label>
			<input type="text" name="username" id="username" placeholder="Enter your username" required>
			<label for="password" ><h5>Password</h5></label>
			<input type="password" name="password" id="password" placeholder="Enter your password" required>
			<input type="submit" name="login" value="Submit">
		</form>
	</div>




</body>
</html>