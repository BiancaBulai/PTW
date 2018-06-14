<?php

// Aducem reteta
$objReteta = $db->query('SELECT r.*, b.numebucatarie, re.numeregim, m.numemasa, s.numestil FROM retete r LEFT JOIN bucatarii b ON b.idbucatarie = r.bucatarieid LEFT JOIN mese m ON m.idmasa = r.masaid LEFT JOIN regim re ON re.idregim = r.regimid LEFT JOIN stil s ON s.idstil = r.stilid')->fetchAll();

// JSON encode
echo json_encode($objReteta);


?>