<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>task4</title>
</head>

<body>
   <?php
   require_once './simplehtmldom/simple_html_dom.php';

   $html = file_get_html('https://terrikon.com/football/italy/championship/');

   foreach ($html->find('table.grouptable  a') as $element) {
      echo $element->plaintext . '<br>';
   }
   // echo empty($_POST['com']) . ' com ';
   $value = trim($_POST['com']);
   if (isset($value) && !empty($value)) {
      $html = file_get_html('https://terrikon.com/football/italy/championship/');

      $search = trim(mb_strtolower($_POST['com']));
      foreach ($html->find('table.grouptable  a') as $element) {
         $val = $element->plaintext;
         $val = trim(mb_strtolower($val));
         $pos = strpos($val, $search);
         if (!($pos === false)) {
            $href =  $element->href;
            $html = file_get_html('https://terrikon.com' . $href . '/trophy');
            $html = $html->find('.maincol .main div');
            if (!empty($html)) {
               echo '<p> Ваша команда <strong>' . $_POST['com'] . '</strong></p>';
               foreach ($html as $element) {
                  echo $element;
               }
            } else {
               echo '<p>Архив команды <strong>' . $_POST['com'] . '</strong> не найден </p>';
            }
         }
      }
   }
   ?>

   <br>
   <form action="" method="post">
      <p>Введите конманду</p>
      <input type="text" name="com">
      <button type="submit">Получить</button>
   </form>


</body>

</html>