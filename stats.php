<?php
?>
<html>
<head>
   <link rel="stylesheet" href="styles.css">
   <script src="Chart.min.js"></script>
   <script src="MooTools-Core-1.6.0.js"></script>
   <script src="MooTools-More-1.6.0.js"></script>
   <script src="stats_script.js"></script>
</head>
<body>

<?php
$filename = 'peasant_cube_stats.json';
$fp = fopen($filename, 'r');
$json_data = fread($fp, filesize($filename));
$data = json_decode($json_data);

echo '<section id="data" data-stats="'
   . htmlspecialchars($json_data,ENT_QUOTES, 'UTF-8')
   . '"></section>';

echo '<h1>Peasant Cube Rotisserie Draft Stats</h1>';
echo 'Updated on ' . $data->date . '<br/>';
echo 'Draft Completion: ' . (int)($data->total_card_count / 336 * 100).  '%<br/>';
//echo 'Multicolored picks: ' . $data->multicolored_picks . '<br/>';
?>
<div class="charts">
<h2>Spell Colors</h2>
<canvas width="400" height="400" class="chart" id="colorChart" ></canvas>
</div>


<div class="charts">
<h2>Card Types</h2>
<canvas width="400" height="400" class="chart" id="typeChart" ></canvas>
</div>

<div class="charts">
<h2>Converted Mana Cost</h2>
<canvas width="400" height="400" class="chart" id="cmcChart" ></canvas>
</div>

<div class="charts">
<h2>Color Identities (WIP)</h2>
<table id="color_identities">
<?php
foreach ($data->color_identities as $ndx => $pick) {
   if ($ndx % 8 == 0)  {
      echo '<tr>';
      $picks_left = $data->total_card_count - $ndx;
      if ($picks_left < 8) {
         // final row
         $y = (int) $ndx / 8;
         if ($y % 2 != 0) {
            $padding = 8 - $picks_left;   
            for ($p = 0; $p <$padding; $p++) {
               echo '<td class="padding"></td>';
            }
         }
      }
   }

   echo '<td class="pick ' . $pick . '"></td>';

   if ($ndx % 8 == 7 || $ndx == $data->total_card_count -1)
      echo '</tr>';
}
?>
</table>
</div>

</body>
</html>
