<?php include('server.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Title</title>
    <link rel="stylesheet" type="text/css" href="../css/login.css">
    <link rel="stylesheet" type="text/css" href="../css/index.css">
</head>
<body>
<div class="wrapper">

    <header>
        <a href="../php/index.php" id="logo"></a>

        <nav>

            <a href="../php/index.php" id="menu-icon"></a>

            <ul>
                <li><a href="../php/index.php">Acasa</a></li>
            </ul>

        </nav>
    </header>
</div>
<div class="loginbox">
    <h1>Login Here</h1><br><br>
    <form method="post" action="login.php">
       <?php include('errors.php'); ?>
        <label>Email</label>
        <input type="email" name="email">
        <label>Password</label>
        <input type="password" name="password">
        <button type="submit" class="btn" name="login_user" value="login">Login</button>
        <h2>Nu aveti cont? Apasati <a href="../php/register.php">aici</a></h2>

    </form>
</div>
</body>
</html>