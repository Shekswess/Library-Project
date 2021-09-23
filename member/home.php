<html>

<head>
	<title>Моја Библиотека</title>
	<link rel="stylesheet" type="text/css" href="../css/global_styles.css">
	<link rel="stylesheet" type="text/css" href="css/home_style.css">
	<link rel="stylesheet" type="text/css" href="../css/custom_radio_button_style.css">
	<link rel="stylesheet" type="text/css" href="../css/custom_checkbox_style.css">
</head>

<body style='color: black; background: white;'>
	<form class='cd-form' method='POST' action='index.php'>
		<input type="hidden" name="action" value="request_book" />
		<div class='error-message' id='error-message'>
			<p id='error'>
				<?php
				if (!empty($member_home_error)) {
					if (strcmp($member_home_error, "SUCCESS") == 0) {
						echo success("Барањето е успешно испратено!");
					} else {
						echo error_without_field($member_home_error);
					}
				}
				?>
			</p>
		</div>
		<table width='100%' cellpadding=10 cellspacing=10>
			<tr>
				<th></th>
				<th>Насловна
					<hr>
				</th>
				<th>ISBN
					<hr>
				</th>
				<th>Наслов
					<hr>
				</th>
				<th>Автор
					<hr>
				</th>
				<th>Категорија
					<hr>
				</th>
				<th>Цена
					<hr>
				</th>
				<th>Примероци
					<hr>
				</th>
			</tr>
			<?php foreach ($result as $res) : ?>
				<tr>
					<td>
						<label class='control control--radio'>
							<input style='color: black' type='radio' name='rd_book' value="<?php echo $res['isbn'] ?>" />
							<div class='control__indicator'></div>
					</td>
					<td><img src="<?php echo $res['bookCover'] ?>" width="50" height="70"></td>
					<td> <?php echo $res['isbn'] ?></td>
					<td><?php echo $res['title'] ?></td>
					<td><?php echo $res['author'] ?></td>
					<td><?php echo $res['category'] ?></td>
					<td><?php echo $res['price'] ?></td>
					<td><?php echo $res['copies'] ?></td>
				</tr>
			<?php endforeach; ?>
		</table>
		<input style='background: black;' type='submit' value='Позајми книга' />
	</form>
	<div style='font-size:16px;font-weight: normal;height: 50px;position: relative;left: 0;bottom: 0; top: 25px; width: 100%;background-color: black;color: white;text-align: center;'>Made by: Teodora Mladenovska, Nadezhda Ilieva, Bojan Jakimovski <br> Copyright © 2021 - All Rights Reserved</div>
</body>

</html>