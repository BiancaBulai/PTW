<?php
// Setari pagina
$currentMenu  = 'preparare';
$pageTitle    = 'Preparare';

// Header
require 'layout/header.php';

// Actiune salvare
if(isset($_POST['save'])) {

    if(isset($_POST['preparare_id']) && $_POST['preparare_id'] > 0) { 
        $db->prepare("UPDATE preparare SET metodapreparare = ? WHERE idpreparare = ?")->execute(array($_POST['preparare_nume'], $_POST['preparare_id']));
    }else{ 
        $db->prepare("INSERT INTO preparare (metodapreparare) VALUES (?)")->execute(array($_POST['preparare_nume']));
    }
    header('Location: '.$config['url'].'admin/'.$currentMenu.'?salvat');

}

?>

<?php if(!empty($routeData[1]) && $routeData[1] == 'adauga') { 
    require 'preparare_form.php';
}elseif(!empty($routeData[1]) && $routeData[1] == 'modifica' && !empty($routeData[2])) { 
    $preparare = $db->prepare('SELECT * FROM preparare WHERE idpreparare = ?');
    $preparare->execute(array($routeData[2]));
    $preparare = $preparare->fetch();
    require 'alergii_form.php';
}elseif(!empty($routeData[1]) && $routeData[1] == 'sterge' && !empty($routeData[2])) { 
    $db->prepare('DELETE FROM preparare WHERE idpreparare = ?')->execute(array($routeData[2]));
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
            <?php foreach($db->query('SELECT * FROM preparare ORDER BY idpreparare DESC') as $preparare) { ?>
            <tr>
                <td><?php echo $preparare->idpreparare; ?></td>
                <td><?php echo $preparare->metodapreparare; ?></td>
                <td><a href="<?php echo $config['url'].'admin/'.$currentMenu.'/modifica/'.$preparare->idpreparare; ?>">Modifica</a> | <a href="<?php echo $config['url'].'admin/'.$currentMenu.'/sterge/'.$preparare->idpreparare; ?>">Sterge</a></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
<?php } ?>

<?php
// Header
require 'layout/footer.php';
?> 