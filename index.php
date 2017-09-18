

<html>
<head>
   <link rel="stylesheet" href="styles.css">
   <script src="MooTools-Core-1.6.0.js"></script>
   <script src="MooTools-More-1.6.0.js"></script>
   <script src="scripts.js"></script>
</head>
<body>

<div id="framed-content">
<?php
 $sheet = "https://docs.google.com/spreadsheets/d/15QCSzgHuwYuWRUvaEduxBhmdY1XCBE93gGpK2pC6YFo/edit#gid=0";
 $cube = "http://www.cubetutor.com/viewcube/5936";


echo '<iframe class="tab" id="sheets" src="' . $sheet . '"> </iframe>';
echo '<iframe class="tab" id="cube" src="' . $cube . '"> </iframe>';

?>

</div>
<div id="clear"></div>

</body>
</html>
