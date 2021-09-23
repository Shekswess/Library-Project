<html>

<head>
    <title>Моја Библиотека</title>
    <link rel="stylesheet" href="../css/global_styles.css">
    <link rel="stylesheet" href="../css/form_styles.css">
    <link rel="stylesheet" href="css/update_copies_style.css">
</head>

<body style = 'background: white'>
    <form action="index.php" method="POST" class="cd-form">
        <input type="hidden" name="action" value="update_copies" />
        <center>
            <legend style="color: black">Додади примероци</legend>
        </center>
        <div class="error-message" id="error-message">
            <p id="error">
                <?php
                if (!empty($update_error)) {
                    echo error_without_field($update_error);
                }
                ?>
            </p>
        </div>
        <div class="icon">
            <input style="color:black" type="text" name="b_isbn" id="b_isbn" class="b-isbn" placeholder="ISBN" required>
        </div>
        <div class="icon">
            <input style="color:black" type="text" name="b_copies" id="" class="b-copies" placeholder="Број на нови примероци" required>
        </div>
        <input style="font-size:16px;font-weight: normal;background: black; color: white" type="submit" value="Додади примероци" name="b_add">
    </form>
    <div style='font-size:16px;font-weight: normal;height: 50px;position: fixed;left: 0;bottom: 0; width: 100%;background-color: black;color: white;text-align: center;'>Made by: Teodora Mladenovska, Nadezhda Ilieva, Bojan Jakimovski <br> Copyright © 2021 - All Rights Reserved</div>
</body>

</html>