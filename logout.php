<?php

// Verificam daca este deja logat
if(isset($_SESSION['user_id'])) {
    session_unset();
    header('Location: '.$config['url'].'login');
}
?>