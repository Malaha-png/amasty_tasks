<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>task2</title>
</head>

<body>
<a href="./">Назад</a></br>
   <?php

   $array = array('red', 'blue', 'green', 'yellow', 'lime', 'magenta', 'black', 'gold', 'gray', 'tomato');

   $out = '';
   for ($i = 0; $i < 5; $i++) {
      $out .= '<p>';
      for ($j = 0; $j < 5; $j++) {
         $cc = true;
         while ($cc) {
            $rand_keys_color = array_rand($array, 1);
            $rand_keys_word = array_rand($array, 1);
            if ($rand_keys_color != $rand_keys_word) {
               $out .= '<span style="color:' . $array[$rand_keys_color] . '"> ' . $array[$rand_keys_word] . ' </span>';
               $cc = false;
            }
         }
      }
      $out .= '</p>';
   }

   echo $out;

   ?>

</body>

</html>