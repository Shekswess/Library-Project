<html>

<head>
	<title>Моја Библиотека</title>
	<link rel="stylesheet" type="text/css" href="../css/global_styles.css">
	<link rel="stylesheet" type="text/css" href="../css/custom_checkbox_style.css">
	<link rel="stylesheet" type="text/css" href="css/pending_book_requests_style.css">
</head>

<body style='background: white; color: black'>
	<form class="cd-form" method="POST" action="index.php">
		<input type="hidden" name="action" value="book_requests" />
		<div class='error-message' id='error-message'>
			<p id='error'>
				<?php
				if (!empty($book_requests_error)) {
					if (is_numeric($book_requests_error)) {
						if ($book_requests_error == 1) {
							echo success("Успешно обработено " . $book_requests_error . " барање за позајмување книга.");
						} else {
							echo success("Успешно обработени " . $book_requests_error . " барања за позајмување книга.");
						}
					} else {
						echo error_without_field($book_requests_error);
					}
				}
				?>
			</p>
		</div>
		<table width='100%' cellpadding=10 cellspacing=10>"
			<tr>
				<th></th>
				<th>Корисник
					<hr>
				</th>
				<th>ISBN
					<hr>
				</th>
				<th>Наслов
					<hr>
				</th>
				<th>Време
					<hr>
				</th>
			</tr>
			<?php foreach ($result as $res) : ?>
				<tr>
					<td>
						<label class='control control--checkbox'>
							<input type='checkbox' name='cd_<?php echo $res['request_id'] ?>' value="<?php echo $res['request_id'] ?>" />
							<div class='control__indicator'></div>
						</label>
					</td>
					<td> <?php echo $res['member'] ?></td>
					<td><?php echo $res['book_isbn'] ?></td>
					<td><?php echo get_book_title($res['book_isbn']) ?></td>
					<td><?php echo $res['time'] ?></td>
				</tr>
			<?php endforeach; ?>
		</table>
		<br /><br />
		<div style='float: right;'>
			<input style='background: black;' type='submit' value='Одбиј' name='l_reject' />
			<input style='background: black;' type='submit' value='Прифати' name='l_grant' />
	</form>
	<div style='font-size:16px;font-weight: normal;height: 50px;position: fixed;left: 0;bottom: 0; width: 100%;background-color: black;color: white;text-align: center;'>Made by: Teodora Mladenovska, Nadezhda Ilieva, Bojan Jakimovski <br> Copyright © 2021 - All Rights Reserved</div>
</body>

</html>