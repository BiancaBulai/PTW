<?php
session_start();

// Config
require '../config.php';

// Verificam daca este admin
if(!isset($_SESSION['user_role']) || (isset($_SESSION['user_role']) && $_SESSION['user_role'] != 'admin')) {
  header('Location: '.$config['url']);
  exit;
}

// Functii
require 'functions.php';

// Conector MySQL
$pdoConfig = array(
  PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
  PDO::ATTR_EMULATE_PREPARES   => false
);
$db = new PDO('mysql:host='.$config['db']['hostname'].';dbname='.$config['db']['database'].';charset=utf8', $config['db']['username'], $config['db']['password'], $pdoConfig);

// Prepare the route
$routeData      = explode('/', isset($_GET['route']) ? $_GET['route'] : '');
$_GET['route']  = $routeData[0];

// Ce pagina trebuie sa incarcam
$page = isset($_GET['route']) && $_GET['route'] != '' ? $_GET['route'] : 'retete';

// Verificam daca pagina exista, daca nu exista, 404 :)
if(!file_exists('pages/'.$page.'.php')) {
  exit('404');
}

// Setari default
$pageTitle    = '';
$currentMenu  = '';

// Pagina
require 'pages/'.$page.'.php';
