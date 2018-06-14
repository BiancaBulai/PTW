<?php
// Setari pagina
$currentMenu  = 'boli';
$pageTitle    = 'Boli';

// Header
require 'layout/header.php';

// Actiune salvare
if(isset($_POST['save'])) {

    if(isset($_POST['boala_id']) && $_POST['boala_id'] > 0) { 
        $db->prepare("UPDATE boli SET numeboala = ? WHERE idboala = ?")->execute(array($_POST['boala_nume'], $_POST['boala_id']));
    }else{ 
        $db->prepare("INSERT INTO boli (numeboala) VALUES (?)")->execute(array($_POST['boala_nume']));
    }
    header('Location: '.$config['url'].'admin/'.$currentMenu.'?salvat');

}

?>

<?php if(!empty($routeData[1]) && $routeData[1] == 'adauga') { 
    require 'boli_form.php';
}elseif(!empty($routeData[1]) && $routeData[1] == 'modifica' && !empty($routeData[2])) { 
    $boala = $db->prepare('SELECT * FROM boli WHERE idboala = ?');
    $boala->execute(array($routeData[2]));
    $boala = $boala->fetch();
    require 'boli_form.php';
}elseif(!empty($routeData[1]) && $routeData[1] == 'sterge' && !empty($routeData[2])) { 
    $db->prepare('DELETE FROM boli WHERE idboala = ?')->execute(array($routeData[2]));
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
            <?php foreach($db->query('SELECT * FROM boli ORDER BY idboala DESC') as $boala) { ?>
            <tr>
                <td><?php echo $boala->idboala; ?></td>
                <td><?php echo $boala->numeboala; ?></td>
                <td><a href="<?php echo $config['url'].'admin/'.$currentMenu.'/modifica/'.$boala->idboala; ?>">Modifica</a> | <a href="<?php echo $config['url'].'admin/'.$currentMenu.'/sterge/'.$boala->idboala; ?>">Sterge</a></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
<?php } ?>

<?php
// Header
require 'layout/footer.php';
?>