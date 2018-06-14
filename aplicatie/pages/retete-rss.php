<?php

// Aducem reteta
$objRetete = $db->query('SELECT r.*, b.url as urlbucatarie, re.url as urlregim, s.url as urlstil, m.numemasa  FROM retete r LEFT JOIN bucatarii b ON b.idbucatarie = r.bucatarieid LEFT JOIN mese m ON m.idmasa = r.masaid LEFT JOIN regim re ON re.idregim = r.regimid LEFT JOIN stil s ON s.idstil = r.stilid')->fetchAll();


$output = array();
$output['items']   = array();

foreach($objRetete as $reteta) {

  if($reteta->urlbucatarie != '') { $cat = 'preferinte-alimentare/'.$reteta->urlbucatarie; }
  if($reteta->urlregim != '') { $cat = 'restrictii-alimentare/'.$reteta->urlregim; }
  if($reteta->urlstil != '') { $cat = 'stil-de-viata/'.$reteta->urlstil; }

  $output['items'][] = array(
    'id' => $reteta->idreteta,
    'url' => $config['url'].$cat.'/'.$reteta->url,
    'title' => $reteta->titlu,
    'content_html' => '',
    'date_published' => date('Y-m-d H:i:s')
  );
}

// RSS details
$output['version'] = 'https://jsonfeed.org/version/1';
$output['title']   = 'Retete';

// RSS encode
echo convert_jsonfeed_to_rss(json_encode($output));

?>