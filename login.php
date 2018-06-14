<?php
// Setari pagina
$currentMenu  = 'login';
$pageTitle    = 'Login';

// Header
require 'layout/header.php';

// Verificam daca este deja logat
if(isset($_SESSION['user_id'])) {
    header('Location: '.$config['url']);
}

// Definire erori
$loginError    = false;
$registerError = false;
$registerErrorMessage = '';

// Login action
if(isset($_POST['login'])) {
    $utilizator = $db->prepare('SELECT * FROM utilizatori WHERE email = ? AND parola = ?');
    $utilizator->execute(array($_POST['login_mail'], md5($_POST['login_password'])));
    $utilizator = $utilizator->fetch();
    if(isset($utilizator->id)) {
        $_SESSION['user_id']    = $utilizator->id;
        $_SESSION['user_name']  = $utilizator->nume.' '.$utilizator->prenume;
        $_SESSION['user_role']   = $utilizator->rol;
        header('Location: '.$config['url']);
    }else{
        $loginError = true;
    }
}

// Register action
if(isset($_POST['register'])) {

    $checkUser =  $checkUser = $db->prepare('SELECT * FROM utilizatori WHERE email = ?');
    $checkUser->execute(array($_POST['login_mail']));
    $checkUser = $checkUser->fetch();

    if(isset($checkUser->id)) {

        $registerError = true;
        $registerErrorMessage = 'Exista deja un utilizator cu aceasta adresa de mail.';

    }else if($_POST['login_password'] != $_POST['login_password_confirm']) {

        $registerError = true;
        $registerErrorMessage = 'Va rugam sa confirmati parola.';

    }

    if(!$registerError) {
        $db->prepare("INSERT INTO utilizatori (email, parola, rol) VALUES (?, ?, ?)")->execute(array($_POST['login_mail'], md5($_POST['login_password']), 'user'));
        $utilizator = $db->prepare('SELECT * FROM utilizatori WHERE email = ? AND parola = ?');
        $utilizator->execute(array($_POST['login_mail'], md5($_POST['login_password'])));
        $utilizator = $utilizator->fetch();
        if(isset($utilizator->id)) {
            $_SESSION['user_id']    = $utilizator->id;
            $_SESSION['user_name']  = $utilizator->nume.' '.$utilizator->prenume;
            $_SESSION['user_role']   = $utilizator->rol;
            header('Location: '.$config['url']);
        }else{
            $loginError = true;
        }
    }
}

?>

<div class="box b">
    <div class="container">
        <div class="row">
            <div class="column half">
                <form action="<?php echo $config['url'].'login'; ?>" method="POST" name="loginForm">
                    <div class="row">
                        <div class="column full">
                            <h2>Login</h2>
                            <?php if($loginError) { ?><span class="text-rosu">Eroare, e-mail-ul nu exista sau parola nu este corecta.</span><?php } ?>
                            <label for="login_mail">Adresa e-mail</label>
                            <input type="mail" name="login_mail" placeholder="mail@domeniu.ro" required/>
                            <label for="login_password">Parola</label>
                            <input type="password" name="login_password" placeholder="*******" required/>
                            <br />
                            <input type="submit" name="login" value="Login"/>
                        </div>
                    </div>
                </form>
            </div>
            <div class="column half">
                <form action="<?php echo $config['url'].'login'; ?>" method="POST" name="registerForm">
                    <div class="row">
                        <div class="column full">
                            <h2>Creează un cont</h2>
                            <?php if($registerError) { ?><span class="text-rosu"><?php echo $registerErrorMessage; ?></span><?php } ?>
                            <label for="login_mail">Adresa e-mail</label>
                            <input type="mail" name="login_mail" placeholder="mail@domeniu.ro" required/>
                            <label for="login_password">Parola</label>
                            <input type="password" name="login_password" placeholder="*******" required/>
                            <label for="login_password_confirm">Confirmare parola</label>
                            <input type="password" name="login_password_confirm" placeholder="*******" required/>
                            <br />
                            <input type="submit" name="register" value="Creează un cont"/>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php

// Header
//require 'layout/footer.php';

?>