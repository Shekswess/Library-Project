<html>

<head>
    <title>Моја Библиотека</title>
    <link rel="stylesheet" href="../css/global_styles.css">
    <link rel="stylesheet" href="../css/form_styles.css">
    <link rel="stylesheet" href="css/update_balance_style.css">
</head>

<body style='background: white; color:black'>
    <form action="index.php" method="POST" class="cd-form">
        <input type="hidden" name="action" value="update_balance" />
        <center>
            <legend style='color: black;'>Надополни кредит</legend>
        </center>
        <div class="error-message" id="error-message">
            <p id="error">
                <?php
                if (!empty($balance_error)) {
                    echo error_without_field($balance_error);
                }
                ?>
            </p>
        </div>
        <div class="icon">
            <input type="text" style='color: black;' name="m_user" id="m_user" class="m-user" placeholder="Корисничко име" required />
        </div>
        <div class="icon">
            <input type="number" style='color: black;' name="m_balance" class="m-balance" placeholder="Кредит" required />
        </div>
        <input style='font-size:16px;font-weight: normal;background: black; color:white;' type="submit" name="m_add" value="Додади кредит" />
    </form>
    <div style='font-size:16px;font-weight: normal;height: 50px;position: fixed;left: 0;bottom: 0; width: 100%;background-color: black;color: white;text-align: center;'>Made by: Teodora Mladenovska, Nadezhda Ilieva, Bojan Jakimovski <br> Copyright © 2021 - All Rights Reserved</div>
</body>

</html>