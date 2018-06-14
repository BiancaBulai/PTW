<?php
// Setari pagina
$currentMenu  = 'utilizatori';
$pageTitle    = 'utilizatori';

// Header
require 'layout/header.php';

// Actiune salvare
if(isset($_POST['save'])) {

    if(isset($_POST['utilizator_id']) && $_POST['utilizator_id'] > 0) { 
        $db->prepare("UPDATE utilizatori SET nume = ?, prenume = ?, email = ?, datanasterii = ?, rol = ? WHERE id = ?")->execute(array($_POST['utilizator_nume'], $_POST['utilizator_prenume'], $_POST['utilizator_mail'], date('Y-m-d', strtotime($_POST['utilizator_data_nasterii'])), $_POST['utilizator_rol'], $_POST['utilizator_id']));
        if(isset($_POST['utilizator_parola']) && $_POST['utilizator_parola'] != '') {
            $db->prepare("UPDATE utilizatori SET parola = ? WHERE id = ?")->execute(array(md5($_POST['utilizator_parola']), $_POST['utilizator_id']));
        }
    }else{ 
        $db->prepare("INSERT INTO utilizatori (nume, prenume, email, datanasterii, rol, parola) VALUES (?, ?, ?, ?, ?, ?)")->execute(array($_POST['utilizator_nume'], $_POST['utilizator_prenume'], $_POST['utilizator_mail'], date('Y-m-d', strtotime($_POST['utilizator_data_nasterii'])), $_POST['utilizator_rol'], md5($_POST['utilizator_parola'])));
    }
    header('Location: '.$config['url'].'admin/'.$currentMenu.'?salvat');

}

?>

<?php if(!empty($routeData[1]) && $routeData[1] == 'adauga') { 
    require 'utilizatori_form.php';
}elseif(!empty($routeData[1]) && $routeData[1] == 'modifica' && !empty($routeData[2])) { 
    $utilizator = $db->prepare('SELECT * FROM utilizatori WHERE id = ?');
    $utilizator->execute(array($routeData[2]));
    $utilizator = $utilizator->fetch();
    require 'utilizatori_form.php';
}elseif(!empty($routeData[1]) && $routeData[1] == 'sterge' && !empty($routeData[2])) { 
    $db->prepare('DELETE FROM utilizatori WHERE id = ?')->execute(array($routeData[2]));
    header('Location: '.$config['url'].'admin/'.$currentMenu.'?sters');
}else{ ?>
    <?php if(isset($_GET['salvat'])) { ?><p class="text-verde"><i>(!) Datele au fost salvate cu succes.</i></p> <?php } ?>
    <?php if(isset($_GET['sters'])) { ?><p class="text-rosu"><i>(!) Datele au fost sterse cu succes.</i></p> <?php } ?>
    <table width="100%">
        <thead>
            <tr class="table-header">
                <td width="10%">ID</td>
                <td>Nume</td>
                <td>Rol</td>
                <td>Mail</td>
                <td>Data nasterii</td>
                <td width="10%"><a href="<?php echo $config['url'].'admin/'.$currentMenu.'/adauga'; ?>">Adauga</a></td>
            </tr>
        </thead>
        <tbody>
            <?php foreach($db->query('SELECT * FROM utilizatori ORDER BY id DESC') as $utilizator) { ?>
            <tr>
                <td><?php echo $utilizator->id; ?></td>
                <td><?php echo $utilizator->nume.' '.$utilizator->prenume; ?></td>
                <td><?php echo $utilizator->rol; ?></td>
                <td><a href="mailto:<?php echo $utilizator->email; ?>"><?php echo $utilizator->email; ?></a></td>
                <td><?php echo $utilizator->datanasterii; ?></td>
                <td><a href="<?php echo $config['url'].'admin/'.$currentMenu.'/modifica/'.$utilizator->id; ?>">Modifica</a> | <a href="<?php echo $config['url'].'admin/'.$currentMenu.'/sterge/'.$utilizator->id; ?>">Sterge</a></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
<?php } ?>

<?php
// Header
require 'layout/footer.php';
?>