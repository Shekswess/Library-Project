<html>

<head>
	<title>Регистрација</title>
	<link rel="stylesheet" type="text/css" href="css/form_styles.css">
	<link rel="stylesheet" href="member/css/register_style.css">
</head>

<body style='background-color: white; color:black;'>
	<form class="cd-form" method="POST" action="index.php">
		<center>
			<legend style='background-color: white; color:black;'>Регистрација на нов член</legend>
			<p style='background-color: white; color:black; font-size: 16px; font-weight:normal;'>Ве молиме пополнете ги полињата: </p>
		</center>
		<input type="hidden" name="action" value="register" />
		<div class="error-message" id="error-message">
			<p id="error">
				<?php
				if (!empty($register_error)) {
					if (strcmp($register_error, "SUCCESS") == 0) {
						echo success("Барањето е успешно поднесено. Ќе бидете известени кога вашето членство ќе се активира.");
					} else {
						echo error_without_field($register_error);
					}
				}
				?>
		</div>

		<div class="icon">
			<input style="color:black; font-size: 16px; font-weight:normal;" class="m-name" type="text" name="m_name" placeholder="Име и презиме" required />
		</div>

		<div class="icon">
			<input style="color:black; font-size: 16px; font-weight:normal; " class="m-email" type="email" name="m_email" id="m_email" placeholder="Email адреса" required />
		</div>

		<div class="icon">
			<input style="color:black; font-size: 16px; font-weight:normal;" class="m-user" type="text" name="m_user" id="m_user" placeholder="Корисничко име" required />
		</div>

		<div class="icon">
			<input style="color:black; font-size: 16px; font-weight:normal;" class="m-pass" type="password" name="m_pass" placeholder="Лозинка" required />
		</div>

		<div class="icon">
			<input style="color:black; font-size: 16px; font-weight:normal;" class="m-balance" type="number" name="m_balance" id="m_balance" placeholder="Кредит" required />
		</div>

		<br />
		<input type="submit" name="m_register" value="Submit" style='background-color: black; color:white; font-size: 16px; font-weight:normal;' />
	</form>
	<div style='font-size: 16px;height: 50px;position: relative;top: 25px;left: 0;bottom: 0; width: 100%;background-color: black;color: white;text-align: center;'>Made by: Teodora Mladenovska, Nadezhda Ilieva, Bojan Jakimovski <br> Copyright © 2021 - All Rights Reserved</div>
</body>

</html>