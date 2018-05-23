<?php
/**
 * Created by PhpStorm.
 * User: win10
 * Date: 5/20/2018
 * Time: 12:47 PM
 */?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Toate retetele</title>
    <link rel="stylesheet" type="text/css" href="navbarcss.css">
    <link rel="stylesheet" type="text/css" href="toate-retetele.css">
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

        <h2>Toate retetele </h2><br><br>
        <div class="input-group">
            <input name="cauta-reteta" type="text" placeholder="Cauta reteta...">
            <button type="button" onclick="displayFiltru()" class="btn-filtru">Adauga filtre</button>
            <div id="filtru" style="display:none">
                <div class="card a" style="width:50%">
                    <div class="card-body">
                        filtre
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="card a">
            <div class="card-body">
                <h2>Nume reteta
                </h2>
                <div>
                    Timp de preparare:
                </div>
                <button type="button" onclick="displayReteta()" class="btn-reteta">Vezi reteta...</button>
                <div id="reteta" style="display:none">
                    This is my DIV element.
                </div>
            </div>
            <hr>
        </div>
    </div>
</div>
<script type="text/javascript">
    function displayReteta(){
        let x=document.getElementById("reteta");
        if(x.style.display==="none"){
            x.style.display="block";
        }else x.style.display="none";
    }

    function displayFiltru(){
        let x=document.getElementById("filtru");
        if(x.style.display==="none"){
            x.style.display="block";
        }else x.style.display="none";
    }
</script>
</body>
</html>
