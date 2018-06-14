<?php
// Setari pagina
$currentMenu  = 'regim';
$pageTitle    = 'Regim';

// Header
require 'layout/header.php';

// Actiune salvare
if(isset($_POST['save'])) {

    if(isset($_POST['regim_id']) && $_POST['regim_id'] > 0) { 
        $db->prepare("UPDATE regim SET numeregim = ?, url = ? WHERE idregim = ?")->execute(array($_POST['regim_nume'], slugify($_POST['regim_nume']), $_POST['regim_imagine']));
        $idRegim = $_POST['regim_id'];
    }else{ 
        $db->prepare("INSERT INTO regim (numeregim, url) VALUES (?, ?)")->execute(array($_POST['regim_nume'], slugify($_POST['regim_nume'])));
        $idRegim = $db->lastInsertId();
    }

    // Salvare imagine
    if(isset($_FILES['regim_imagine']) && $_FILES['regim_imagine']['tmp_name'] != '') {
        if(in_array(mime_content_type($_FILES['regim_imagine']['tmp_name']), array('image/png', 'image/jpeg', 'image/jpg'))) {
            $fileInfo = pathinfo($_FILES['regim_imagine']['name']);
            $newFileName = md5(rand(1000000, 9999999).time()).'.'.$fileInfo['extension'];
            move_uploaded_file($_FILES['regim_imagine']['tmp_name'], __DIR__.'/../../files/'.$newFileName); 
            $db->prepare("UPDATE regim SET imagine = ? WHERE idregim = ?")->execute(array('files/'.$newFileName, $idRegim));
        }
    }

    header('Location: '.$config['url'].'admin/'.$currentMenu.'?salvat');

}

?>

<?php if(!empty($routeData[1]) && $routeData[1] == 'adauga') { 
    require 'regim_form.php';
}elseif(!empty($routeData[1]) && $routeData[1] == 'modifica' && !empty($routeData[2])) { 
    $regim = $db->prepare('SELECT * FROM regim WHERE idregim = ?');
    $regim->execute(array($routeData[2]));
    $regim = $regim->fetch();
    require 'regim_form.php';
}elseif(!empty($routeData[1]) && $routeData[1] == 'sterge' && !empty($routeData[2])) { 
    $db->prepare('DELETE FROM regim WHERE idregim = ?')->execute(array($routeData[2]));
    header('Location: '.$config['url'].'admin/'.$currentMenu.'?sters');
}else{ ?>
    <?php if(isset($_GET['salvat'])) { ?><p class="text-verde"><i>(!) Datele au fost salvate cu succes.</i></p> <?php } ?>
    <?php if(isset($_GET['sters'])) { ?><p class="text-rosu"><i>(!) Datele au fost sterse cu succes.</i></p> <?php } ?>
    <table width="100%">
        <thead>
            <tr class="table-header">
                <td width="10%">ID</td>
                <td>Nume</td>
                <td width="10%"><a href="<?php echo $config['url'].'admin/'.$currentMenu.'/adauga'; ?>">Adauga</a></td>
            </tr>
        </thead>
        <tbody>
            <?php foreach($db->query('SELECT * FROM regim ORDER BY idregim DESC') as $regim) { ?>
            <tr>
                <td><?php echo $regim->idregim; ?></td>
                <td><?php echo $regim->numeregim; ?></td>
                <td><a href="<?php echo $config['url'].'admin/'.$currentMenu.'/modifica/'.$regim->idregim; ?>">Modifica</a> | <a href="<?php echo $config['url'].'admin/'.$currentMenu.'/sterge/'.$regim->idregim; ?>">Sterge</a></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
<?php } ?>

<?php
// Header
require 'layout/footer.php';
?>