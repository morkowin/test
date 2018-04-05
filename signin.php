<?php 
session_start();
require_once "connect.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Sign In</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<link type="text/css" rel="stylesheet" href="styles/main.css" />
	<script src="js/jquery-3.3.1.min.js"></script>
	<script src="js/scripts.js"></script>
</head>
<body>
	<div id="container">
		<header>
			<nav>
				<ul id="topmenu">
				<?php 
					if(!isset($_SESSION["login"])){
						
				?>
					<li>
						<a href="registration.php">Registration</a>
					</li>
					<li>
						<a href="signin.php">Sign in</a>
					</li>
				<?php 
					}else{
					 unset($_SESSION["errors"]);
					 
					 echo "<li><a href='logout.php'>Выход</a></li>";
					}
				?>
				</ul>
				<div class="clear"></div>
			</nav>		
		</header>
		<div class="main">
		<?php if(isset($_SESSION["errors"])) {?>
			<div class="errors">
				<?php 
					foreach($_SESSION["errors"] as $arror){
						echo "<p>".$arror."</p>";
					}
				?>
			</div>
		<? } ?>	
		<?php 
					if(isset($_SESSION["login"])){
						$db = DB::getInstance();
						 $arrs = $db->getDataUserForLoginEmail($_SESSION["login"]);
						 echo "<h2>User data</h2>";
						 echo "<ul style='font-size: 150%'><li><b>Email:</b> ".$arrs["email"]."</li>";
						 echo "<li><b>Name:</b> ".$arrs["name"]."</li>";
						 echo "<li><b>Birthdate:</b> ".date("d.m.Y",$arrs["birthdate"])."</li></ul>";
						 
					}else{
		?>
			<h2>Authorization form</h2>
			<form name="registation" action="action_auth.php" method="post">
					<table>
						<tr>
							<td>
								<label for="emaillogin">Login/Email:</label>
							</td>
							<td>
								<input type="text" name="emaillogin" placeholder="email/login"/>
							</td>
						</tr>
						<tr>
							<td>
								<label for="password">Password:</label>
							</td>
							<td>
								<input type="password" name="password" placeholder="Password"/>
							</td>
						</tr>																	
						<tr>
							<td colspan="2">
								<input type="submit" name="authsub" value="Sign in" id="authsub"/>
							</td>
						</tr>
					</table>
					</form>	<? } ?>
		</div>
	</div>
</body>
</html>