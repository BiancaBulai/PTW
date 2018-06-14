<?php
// Setari pagina
$pageTitle = 'Creează un cont';

// Header
require 'layout/header.php';
?>

<div class="box b">
    <div class="container">
        <div class="login_form">
            <form action="actions/login.php" method="POST" name="loginForm">
                <div class="row">
                    <div class="column full">
                        <h2>Creează un cont</h2>
                        <label for="login_mail">Adresa e-mail</label>
                        <input type="mail" name="login_mail" placeholder="mail@domeniu.ro" />
                        <label for="login_password">Parola</label>
                        <input type="password" name="login_password" placeholder="*******" />
                        <label for="login_password_confirm">Confirmare parola</label>
                        <input type="password" name="login_password_confirm" placeholder="*******" />
                        <br />
                    </div>
                </div>
                <div class="row">
                    <div class="column half"><button>Creează un cont</button></div>
                    <div class="column half"><button onclick="window.location.href='login'; return false;">Login</button></div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php

// Header
require 'layout/footer.php';

?>