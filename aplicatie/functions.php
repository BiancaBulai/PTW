<?php

function convert_jsonfeed_to_rss($content = NULL, $max = NULL) {

    // Is it valid JSONFeed?
    $jsonFeed = json_decode($content, TRUE);
    if (!isset($jsonFeed['version'])) return FALSE;
    if (!isset($jsonFeed['title'])) return FALSE;
    if (!isset($jsonFeed['items'])) return FALSE;

    // Decode the feed to a PHP array
    $jf = json_decode($content, TRUE);

    // Get the latest item publish date to use as the channel pubDate
    $latestDate = 0;
    foreach ($jf['items'] as $item) {
        if (strtotime($item['date_published']) > $latestDate) $latestDate = strtotime($item['date_published']);
    }
    $lastBuildDate = date(DATE_RSS, $latestDate);

    // Create the RSS feed
    $xmlFeed = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><rss version="2.0"></rss>');
    $xmlFeed->addChild("channel");

    // Required elements
    $xmlFeed->channel->addChild("title", $jf['title']);
    $xmlFeed->channel->addChild("pubDate", $lastBuildDate);
    $xmlFeed->channel->addChild("lastBuildDate", $lastBuildDate);

    // Optional elements
    if (isset($jf['description'])) $xmlFeed->channel->description = $jf['description'];
    if (isset($jf['home_page_url'])) $xmlFeed->channel->link = $jf['home_page_url'];

    // Items
    foreach ($jf['items'] as $item) {

        $newItem = $xmlFeed->channel->addChild('item');

        // Standard stuff
        if (isset($item['id'])) $newItem->addChild('guid', $item['id']);
        if (isset($item['title'])) $newItem->addChild('title', $item['title']);
        if (isset($item['content_text'])) $newItem->addChild('description', $item['content_text']);
        if (isset($item['content_html'])) $newItem->addChild('description', $item['content_html']);
        if (isset($item['date_published'])) $newItem->addChild('pubDate', $item['date_published']);
        if (isset($item['url'])) $newItem->addChild('link', $item['url']);

        // Enclosures?
        if(isset($item['attachments'])) {
            foreach($item['attachments'] as $attachment) {
                $enclosure = $newItem->addChild('enclosure');
                $enclosure['url'] = $attachment['url'];
                $enclosure['type'] = $attachment['mime_type'];
                $enclosure['length'] = $attachment['size_in_bytes'];
            }
        }

    }

    $dom = new DOMDocument("1.0");
    $dom->preserveWhiteSpace = false;
    $dom->formatOutput = true;
    $dom->loadXML($xmlFeed->asXML());
    return $dom->saveXML();
    
}


function jsonToCsv ($json, $csvFilePath = false, $boolOutputFile = false) {
    
    // See if the string contains something
    if (empty($json)) { 
      die("The JSON string is empty!");
    }
    
    // If passed a string, turn it into an array
    if (is_array($json) === false) {
      $json = json_decode($json, true);
    }
    
    // If a path is included, open that file for handling. Otherwise, use a temp file (for echoing CSV string)
    if ($csvFilePath !== false) {
      $f = fopen($csvFilePath,'w+');
      if ($f === false) {
        die("Couldn't create the file to store the CSV, or the path is invalid. Make sure you're including the full path, INCLUDING the name of the output file (e.g. '../save/path/csvOutput.csv')");
      }
    }
    else {
      $boolEchoCsv = true;
      if ($boolOutputFile === true) {
        $boolEchoCsv = false;
      }
      $strTempFile = '/csvOutput' . date("U") . ".csv";
      $f = fopen($strTempFile,"w+");
    }
    
    $firstLineKeys = false;
    foreach ($json as $line) {
      if (empty($firstLineKeys)) {
        $firstLineKeys = array_keys($line);
        fputcsv($f, $firstLineKeys);
        $firstLineKeys = array_flip($firstLineKeys);
      }
      
      // Using array_merge is important to maintain the order of keys acording to the first element
      fputcsv($f, array_merge($firstLineKeys, $line));
    }
    fclose($f);
    
    // Take the file and put it to a string/file for output (if no save path was included in function arguments)
    if ($boolOutputFile === true) {
      if ($csvFilePath !== false) {
        $file = $csvFilePath;
      }
      else {
        $file = $strTempFile;
      }
      
      // Output the file to the browser (for open/save)
      if (file_exists($file)) {
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename='.basename($file));
        header('Content-Length: ' . filesize($file));
        readfile($file);
      }
    }
    elseif ($boolEchoCsv === true) {
      if (($handle = fopen($strTempFile, "r")) !== FALSE) {
        while (($data = fgetcsv($handle)) !== FALSE) {
          echo implode(",",$data);
          echo "<br />";
        }
        fclose($handle);
      }
    }
    
    // Delete the temp file
    unlink($strTempFile);
    
  }