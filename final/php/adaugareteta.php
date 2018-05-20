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
                <h2>Indroduceti reteta aici </h2><br><br>
                <form method="post" action="../php/adaugareteta.php">
                    <?php include('errors.php');?>
                <div class="form-group">
                    <label for="retete">Nume Reteta</label>
                    <input type="text" id="titlu" name="titlu">
                </div>
                <div class="form-group">
                    <label for="timp">Timp de preparare</label>
                    <h1>Durata</h1>
                    <input type="text" id="durata" name="durata" >
                    <h1>Minute</h1>
                    <select id="minute" name="minute">
                    <option value="minute">Minute</option>
                    <option value="ore">Ore</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="mese">Masa</label>
                    <select id="numemasa" name="numemasa">
                        <option value="micdejun">Mic Dejun</option>
                        <option value="pranz">Pranz</option>
                        <option value="cina">Cina</option>
                        <option value="gustare">Gustare</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="bucatarii">Bucatarie</label>
                    <input type="text" id="numebucatarie" name="numebucatarie" >
                </div>
                <div class="form-group">
                    <label for="preparare">Metoda de preparare</label>
                    <select id="metodapreparare" name="metodapreparare">
                    <option value="fierbere">Fierbere</option>
                    <option value="coacere">Coacere</option>
                    <option value="prajire">Prajire</option>
                    <option value="larece">La rece</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="ingrediente">Ingrediente</label>
                    <input type="text" id="numeingredient" name="numeingredient" >
                </div>
                    <div class="form-group">
                        <label for="cantitate">Cantitate ingrediente</label>
                        <h1>Gramaj</h1>
                        <input type="text" id="gramaj" name="gramaj" >
                        <h1>Unitate</h1>
                        <select id="unitate" name="unitate">
                        <option value="grame">Grame</option>
                        <option value="kg">Kg</option>
                        </select>
                    </div>
                        <div class="form-group">
                        <label for="instrumente">Instrumente</label>
                        <input type="text" id="numeinstruemnt" name="numeinstrument" >
                        </div>
                        <div class="form-group">
                        <label for="boli">Boli</label>
                        <input type="text" id="numeboala" name="numeboala" >
                        </div>
                        <div class="form-group">
                        <label for="regim">Regim</label>
                        <input type="text" id="numeregim" name="numeregim" >
                        </div>
                        <div class="form-group">
                        <label for="alergii">Alergii</label>
                        <input type="text" id="numealergie" name="numealergie" >
                        </div>
                        <div class="form-group">
                        <label for="pasi">Pasi</label>

                        <textarea id="tesxtpas" name="textpas"  style="height:200px"></textarea>
                        </div>
                    <div class="form-group">
                        <label for="imagini">Imagine</label>
                        <input type="text" id="cale" name="cale" >
                    </div>

                    <button type="submit" class="btn" name="reg_reteta" value="adauga">Adauga</button>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
