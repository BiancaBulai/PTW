<?php
// Setari pagina
$currentMenu  = 'bucatarii';
$pageTitle    = 'Bucatarii';

// Header
require 'layout/header.php';

// Actiune salvare
if(isset($_POST['save'])) {

    if(isset($_POST['bucatarie_id']) && $_POST['bucatarie_id'] > 0) { 
        $db->prepare("UPDATE bucatarii SET numebucatarie = ?, url = ? WHERE idbucatarie = ?")->execute(array($_POST['bucatarie_nume'], slugify($_POST['bucatarie_nume']), $_POST['bucatarie_id']));
        $idBucatarie = $_POST['bucatarie_id'];
    }else{ 
        $db->prepare("INSERT INTO bucatarii (numebucatarie, url) VALUES (?, ?)")->execute(array($_POST['bucatarie_nume'], slugify($_POST['bucatarie_nume'])));
        $idBucatarie = $db->lastInsertId();
    }

    // Salvare imagine
    if(isset($_FILES['bucatarie_imagine']) && $_FILES['bucatarie_imagine']['tmp_name'] != '') {
        if(in_array(mime_content_type($_FILES['bucatarie_imagine']['tmp_name']), array('image/png', 'image/jpeg', 'image/jpg'))) {
            $fileInfo = pathinfo($_FILES['bucatarie_imagine']['name']);
            $newFileName = md5(rand(1000000, 9999999).time()).'.'.$fileInfo['extension'];
            move_uploaded_file($_FILES['bucatarie_imagine']['tmp_name'], __DIR__.'/../../files/'.$newFileName); 
            $db->prepare("UPDATE bucatarii SET imagine = ? WHERE idbucatarie = ?")->execute(array('files/'.$newFileName, $idBucatarie));
        }
    }

    header('Location: '.$config['url'].'admin/'.$currentMenu.'?salvat');

}

?>

<?php if(!empty($routeData[1]) && $routeData[1] == 'adauga') { 
    require 'bucatarii_form.php';
}elseif(!empty($routeData[1]) && $routeData[1] == 'modifica' && !empty($routeData[2])) { 
    $bucatarie = $db->prepare('SELECT * FROM bucatarii WHERE idbucatarie = ?');
    $bucatarie->execute(array($routeData[2]));
    $bucatarie = $bucatarie->fetch();
    require 'bucatarii_form.php';
}elseif(!empty($routeData[1]) && $routeData[1] == 'sterge' && !empty($routeData[2])) { 
    $db->prepare('DELETE FROM bucatarii WHERE idbucatarie = ?')->execute(array($routeData[2]));
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
            <?php foreach($db->query('SELECT * FROM bucatarii ORDER BY idbucatarie DESC') as $bucatarie) { ?>
            <tr>
                <td><?php echo $bucatarie->idbucatarie; ?></td>
                <td><?php echo $bucatarie->numebucatarie; ?></td>
                <td><a href="<?php echo $config['url'].'admin/'.$currentMenu.'/modifica/'.$bucatarie->idbucatarie; ?>">Modifica</a> | <a href="<?php echo $config['url'].'admin/'.$currentMenu.'/sterge/'.$bucatarie->idbucatarie; ?>">Sterge</a></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
<?php } ?>

<?php
// Header
require 'layout/footer.php';
?>