<?php
session_start();

// initializing variables
$email    = "";
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'ptw');

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
    $nume=mysqli_real_escape_string($db,$_POST['nume']);
    $prenume=mysqli_real_escape_string($db,$_POST['prenume']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
  $parola_1 = mysqli_real_escape_string($db, $_POST['parola_1']);
  $parola_2 = mysqli_real_escape_string($db, $_POST['parola_2']);
  $data=mysqli_real_escape_string($db,$_POST['datanasterii']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
    if (empty($nume)) { array_push($errors, "Introduceti numele."); }
    if (empty($prenume)) { array_push($errors, "Introduceti prenumele."); }
    if (empty($email)) { array_push($errors, "Introduceti emailul."); }
  if (empty($parola_1)) { array_push($errors, "Introduceti parola."); }
    if (empty($data)) { array_push($errors, "Introduceti data nasterii."); }
  if ($parola_1 != $parola_2) {
	array_push($errors, "Parolele nu se potrivesc.");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM utilizatori WHERE email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists

    if ($user['email'] === $email) {
      array_push($errors, "Emailul exista.");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$parola = md5($parola_1);//encrypt the password before saving in the database

  	$query = "INSERT INTO utilizatori (nume,prenume,email, parola,datanasterii) 
  			  VALUES('$nume','$prenume','$email', '$parola','$data')";
  	mysqli_query($db, $query);
  	$_SESSION['email'] = $email;
  	$_SESSION['success'] = "Inregistrarea s-a efectuat cu succes.";
  	header('location: login.php');
  }
}
if (isset($_POST['login_user'])) {
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $parola = mysqli_real_escape_string($db, $_POST['parola']);

  if (empty($email)) {
    array_push($errors, "Introduceti email.");
  }
  if (empty($parola)) {
    array_push($errors, "Introduceti parola.");
  }

  if (count($errors) == 0) {
    $parola = md5($parola);
    $query = "SELECT * FROM utilizatori WHERE email='$email' AND parola='$parola'";
    $results = mysqli_query($db, $query);
    if (mysqli_num_rows($results) == 1) {
      $_SESSION['email'] = $email;
      $_SESSION['success'] = "Autentificarea s-a facut cu succes";
      header('location: personalinfo.php');
    }else {
      array_push($errors, "Combinatia  a fost gresita.Incercati din nou");
    }
  }
}

?>