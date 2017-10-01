<?php

function getMulticoloredName($colors) {
   sort($colors);
   
   if ($colors === array('U', 'W') )
      return 'Azorious';
   if ($colors === array('B', 'U') )
      return 'Dimir';
   if ($colors === array('B', 'R') )
      return 'Rakdos';
   if ($colors === array('G', 'R') )
      return 'Gruul';
   if ($colors === array('G', 'W') )
      return 'Selesnya';
   if ($colors === array('B', 'W') )
      return 'Orzhov';
   if ($colors === array('R', 'U') )
      return 'Izzet';
   if ($colors === array('B', 'G') )
      return 'Golgari';
   if ($colors === array('R', 'W') )
      return 'Boros';
   if ($colors === array('G', 'U') )
      return 'Simic';
   if ($colors === array('B', 'G', 'R'))
      return 'Jund';
   if ($colors === array('B', 'U', 'W'))
      return 'Esper';
   if ($colors === array('B', 'R', 'U'))
      return 'Grixis';
   if ($colors === array('B', 'G', 'W'))
      return 'Bant';
   if ($colors === array('G', 'R', 'W'))
      return 'Naya';
   if ($colors === array('B', 'R', 'W'))
      return 'Mardu';
   if ($colors === array('R', 'G', 'U'))
      return 'Temur';
   if ($colors === array('R', 'U', 'W'))
      return 'Jeskai';
   if ($colors === array('B', 'G', 'W'))
      return 'Abzan';
   if ($colors === array('B', 'G', 'U'))
      return 'Sultai';

   return 'Multicolored';
}
