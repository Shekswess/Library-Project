<html>

<head>
	<title>Моја Библиотека</title>
	<link rel="stylesheet" type="text/css" href="../member/css/home_style.css" />
	<link rel="stylesheet" type="text/css" href="../css/global_styles.css">
	<link rel="stylesheet" type="text/css" href="../css/home_style.css">
	<link rel="stylesheet" type="text/css" href="../member/css/custom_radio_button_style.css">
</head>

<body style="background: white;">
	<form class='cd-form'>
		<div class='error-message' id='error-message'>
			<p id='error'></p>
		</div>
		<table width='100%' cellpadding=10 cellspacing=10 style = 'color: black'>
			<tr>
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
	</form>
	<footer style='height: 50px;font-size:16px;font-weight: normal;position: absolute;left: 0;bottom: 0; width: 100%;background-color: black;color: white;text-align: center;'>Made by: Teodora Mladenovska, Nadezhda Ilieva, Bojan Jakimovski <br> Copyright © 2021 - All Rights Reserved</footer>
</body>

</html>