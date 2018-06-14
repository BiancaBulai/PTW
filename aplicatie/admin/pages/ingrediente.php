<?php
// Setari pagina
$currentMenu  = 'ingrediente';
$pageTitle    = 'Ingrediente';

// Header
require 'layout/header.php';

// Actiune salvare
if(isset($_POST['save'])) {

    if(isset($_POST['ingredient_id']) && $_POST['ingredient_id'] > 0) { 
        $db->prepare("UPDATE ingrediente SET numeingredient = ? WHERE idingredient = ?")->execute(array($_POST['ingredient_nume'], $_POST['ingredient_id']));
    }else{ 
        $db->prepare("INSERT INTO ingrediente (numeingredient) VALUES (?)")->execute(array($_POST['ingredient_nume']));
    }
    header('Location: '.$config['url'].'admin/'.$currentMenu.'?salvat');

}

?>

<?php if(!empty($routeData[1]) && $routeData[1] == 'adauga') { 
    require 'ingrediente_form.php';
}elseif(!empty($routeData[1]) && $routeData[1] == 'modifica' && !empty($routeData[2])) { 
    $ingredient = $db->prepare('SELECT * FROM ingrediente WHERE idingredient = ?');
    $ingredient->execute(array($routeData[2]));
    $ingredient = $ingredient->fetch();
    require 'ingrediente_form.php';
}elseif(!empty($routeData[1]) && $routeData[1] == 'sterge' && !empty($routeData[2])) { 
    $db->prepare('DELETE FROM ingrediente WHERE idingredient = ?')->execute(array($routeData[2]));
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
            <?php foreach($db->query('SELECT * FROM ingrediente ORDER BY idingredient DESC') as $ingredient) { ?>
            <tr>
                <td><?php echo $ingredient->idingredient; ?></td>
                <td><?php echo $ingredient->numeingredient; ?></td>
                <td><a href="<?php echo $config['url'].'admin/'.$currentMenu.'/modifica/'.$ingredient->idingredient; ?>">Modifica</a> | <a href="<?php echo $config['url'].'admin/'.$currentMenu.'/sterge/'.$ingredient->idingredient; ?>">Sterge</a></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
<?php } ?>

<?php
// Header
require 'layout/footer.php';
?>