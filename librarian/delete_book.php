<html>

<head>
	<title>Моја Библиотека</title>
	<link rel="stylesheet" href="../member/css/home_style.css">
	<link rel="stylesheet" href="../css/global_styles.css">
	<link rel="stylesheet" href="../css/home_style.css">
	<link rel="stylesheet" href="../member/css/custom_radio_button_style.css">
</head>

<body style="color: black; background: white">
	<form class='cd-form'>
		<div class='error-message' id='error-message'>
			<p id='error'>
				<?php
				if (!empty($delete_error)) {
					echo error_without_field($delete_error);
				}
				?>
			</p>
		</div>";
		<table width='100%' cellpadding=10 cellspacing=10>"
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
			</tr>;
			<?php foreach ($result as $res) : ?>
				<tr>
					<td><img src="<?php echo $res['bookCover'] ?>" width="50" height="50"></td>
					<td> <?php echo $res['isbn'] ?></td>
					<td><?php echo $res['title'] ?></td>
					<td><?php echo $res['author'] ?></td>
					<td><?php echo $res['category'] ?></td>
					<td><?php echo $res['price'] ?></td>
					<td><?php echo $res['copies'] ?></td>
					<td>
						<div class='text-center'>
							<a href=<?php echo 'index.php' . '?action=delete_book&isbn=' . $res['isbn'] . ''; ?> style='color:#94618e; font-weight: bold; text-decoration:none;'> <img src="img/xPicture.png" style = 'width: 25px; height: 25px'> </a>
						</div>
					</td>
				</tr>
			<?php endforeach; ?>
		</table>
	</form>
	<div style='font-size:16px;font-weight: normal;height: 50px;position: fixed;left: 0;bottom: 0; width: 100%;background-color: black;color: white;text-align: center;'>Made by: Teodora Mladenovska, Nadezhda Ilieva, Bojan Jakimovski <br> Copyright © 2021 - All Rights Reserved</div>
</body>

</html>