<html>

<head>
	<title>Моја Библиотека</title>
	<link rel="stylesheet" type="text/css" href="../css/global_styles.css">
	<link rel="stylesheet" type="text/css" href="../css/custom_checkbox_style.css">
	<link rel="stylesheet" type="text/css" href="css/pending_registrations_style.css">
</head>

<body style='background: white; color:black;'>
	<form class="cd-form" method="POST" action="index.php">
		<input type="hidden" name="action" value="registration_requests" />
		<div class='error-message' id='error-message'>
			<p id='error'>
				<?php
				if (!empty($registration_error)) {
					if (is_numeric($registration_error)) {
						if ($registration_error == 1) {
							echo success("Успешно обработено " . $registration_error . " барање за регистрација.");
						} else {
							echo success("Успешно обработени " . $registration_error . " барања за регистрација.");
						}
					} else {
						echo error_without_field($registration_error);
					}
				}
				?>
			</p>
		</div>
		<table width='100%' cellpadding=10 cellspacing=10>"
			<tr>
				<th></th>
				<th>Корисничко име
					<hr>
				</th>
				<th>Име
					<hr>
				</th>
				<th>Email адреса
					<hr>
				</th>
				<th>Кредит
					<hr>
				</th>
			</tr>
			<?php foreach ($result as $res) : ?>
				<tr>
					<td>
						<label class='control control--checkbox'>
							<input type='checkbox' name='cd_<?php echo $res['username'] ?>' value="<?php echo $res['username'] ?>" />
							<div class='control__indicator'></div>
						</label>
					</td>
					<td> <?php echo $res['username'] ?></td>
					<td><?php echo $res['name'] ?></td>
					<td><?php echo $res['email'] ?></td>
					<td><?php echo $res['balance'] ?></td>
				</tr>
			<?php endforeach; ?>
		</table>
		<br /><br />
		<div style='float: right;'>
			<input style='background: black; color:white;' type='submit' value='Одбиј' name='l_delete' />
			<input style='background: black;color:white;' type='submit' value='Прифати' name='l_confirm' />
	</form>
	<div style='font-size:16px;font-weight: normal;height: 50px;position: fixed;left: 0;bottom: 0; width: 100%;background-color: black;color: white;text-align: center;'>Made by: Teodora Mladenovska, Nadezhda Ilieva, Bojan Jakimovski <br> Copyright © 2021 - All Rights Reserved</div>
</body>

</html>