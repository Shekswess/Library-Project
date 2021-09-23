<html>

<head>
	<title>Мои книги</title>
	<link rel="stylesheet" type="text/css" href="../css/global_styles.css">
	<link rel="stylesheet" type="text/css" href="../css/custom_checkbox_style.css">
	<link rel="stylesheet" type="text/css" href="css/my_books_style.css">
</head>

<body style='color: black; background: white'>
	<form class="cd-form" method="POST" action="index.php">
		<input type="hidden" name="action" value="return_books" />
		<div class='error-message' id='error-message'>
			<p id='error'>
				<?php
				if (!empty($return_error)) {
					if (is_numeric($return_error)) {
						if ($return_error == 1) {
							echo success("Успешно вратена " . $return_error . " книга.");
						} else {
							echo success("Успешно вратени " . $return_error . " книги.");
						}
					} else {
						echo error_without_field($return_error);
					}
				}
				?>
			</p>
		</div>
		<table width='100%' cellpadding=10 cellspacing=10>"
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
				<th>Да се врати најдоцна до
					<hr>
				</th>
			</tr>
			<?php foreach ($result as $res) : ?>
				<?php
				$isbn = $res['book_isbn'];
				$book_result = get_book($isbn);
				$due_date = get_due_date($_SESSION['username'], $isbn);
				?>
				<tr>
					<td>
						<label class='control control--checkbox'>
							<input style='background:red;' id="checked" type='checkbox' name='cd_<?php echo $isbn?>' value="<?php echo $isbn ?>" />
							<div class='control__indicator'></div>
						</label>
					</td>
					<td><img src="<?php echo $book_result['bookCover'] ?>" width="50" height="70"></td>
					<td><?php echo $isbn ?></td>
					<td> <?php echo $book_result['title'] ?></td>
					<td><?php echo $book_result['author'] ?></td>
					<td><?php echo $book_result['category'] ?></td>
					<td><?php echo $due_date ?></td>
				</tr>
			<?php endforeach; ?>
		</table>
		<br /><br />
		<div style='float: right;'>
			<input style='background: black;' type='submit' name='b_return' value='Врати книги' />
	</form>
	<div style='font-size: 16px; font-weight: normal;height: 50px;position: fixed;left: 0;bottom: 0; width: 100%;background-color: black;color: white;text-align: center;'>Made by: Teodora Mladenovska, Nadezhda Ilieva, Bojan Jakimovski <br> Copyright © 2021 - All Rights Reserved</div>
</body>

</html>