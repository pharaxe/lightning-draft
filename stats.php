<html>
<head>
   <link rel="stylesheet" href="styles.css">
</head>
<body>
<?php

require __DIR__ . '/vendor/autoload.php';

$published_sheet = "http://docs.google.com/spreadsheets/d/e/2PACX-1vSw505SA4teYRUl7tqpmdaLMHDCgzzZ7dNG3LgR3cIGKcAbp0UM932JjQrxZzi_9NHzNqpPsj9ffXuO/pub?gid=0&single=true&output=csv";


$user_request = $_SERVER['REQUEST_URI'];
$url = $published_sheet;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HEADER, 0);
$curl_scraped_page = curl_exec($ch);
curl_close($ch);

$data = str_getcsv($curl_scraped_page, "\n");
foreach ($data as &$row) $row = str_getcsv($row);

// trim the beginning and end of the rows
foreach ($data as &$row) {
   array_shift($row);
   array_pop($row);
}

unset($data[21]); // get rid of double pick reminder.
unset($data[0]); // get rid of column headers.

$picks = array();
foreach ($data as $row) {
   foreach ($row as $cell) {
      if (!empty($cell)) {
         $picks[] = $cell;
      }
   }
}

$color_count = array(
 'White' => 0,
 'Blue' => 0,
 'Black' => 0,
 'Red' => 0,
 'Green' => 0,
 'Colorless' => 0
 );

$type_count = array();

$cmc_count = array();
$multicolored_count = 0;

$total_card_count = count($picks);
foreach ($picks as $pick) {
   $cards = mtgsdk\Card::where(['name' => $pick])->all();
   $card = $cards[0];

   // color pie stats.
   if (isset($card->colors)) {
      $colors = $card->colors;
      foreach ($colors as $color) {
         $color_count[$color]++;
      }
      if (count($colors) > 1) {
         $multicolored_count++;
      }
   } else {
      if (!in_array('Land', $card->types)) { // exclude land picks
         $color_count['Colorless']++;
      }
   }


   // Mana curve stats.
   $cmc = $card->cmc; 
   if (isset($cmc_count[$cmc])) {
      $cmc_count[$cmc]++;
   } else {
      $cmc_count[$cmc] = 1;
   }

   //supertype stats
   $types = $card->types;
   foreach($types as $type) {
      if (isset($type_count[$type])) {
         $type_count[$type]++;
      } else {
         $type_count[$type] = 1;
      }
   }
}

ksort($cmc_count);

echo '<h1>Stats</h1>';
echo 'Picks: ' . $total_card_count . '<br/>';
echo 'Multicolored picks: ' . $multicolored_count . '<br/>';
echo '<h2>Spell Colors</h2>';
echo '<ul>';
foreach ($color_count as $color => $amount) {
   echo '<li>' . $color . ': ' . $amount . '</li>';
}
echo '</ul>';

echo '<h2>Converted Mana Cost</h2>';
echo '<ul>';
foreach ($cmc_count as $cmc => $amount) {
   echo '<li>' . $cmc . ': ' . $amount . '</li>';
}
echo '</ul>';

echo '<h2>Card Types</h2>';
echo '<ul>';
foreach ($type_count as $type => $amount) {
   echo '<li>' . $type . ': ' . $amount . '</li>';
}
echo '</ul>';
