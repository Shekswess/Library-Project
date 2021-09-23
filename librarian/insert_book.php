<html>

<head>
	<title>Моја Библиотека</title>
	<link rel="stylesheet" type="text/css" href="../css/global_styles.css" />
	<link rel="stylesheet" type="text/css" href="../css/form_styles.css" />
	<link rel="stylesheet" href="css/insert_book_style.css">
</head>

<body style="background: white; color: black;">
	<form class="cd-form" method="POST" action="index.php" enctype="multipart/form-data">
		<center>
			<legend style="color: black">Додади нова книга</legend>
		</center>
		<input type="hidden" name="action" value="add_book" />
		<div class="error-message" id="error-message">
			<p id="error">
				<?php
				if (!empty($error_text)) {
					echo error_without_field($error_text);
				}
				?>
			</p>
		</div>
		<div class="icon">
			<input style="color:black" class="b-isbn" id="b_isbn" type="number" name="b_isbn" placeholder="ISBN" required />
		</div>
		<div class="icon">
			<input style="color:black" class="b-title" type="text" name="b_title" placeholder="Наслов" required />
		</div>
		<div class="icon">
			<input style="color:black" class="b-author" type="text" name="b_author" placeholder="Автор" required />
		</div>
		<div>
			<h4 style="color: black">Категорија</h4>
			<p class="cd-select icon">
				<select style="color:black" class="b-category" name="b_category">
					<option>History</option>
					<option>Comics</option>
					<option>Fiction</option>
					<option>Thriller</option>
					<option>Non-Fiction</option>
					<option>Biography</option>
					<option>Medical</option>
					<option>Fantasy</option>
					<option>Education</option>
					<option>Sports</option>
					<option>Technology</option>
					<option>Literature</option>
				</select>
			</p>
		</div>
		<div class="icon">
			<input style="color:black" class="b-price" type="number" name="b_price" placeholder="Цена" required />
		</div>
		<div class="icon">
			<input style="color:black" class="b-copies" type="number" name="b_copies" placeholder="Број на примероци" required />
		</div>
		<div class="icon">
			<label style="color: black"> Слика од насловна страна </label>
			<input style="color:black" type="file" name="b_cover" id="b_cover" />
		</div>
		<br />
		<input style="font-size:16px;font-weight: normal;background: black; color: white;" class="b-isbn" type="submit" name="b_add" value="Додади книга" />
	</form>
	<div style='font-size:16px;font-weight: normal;height: 50px;position: relative;font-weight: normal;left: 0;bottom: 0; top: 25px; width: 100%;background-color: black;color: white;text-align: center;'>Made by: Teodora Mladenovska, Nadezhda Ilieva, Bojan Jakimovski <br> Copyright © 2021 - All Rights Reserved</div>
	<body>

</html>