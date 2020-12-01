<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>task4</title>
</head>

<body>
   <?php

   if (isset($_POST['com'])) {
      require_once './simplehtmldom/simple_html_dom.php';

      $html = file_get_html('https://terrikon.com/football/italy/championship/');

      $search = trim(mb_strtolower($_POST['com']));
      foreach ($html->find('table.grouptable  a') as $element) {
         $val = $element->plaintext;
         $val = trim(mb_strtolower($val));
         $pos = strpos($val, $search);
         if (!($pos === false)) {
            $href =  $element->href;
            $html = file_get_html('https://terrikon.com' . $href . '/trophy');
            foreach ($html->find('.maincol .main div') as $element) {
               echo $element;
               // $val = $element->plaintext;
               // $val = trim(mb_strtolower($val));
               // $pos = strpos($val, $search);
               // if (!($pos === false)) {
               //    $href =  $element->href;
               //    $html = file_get_html('https://terrikon.com' . $href);
               //    echo $element->href . '<br>';
               // }
            }
         }
      }
   }
   ?>

   <form action="" method="post">
      <input type="text" name="com">
      <button type="submit">Получить</button>
   </form>


</body>

</html>