<?php
// Porneste sesiunea
session_start();

// Config
require 'config.php';

// Functii
require 'functions.php';

// Conector MySQL
$pdoConfig = array(
  // Afisare erori
  PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
  // Intoarce rezultatele din interogare sub forma de obiect
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
);
$db = new PDO('mysql:host='.$config['db']['hostname'].';dbname='.$config['db']['database'].';charset=utf8', $config['db']['username'], $config['db']['password'], $pdoConfig);

// Prepare the route
$routeData      = explode('/', isset($_GET['route']) ? $_GET['route'] : '');
$_GET['route']  = $routeData[0];

// Ce pagina trebuie sa incarcam
$page = isset($_GET['route']) && $_GET['route'] != '' ? $_GET['route'] : 'home';

// Verificam daca pagina exista, daca nu exista, 404 :)
if(!file_exists('pages/'.$page.'.php')) {
  exit('404');
}

// Setari default
$pageTitle    = 'Acasa';
$currentMenu  = 'acasa';

// Pagina
require 'pages/'.$page.'.php';