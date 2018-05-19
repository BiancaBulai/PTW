<?php include('server.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Title</title>
    <link rel="stylesheet" type="text/css" href="adaugareteta.css">
    <link rel="stylesheet" type="text/css" href="navbarcss.css">
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
<div class="box">
    <div class="card a">
        <div class="card-body">
    <h2>Autentificati-va aici </h2><br><br>
    <form method="post" action="login.php">
       <?php include('errors.php'); ?>
        <div class="form-group">
        <label for="email">Email </label>
        <input type="email" id="email" name="email" pattern="[^ @]*@[^ @]*">
        </div>
        <div class="form-group">
        <label for="parola">Parola</label>
        <input type="password" id="parola" name="parola">
        </div>
        <button type="submit" class="btn" name="login_user" value="login">Login</button><br>
        <br>
        <h1>Nu aveti cont? Apasati <a href="../php/register.php">aici</a></h1>

    </form>
        </div>
    </div>
</div>

</body>
</html>