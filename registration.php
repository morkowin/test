<?php 
session_start();
require_once "connect.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Registration</title>
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
						 $arrs = $db->getDataUserForLogin($_SESSION["login"]);
						 echo "<h2>User data</h2>";
						 echo "<ul style='font-size: 150%'><li><b>Email:</b> ".$arrs["email"]."</li>";
						 echo "<li><b>Name:</b> ".$arrs["name"]."</li>";
						 echo "<li><b>Birthdate:</b> ".date("d.m.Y",$arrs["birthdate"])."</li></ul>";
						 
					}else{
		?>
			<h2>Registration form</h2>
			<form name="registation" action="action_reg.php" method="post">
					<table>
						<tr>
							<td>
								<label for="email">Email:</label>
							</td>
							<td>
								<input type="email" name="email" placeholder="Email" id="email" required pattern="^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$" value="<?=$_COOKIE["email"]?>"/>
								<a href="#" id="checkemail">Check email</a><span id="resemail"></span>
							</td>
						</tr>
						<tr>
							<td>
								<label for="login">Login:</label>
							</td>
							<td>
								<input type="text" name="login" placeholder="Login" id="login" value="<?=$_COOKIE["login"]?>"/>
								<a href="#" id="checklogin">Check login</a><span id="reslogin"></span>
							</td>
						</tr>
						<tr>
							<td>
								<label for="realname">Real name:</label>
							</td>
							<td>
								<input  type="text" name="realname" placeholder="Real name" id="realname" value="<?=$_COOKIE["realname"]?>"/>
							</td>
						</tr>
						<tr>
							<td>
								<label for="password">Password:</label>
							</td>
							<td>
								<input type="password" name="password" placeholder="Password" id="password"/>
							</td>
						</tr>
						<tr>
							<td>
								<label for="birthdate">Birth date:</label>
							</td>
							<td>
								<input type="date" name="birthdate" placeholder="Birth date" id="birthdate" value="<?=$_COOKIE["birthdate"]?>"/>
							</td>
						</tr>
						<tr>
							<td>
								<label>Country:</label>
							</td>
							<td>
								<select id="countrylist" name="countrylist">
									<?php 
										$db = DB::getInstance();
										$arrs = $db->getCountryes();
										for($i=0;$i<count($arrs);$i++){
											if($_COOKIE["countrylist"]==$arrs[$i]["name"])
											echo "<option selected value='".$arrs[$i]["name"]."'>".$arrs[$i]["name"]."</option>";
											else echo "<option value='".$arrs[$i]["name"]."'>".$arrs[$i]["name"]."</option>";
										}
									?>
								</select>
						
							</td>
						</tr>
						<tr>
							<td>
								<label>Agree with terms <br />and conditions:</label>
							</td>
							<td>
								<input type="checkbox" value="cond" id="cond" onchange="onChange()">
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<input type="submit" name="regsub" value="Sign Up" id="regsub" disabled/>
							</td>
						</tr>
					</table>
					</form>	<? } ?>
		</div>
	</div>
</body>
</html>