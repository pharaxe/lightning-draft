

<html>
<head>
   <link rel="stylesheet" href="styles.css">
</head>
<body>

<?php
 $sheet = "https://docs.google.com/spreadsheets/d/15QCSzgHuwYuWRUvaEduxBhmdY1XCBE93gGpK2pC6YFo/edit#gid=0";
 $cube = "http://www.cubetutor.com/viewcube/2432";


echo '<div id="links">';
echo '<a href="'.$sheet.'">Link to spreadsheet.</a>';
echo '<a id="cubelink" href="'.$cube.'">Link to cube.</a>';
echo '</div>';


echo '<div id="framed-content">';

echo '<iframe class="tab" id="sheets" src="' . $sheet . '"> </iframe>';
echo '<iframe onload="cubeLoaded(this)" class="tab" id="cube" src="' . $cube . '"> </iframe>';


echo '<section id="test" data-test="hello world"> </section>'
?>

</div>
<div id="clear"></div>

</body>
<script src="MooTools-Core-1.6.0.js"></script>
<script src="MooTools-More-1.6.0.js"></script>
<script src="scripts.js"></script>
</html>
