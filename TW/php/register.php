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
        <a href="#" id="logo"></a>

        <nav>

            <a href="../php/index.php" id="menu-icon"></a>

            <ul>
                <li><a href="../php/index.php">Acasa</a></li>
            </ul>

        </nav>
    </header>
</div>
<div class="loginbox">
    <h1>Register Here</h1><br><br>
    <form method = "post" action ="register.php">
        <?php include('errors.php');?>
        <label>Email</label>
        <input type="email" name="email" value="<?php echo $email; ?>" pattern="[^ @]*@[^ @]*">
        <label>Password</label>
        <input type="password" name="password_1">
        <label>Confirm the Password</label>
        <input type="password" name="password_2">
        <button type="submit" class="btn" name="reg_user" value="register">Register</button>
    </form>
</div>
</body>

</html>