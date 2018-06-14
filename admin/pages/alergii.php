<?php
// Setari pagina
$currentMenu  = 'alergii';
$pageTitle    = 'Alergii';

// Header
require 'layout/header.php';

// Actiune salvare
if(isset($_POST['save'])) {

    if(isset($_POST['alergie_id']) && $_POST['alergie_id'] > 0) { 
        $db->prepare("UPDATE alergii SET numealergie = ? WHERE idalergie = ?")->execute(array($_POST['alergie_nume'], $_POST['alergie_id']));
    }else{ 
        $db->prepare("INSERT INTO alergii (numealergie) VALUES (?)")->execute(array($_POST['alergie_nume']));
    }
    header('Location: '.$config['url'].'admin/'.$currentMenu.'?salvat');

}

?>

<?php if(!empty($routeData[1]) && $routeData[1] == 'adauga') { 
    require 'alergii_form.php';
}elseif(!empty($routeData[1]) && $routeData[1] == 'modifica' && !empty($routeData[2])) { 
    $alergie = $db->prepare('SELECT * FROM alergii WHERE idalergie = ?');
    $alergie->execute(array($routeData[2]));
    $alergie = $alergie->fetch();
    require 'alergii_form.php';
}elseif(!empty($routeData[1]) && $routeData[1] == 'sterge' && !empty($routeData[2])) { 
    $db->prepare('DELETE FROM alergii WHERE idalergie = ?')->execute(array($routeData[2]));
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
            <?php foreach($db->query('SELECT * FROM alergii ORDER BY idalergie DESC') as $alergie) { ?>
            <tr>
                <td><?php echo $alergie->idalergie; ?></td>
                <td><?php echo $alergie->numealergie; ?></td>
                <td><a href="<?php echo $config['url'].'admin/'.$currentMenu.'/modifica/'.$alergie->idalergie; ?>">Modifica</a> | <a href="<?php echo $config['url'].'admin/'.$currentMenu.'/sterge/'.$alergie->idalergie; ?>">Sterge</a></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
<?php } ?>

<?php
// Header
require 'layout/footer.php';
?>