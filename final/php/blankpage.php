<?php
/**
 * Created by PhpStorm.
 * User: Asus
 * Date: 19.05.2018
 * Time: 12:14
 */
?>
<html>
<head>
    <style>
        /*RESET*/
        html, body, div, h1, a,img, ul, li,  form, label{
            margin:0;
            padding:0;
            border:0; outline:0;
            font-size:100%;
            vertical-align:baseline;
            background:transparent;
        }
        body {
            line-height: 1;
            /*overflow:hidden;*/
        }
        ul{
            list-style:none;
        }
        /*MAIN*/
        body {
            font-size: 1.05em;
            line-height: 1.25em;
            font-family: Courier New, monospace;
            background: #ffffff;
            color: #555;
            padding-left:10%;
            padding-right: 10%;
        }
        .box{
            margin-left:10%;
            margin-right: 10%;
        }
        .wrapper {
            display: grid;
            grid-gap: 10px;
            grid-template-columns: 100% ;
        }
        header{
            grid-column:1/2;
            grid-row:1;
        }
        .a{
            grid-column:1;
            grid-row: 2;
        }

        .card{
            position: relative;
            display: flex;
            -webkit-box-orient: vertical;
            /*    -moz-box-orient: vertical;*/
            -webkit-box-direction: normal;
            /*    -moz-box-direction: normal;*/
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-clip: border-box;
            border:1px solid rgba(0,0,0,.125);
            border-radius: .25rem;
            background-color: white;
        }
        .card-body{
            -webkit-box-flex:1;
            flex:1 1 auto;
            padding:1.25rem;
        }
        .form-group{
            margin-bottom:1rem;
            padding-bottom: 1rem;
        }
        @media (max-width: 720px){
            /*header{*/
                /*grid-column:1;*/
                /*grid-row:1;*/
            /*}*/
            /*.a{*/
                /*grid-column:1;*/
                /*grid-row: 2;*/
            /*}*/
        }
    </style>
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
    <h1>Inregistrati-va aici </h1><br><br>
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
            <input type="text" id="email" name="email" value="<?php echo $email; ?>" pattern="[^ @]*@[^ @]*">
            </div>
            <div class="form-group">
                <label for="parola">Parola</label>
            <input type="text" id="parola_1" name="parola_1">
            </div>
            <div class="form-group">
                <label for="parola">Confirma Parola</label>
                <input type="text" id="parola_2" name="parola_2">
            </div>
            <div class="form-group">
                <label for="datansterii">Data nasterii</label>
            <input type="text" id="datanasterii" name="datanasterii">
            </div>
            <button type="submit" class="btn" name="reg_user" value="register">Inregistrare</button>
        </form>
    </div>
    </div> <!--card-->
    </div>
   </div> <!--/.wrapper-->
</body>
</html>
