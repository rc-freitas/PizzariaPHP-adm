<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Saindo...</title>
    <?php
    session_start();
    session_destroy();
    header("Location: login.php");
    ?>
</head>
<body>
    Saindo...
</body>
</html>