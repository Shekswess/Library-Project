<html>

<head>
	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,700">
	<link rel="stylesheet" type="text/css" href="css/header_style.css" />
	<link rel="stylesheet" type="text/css" href="../member/css/header_member_style.css" />
	<link rel="stylesheet" type="text/css" href="../librarian/css/header_librarian_style.css">
</head>

<body>
	<header style = 'background-color: black; color: white;'>
		<?php
		if (empty($_SESSION['type'])) {
			echo "<a href='./'>";
			echo "<div id='cd-logo'>";
			echo "<p style = 'color: white'>Моја Библиотека</p>";
			echo "</div>";
			echo "</a>";
		} else if (strcmp($_SESSION['type'], "member") == 0) {
			echo "<a href='../'>";
			echo "<div id='cd-logo'>";
			echo "<p style = 'color: white'>Моја Библиотека</p>";
			echo "</div>";
			echo "</a>";
			echo "<div class='dropdown'>";
			echo "<button class='dropbtn'>";
			echo "<p id='librarian-name'>" . $_SESSION['username'] . "</p>";
			echo "</button>";
			echo "<div class='dropdown-content'>";
			echo "<a>";
			$query = $con->prepare("SELECT balance FROM member WHERE username = ?;");
			$query->bind_param("s", $_SESSION['username']);
			$query->execute();
			$balance = (int)$query->get_result()->fetch_array()[0];
			echo "Кредит: " . $balance . " денари";
			echo "</a>";
			echo "<a href=" . 'index.php' . '?action=my_books' . ">Мои книги</a>";
			echo "<a href='../logout.php'>Одјави се</a>";
			echo "</div>";
			echo "</div>";
		} else if (strcmp($_SESSION['type'], "librarian") == 0) {
			echo "<a href='../'>";
			echo "<div id='cd-logo'>";
			echo "<p style = 'color: white'>Моја Библиотека</p>";
			echo "</div>";
			echo "</a>";
			echo "<div class='dropdown'>";
			echo "<button class='dropbtn'>";
			echo "<p id='librarian-name'>" . $_SESSION['username'] . "</p>";
			echo "</button>";
			echo "<div class='dropdown-content'>";
			echo "<a href='../logout.php'>Одјави се</a>";
			echo "</div>";
			echo "</div>";
		}
		?>
	</header>
</body>

</html>