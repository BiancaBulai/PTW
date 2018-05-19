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
        <a href="#" id="logo"></a>

        <nav>

            <a href="../php/index.php" id="menu-icon"></a>

            <ul>
                <li><a href="../php/index.php">Acasa</a></li>
            </ul>

        </nav>
    </header>
    <div class="box">
        <div class="card a">
            <div class="card-body">
                <h2>Inregistrati-va aici </h2><br><br>
                <form method="post" action="../php/register.php">
                    <?php include('errors.php');?>
                    <div class="form-group">
                        <label for="nume">Nume </label>
                        <input type="text" id="nume" name="nume" >
                    </div>
                    <div class="form-group">
                        <label for="prenume">Prenume </label>
                        <input type="text" id="prenume" name="prenume" >
                    </div>
                    <div class="form-group">
                        <label for="email">Email </label>
                        <input type="email" id="email" name="email" value="<?php echo $email; ?>" pattern="[^ @]*@[^ @]*">
                    </div>
                    <div class="form-group">
                        <label for="parola">Parola</label>
                        <input type="password" id="parola_1" name="parola_1">
                    </div>
                    <div class="form-group">
                        <label for="parola">Confirma Parola</label>
                        <input type="password" id="parola_2" name="parola_2">
                    </div>
                    <div class="form-group">
                        <label for="datansterii">Data nasterii</label>
                        <input type="date" id="datanasterii" name="datanasterii">
                    </div>
                    <button type="submit" class="btn" name="reg_user" value="register">Inregistrare</button>
                </form>
            </div>
        </div> <!--card-->
    </div>
</div> <!--/.wrapper-->
</body>
</html>
