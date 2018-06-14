<?php
// Setari pagina
$currentMenu  = 'stil';
$pageTitle    = 'Stil';

// Header
require 'layout/header.php';

// Actiune salvare
if(isset($_POST['save'])) {

    if(isset($_POST['stil_id']) && $_POST['stil_id'] > 0) { 
        $db->prepare("UPDATE stil SET numestil = ?, url = ? WHERE idstil = ?")->execute(array($_POST['stil_nume'], slugify($_POST['stil_nume']), $_POST['stil_id']));
        $idStil = $_POST['stil_id'];
    }else{ 
        $db->prepare("INSERT INTO stil (numestil, url) VALUES (?, ?)")->execute(array($_POST['stil_nume'], slugify($_POST['stil_nume'])));
        $idStil = $db->lastInsertId();
    }

    // Salvare imagine
    if(isset($_FILES['stil_imagine']) && $_FILES['stil_imagine']['tmp_name'] != '') {
        if(in_array(mime_content_type($_FILES['stil_imagine']['tmp_name']), array('image/png', 'image/jpeg', 'image/jpg'))) {
            $fileInfo = pathinfo($_FILES['stil_imagine']['name']);
            $newFileName = md5(rand(1000000, 9999999).time()).'.'.$fileInfo['extension'];
            move_uploaded_file($_FILES['stil_imagine']['tmp_name'], __DIR__.'/../../files/'.$newFileName); 
            $db->prepare("UPDATE stil SET imagine = ? WHERE idstil = ?")->execute(array('files/'.$newFileName, $idStil));
        }
    }

    header('Location: '.$config['url'].'admin/'.$currentMenu.'?salvat');

}

?>

<?php if(!empty($routeData[1]) && $routeData[1] == 'adauga') { 
    require 'stil_form.php';
}elseif(!empty($routeData[1]) && $routeData[1] == 'modifica' && !empty($routeData[2])) { 
    $stil = $db->prepare('SELECT * FROM stil WHERE idstil = ?');
    $stil->execute(array($routeData[2]));
    $stil = $stil->fetch();
    require 'stil_form.php';
}elseif(!empty($routeData[1]) && $routeData[1] == 'sterge' && !empty($routeData[2])) { 
    $db->prepare('DELETE FROM stil WHERE idstil = ?')->execute(array($routeData[2]));
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
            <?php foreach($db->query('SELECT * FROM stil ORDER BY idstil DESC') as $stil) { ?>
            <tr>
                <td><?php echo $stil->idstil; ?></td>
                <td><?php echo $stil->numestil; ?></td>
                <td><a href="<?php echo $config['url'].'admin/'.$currentMenu.'/modifica/'.$stil->idstil; ?>">Modifica</a> | <a href="<?php echo $config['url'].'admin/'.$currentMenu.'/sterge/'.$stil->idstil; ?>">Sterge</a></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
<?php } ?>

<?php
// Header
require 'layout/footer.php';
?>