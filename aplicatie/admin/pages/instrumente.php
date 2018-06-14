<?php
// Setari pagina
$currentMenu  = 'instrumente';
$pageTitle    = 'Instrumente';

// Header
require 'layout/header.php';

// Actiune salvare
if(isset($_POST['save'])) {

    if(isset($_POST['instrument_id']) && $_POST['instrument_id'] > 0) { 
        $db->prepare("UPDATE instrumente SET numeinstrument = ? WHERE idinstrument = ?")->execute(array($_POST['instrument_nume'], $_POST['instrument_id']));
    }else{ 
        $db->prepare("INSERT INTO instrumente (numeinstrument) VALUES (?)")->execute(array($_POST['instrument_nume']));
    }
    header('Location: '.$config['url'].'admin/'.$currentMenu.'?salvat');

}

?>

<?php if(!empty($routeData[1]) && $routeData[1] == 'adauga') { 
    require 'instrumente_form.php';
}elseif(!empty($routeData[1]) && $routeData[1] == 'modifica' && !empty($routeData[2])) { 
    $instrument = $db->prepare('SELECT * FROM instrumente WHERE idinstrument = ?');
    $instrument->execute(array($routeData[2]));
    $instrument = $instrument->fetch();
    require 'instrumente_form.php';
}elseif(!empty($routeData[1]) && $routeData[1] == 'sterge' && !empty($routeData[2])) { 
    $db->prepare('DELETE FROM instrumente WHERE idinstrument = ?')->execute(array($routeData[2]));
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
            <?php foreach($db->query('SELECT * FROM instrumente ORDER BY idinstrument DESC') as $instrument) { ?>
            <tr>
                <td><?php echo $instrument->idinstrument; ?></td>
                <td><?php echo $instrument->numeinstrument; ?></td>
                <td><a href="<?php echo $config['url'].'admin/'.$currentMenu.'/modifica/'.$instrument->idinstrument; ?>">Modifica</a> | <a href="<?php echo $config['url'].'admin/'.$currentMenu.'/sterge/'.$instrument->idinstrument; ?>">Sterge</a></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
<?php } ?>

<?php
// Header
require 'layout/footer.php';
?>