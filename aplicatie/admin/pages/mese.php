<?php
// Setari pagina
$currentMenu  = 'mese';
$pageTitle    = 'Mese';

// Header
require 'layout/header.php';

// Actiune salvare
if(isset($_POST['save'])) {

    if(isset($_POST['masa_id']) && $_POST['masa_id'] > 0) { 
        $db->prepare("UPDATE mese SET numemasa = ? WHERE idmasa = ?")->execute(array($_POST['masa_nume'], $_POST['masa_id']));
    }else{ 
        $db->prepare("INSERT INTO mese (numemasa) VALUES (?)")->execute(array($_POST['masa_nume']));
    }
    header('Location: '.$config['url'].'admin/'.$currentMenu.'?salvat');

}

?>

<?php if(!empty($routeData[1]) && $routeData[1] == 'adauga') { 
    require 'mese_form.php';
}elseif(!empty($routeData[1]) && $routeData[1] == 'modifica' && !empty($routeData[2])) { 
    $masa = $db->prepare('SELECT * FROM mese WHERE idmasa = ?');
    $masa->execute(array($routeData[2]));
    $masa = $masa->fetch();
    require 'mese_form.php';
}elseif(!empty($routeData[1]) && $routeData[1] == 'sterge' && !empty($routeData[2])) { 
    $db->prepare('DELETE FROM mese WHERE idmasa = ?')->execute(array($routeData[2]));
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
            <?php foreach($db->query('SELECT * FROM mese ORDER BY idmasa DESC') as $masa) { ?>
            <tr>
                <td><?php echo $masa->idmasa; ?></td>
                <td><?php echo $masa->numemasa; ?></td>
                <td><a href="<?php echo $config['url'].'admin/'.$currentMenu.'/modifica/'.$masa->idmasa; ?>">Modifica</a> | <a href="<?php echo $config['url'].'admin/'.$currentMenu.'/sterge/'.$masa->idmasa; ?>">Sterge</a></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
<?php } ?>

<?php
// Header
require 'layout/footer.php';
?>