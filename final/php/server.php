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
// Add recipes

if(isset($_POST['reg_reteta']))
{
    $titlu=mysqli_real_escape_string($db,$_POST['titlu']);
    $durata=mysqli_real_escape_string($db,$_POST['durata']);
    $minute = mysqli_real_escape_string($db, $_POST['minute']);
    $numemasa = mysqli_real_escape_string($db, $_POST['numemasa']);
    $numebucatarii = mysqli_real_escape_string($db, $_POST['numebucatarie']);
    $numepreparare=mysqli_real_escape_string($db,$_POST['metodapreparare']);
    $numeingrediente=mysqli_real_escape_string($db,$_POST['numeingredient']);
    $gramaj=mysqli_real_escape_string($db,$_POST['gramaj']);
    $unitate=mysqli_real_escape_string($db,$_POST['unitate']);
    $instrumente=mysqli_real_escape_string($db,$_POST['numeinstrument']);
    $boli=mysqli_real_escape_string($db,$_POST['numeboala']);
    $regim=mysqli_real_escape_string($db,$_POST['numeregim']);
    $alergii=mysqli_real_escape_string($db,$_POST['numealergie']);
    $pasi=mysqli_real_escape_string($db,$_POST['textpas']);
    $cale=mysqli_real_escape_string($db,$_POST['cale']);

    // form validation: ensure that the form is correctly filled ...
echo $titlu;
    if (empty($titlu)) { array_push($errors, "Introduceti numele retetei."); }
    if (empty($durata)) { array_push($errors, "Introduceti durata."); }
    if (empty($minute)) { array_push($errors, "Introduceti timpul."); }
    if (empty($numemasa)) { array_push($errors, "Introduceti numele mesei."); }
    if (empty($numebucatarii)) { array_push($errors, "Introduceti numele bucatariei din care face parte."); }
    if (empty($numepreparare)) { array_push($errors, "Introduceti modul de preparare."); }
    if (empty($numeingrediente)) { array_push($errors, "Introduceti ingredientele."); }
    if (empty($gramaj)) { array_push($errors, "Introduceti cantitatea ingredientelor folosite."); }
    if (empty($unitate)) { array_push($errors, "Introduceti unitatea de masura."); }
    if (empty($instrumente)) { array_push($errors, "Introduceti instrumentele necesare."); }
    if (empty($boli)) { array_push($errors, "Introduceti bolile pentru care este recomandata reteta."); }
    if (empty($regim)) { array_push($errors, "Introduceti regimul pentru care este recomandata reteta."); }
    if (empty($alergii)) { array_push($errors, "Introduceti alergiile pentru care este recomandata reteta."); }
    if (empty($pasi)) { array_push($errors, "Introduceti pasii necesari realizarii retetei."); }
    if (empty($cale)) { array_push($errors, "Introduceti calea spre imagine ."); }
    // first check the database to make sure
    // a recipe does not already exist with the same title
    $user_check_query = "SELECT * FROM retete WHERE titlu=$titlu LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $reteta = mysqli_fetch_assoc($result);
    if ($reteta) { // if user exists

        if ($user['titlu'] === $titlu) {
            array_push($errors, "Reteta exista.");
        }
    }
    if (count($errors) == 0) {
        $query="INSERT INTO imagini(cale) VALUES('$cale')";
        $query1="INSERT INTO cantitate(gramaj, unitate) VALUES ('$gramaj','$unitate')";
        $query2= "INSERT INTO ingrediente(numeingredient,cantitateid) VALUES ('$numeingrediente',Last_INSERT_ID())";
        $query3="INSERT INTO timp (durata, minute) VALUES('$durata','$minute')";
        $query4= "INSERT INTO mese (numemasa) VALUES('$numemasa')";
        $query5= "INSERT INTO bucatarii(numebucatarie) VALUES('$numebucatarii')";
        $query6= "INSERT INTO preparare(metodapreparare) VALUES ('$numepreparare')";
        $query7= "INSERT INTO instrumente(numeinstrument) VALUES ('$instrumente')";
        $query8= "INSERT INTO boli(numeboala) VALUES ('$boli')";
        $query9= "INSERT INTO regim(numeregim) VALUES ('$regim')";
        $query10= "INSERT INTO alergii(numealergie) VALUES ('$alergii')";
        $query11= "INSERT INTO pasi(textpas) VALUES ('$pasi')";
        $query12 = "INSERT INTO retete (idreteta, titlu,pasid,masaid,timpid,bucatarieid,preparareid,instrumentid,ingredientid,imaginiid)
 VALUES(Last_Insert_ID(),'$titlu',Last_Insert_ID(),Last_Insert_ID(),Last_Insert_ID(),Last_Insert_ID(),Last_Insert_ID(),Last_Insert_ID(),Last_Insert_ID(),Last_Insert_ID())";
        mysqli_query($db, $query);
        mysqli_query($db, $query1);
        mysqli_query($db, $query2);
        mysqli_query($db, $query3);
        mysqli_query($db, $query4);
        mysqli_query($db, $query5);
        mysqli_query($db, $query6);
        mysqli_query($db, $query7);
        mysqli_query($db, $query8);
        mysqli_query($db, $query9);
        mysqli_query($db, $query10);
        mysqli_query($db, $query11);
        mysqli_query($db, $query12);
        $_SESSION['titlu'] = $titlu;
        $_SESSION['success'] = "Adaugarea retetei s-a efectuat cu succes.";
        header('location: personalinfo.php');
    }

}

?>