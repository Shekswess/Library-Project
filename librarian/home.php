<html>

<head>
	<title>Моја Библиотека</title>
	<link rel="stylesheet" type="text/css" href="css/home_style.css" />
	<link rel="stylesheet" href="../css/global_styles.css">
</head>

<body style="background: white;">
	<div id="allTheThings">

		<a href="<?php echo 'index.php' . '?action=list_books'; ?>">
			<input style="font-size: 16px;font-weight: normal;background: black; color: white;" type="button" value="Достапни книги" />
		</a><br />

		<a href="<?php echo 'index.php' . '?action=insert_book'; ?>">
			<input style="font-size: 16px;font-weight: normal;background: black; color: white;" type="button" value="Додади нова книга" />
		</a><br />

		<a href="<?php echo 'index.php' . '?action=update_copies_view'; ?>">
			<input style="font-size: 16px;font-weight: normal;background: black; color: white;" type="button" value="Додади примероци од постоечка книга" />
		</a><br />

		<a href="<?php echo 'index.php' . '?action=delete_book_view'; ?>">
			<input style="font-size: 16px;font-weight: normal;background: black; color: white;" type="button" value="Избриши книга" />
		</a><br />

		<a href="<?php echo 'index.php' . '?action=pending_book_requests_view'; ?>">
			<input style="font-size: 16px;font-weight: normal;background: black; color: white;" type="button" value="Одобри нови барања за позајмување на книга" />
		</a><br />

		<a href="<?php echo 'index.php' . '?action=pending_registrations_view'; ?>">
			<input style="font-size: 16px;font-weight: normal;background: black; color: white;" type="button" value="Одобри нови барања за регистрација" />
		</a><br />

		<a href="<?php echo 'index.php' . '?action=update_balance_view'; ?>">
			<input style="font-size: 16px;font-weight: normal;background: black; color: white;" type="button" value="Надополни кредит на член" />
		</a><br />
	</div>
	<div style='font-size:16px;font-weight: normal; height: 50px;position: fixed;left: 0;bottom: 0; width: 100%;background-color: black;color: white;text-align: center;'>Made by: Teodora Mladenovska, Nadezhda Ilieva, Bojan Jakimovski <br> Copyright © 2021 - All Rights Reserved</div>
</body>

</html>