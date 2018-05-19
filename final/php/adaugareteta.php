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
        <div class="form-group">
        <label for="titlu">Nume Reteta</label>
        <input type="text" id="titlu" name="titlu" >
        </div>
        <div class="form-group">
        <label for="durata">Timp de preparare</label>
            <h1>Durata</h1>
            <input type="text" id="durata" name="durata" min="1" max="1440">
            <h1>Minute</h1>
            <select id="unitate" name="unitate">
                <option value="minute">Minute</option>
                <option value="ore">Ore</option>
            </select>
        </div>
        <div class="form-group">
        <label for="mese">Masa</label>
        <select id="masa" name="masa">
            <option value="micdejun">Mic Dejun</option>
            <option value="pranz">Pranz</option>
            <option value="cina">Cina</option>
            <option value="gustare">Gustare</option>
        </select>
        </div>
        <div class="form-group">
        <label for="numeb">Bucatarie</label>
        <input type="text" id="numeb" name="numeb" >
        </div>
        <div class="form-group">
        <label for="numep">Metoda de preparare</label>
            <select id="numep" name="numep">
                <option value="fierbere">Fierbere</option>
                <option value="coacere">Coacere</option>
                <option value="prajire">Prajire</option>
                <option value="larece">La rece</option>
            </select>
        </div>
        <div class="form-group">
        <label for="numei">Ingrediente</label>
        <input type="text" id="numei" name="numei" >
        <label for="numeb">Cantitate ingrediente</label><br>
       <br> <h1>Gramaj</h1>
        <input type="text" id="gramaj" name="gramaj" >
        <h1>Unitate</h1>
            <select id="unitate" name="unitate">
                <option value="grame">Grame</option>
                <option value="kg">Kg</option>
            </select>
        </div>
        <div class="form-group">
        <label for="numei">Instrumente</label>
        <input type="text" id="numei" name="numei" >
        </div>
        <div class="form-group">
        <label for="numeb">Boli</label>
        <input type="text" id="numeb" name="numeb" >
        </div>
        <div class="form-group">
        <label for="numebr">Regim</label>
        <input type="text" id="numer" name="numer" >
        </div>
        <div class="form-group">
        <label for="numea">Alergii</label>
        <input type="text" id="numea" name="numea" >
        </div>
        <div class="form-group">
        <label for="textpasi">Pasi</label>

        <textarea id="tesxtpasi" name="textpasi"  style="height:200px"></textarea>
        </div>
        <button type="submit" class="btn" name="reg_reteta" value="adauga">Adauga</button>
    </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
