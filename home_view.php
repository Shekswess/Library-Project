<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/form_styles.css">
	<title>Најава</title>
	<style>
		input[type=text]:focus, input[type=password]:focus {
			border: 1px solid #555;
		}
	</style>

</head>

<body style = 'background-color: white;'>
	<form class="cd-form" method="POST" action="index.php" method="POST">
		<input type="hidden" name="action" value="login" />
		<center>
			<legend style = 'color: black;'>Најава</legend>
		</center>
		<div class="error-message" id="error-message">
			<p id="error"></p>
		</div>
		<div class="icon">
			<input class="m-user" type="text" name="m_user" placeholder="Корисничко име" required style="color:black; background-color: white; font-size: 16px; font-weight:normal; " />
		</div>
		<div class="icon">
			<input class="m-pass" type="password" name="m_pass" placeholder="Лозинка" required style="color:black; background-color: white;font-size: 16px; font-weight:normal;" />
		</div>
		<input type="submit" value="Најава" name="m_login" style = 'color: white; background-color: black ;font-size: 16px; font-weight:normal;'/>
		<br /><br /><br /><br />
		<p align="center" style = 'color: black; font-size: 16px; font-weight:normal;'>Немате корисничка сметка ? &nbsp;<a href="<?php echo 'index.php' . '?action=register_view'; ?>" style="text-decoration:none; color:red;"> Регистрирајте се! </a>
	</form>
	<div style='font-size: 16px; height: 50px;position: fixed;left: 0;bottom: 0; width: 100%;background-color: black;color: white;text-align: center;'>Made by: Teodora Mladenovska, Nadezhda Ilieva, Bojan Jakimovski <br> Copyright © 2021 - All Rights Reserved</div>
</body>