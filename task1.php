<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>task1</title>

   <style>
      .from div {
         display: inline-block;
      }

      .from input {
         width: 50px;
      }

      body {
         padding: 0;
         margin: 0;
      }

      body>div {
         border: 2px solid black;
         margin: 5px;
         padding: 5px;
      }

      table td {
         width: 20px;
         height: 20px;
      }

      .info {
         display: inline-block;
         width: 25px;
         height: 25px;
      }
   </style>

</head>

<body>

   <a href="./">Назад</a></br>
   <?php

   $error = '';

   interface IChessmen
   {
      public function Move($x, $y);
      public function getPosition($prefix);
   }


   abstract class AbstractChessmen implements IChessmen
   {
      public  $x;
      public  $y;

      //разрешает или запрещает двигать фигуру
      abstract public function Move($xn, $yn);

      public function getPosition($prefix)
      {
         echo "{$prefix} координаты x- {$this->x} / y-{$this->y} </br> ";
      }
   }

   class King extends AbstractChessmen
   {
      public function Move($xn, $yn)
      {
         $x = $this->x;
         $y = $this->y;

         if ($xn > 0 && $yn > 0 && $xn < 9 && $yn < 9) {
            if (!$x && !$y) {
               $this->x = $xn;
               $this->y = $yn;
               return false;
            } else if ($x == $xn && $y == $yn) {
               return 'Вы остались на месте';
            } else if ($x == $xn && $y != $yn) {
               if ($y == $yn - 1 || $y == $yn + 1) {
                  $this->x = $xn;
                  $this->y = $yn;
                  return false;
               } else {
                  return 'Можно перейти только на 1 клетку';
               }
            } else if ($y == $yn && $x != $xn) {
               if ($x == $xn - 1 || $x == $xn + 1) {
                  $this->x = $xn;
                  $this->y = $yn;
                  return false;
               } else {
                  return 'Можно перейти только на 1 клетку';
               }
            } else if (
               ($y - 1 == $yn && $x - 1 == $xn) ||
               ($y + 1 == $yn && $x + 1 == $xn) ||
               ($y - 1 == $yn && $x + 1 == $xn) ||
               ($y + 1 == $yn && $x - 1 == $xn)
            ) {
               $this->x = $xn;
               $this->y = $yn;
               return false;
            } else {
               return 'Можно перейти только на 1 клетку';
            }
         } else {
            return 'Вы вышли за гранцы';
         }
      }
   }

   class Queen extends AbstractChessmen
   {
      public function Move($xn, $yn)
      {
         $x = $this->x;
         $y = $this->y;

         if ($xn > 0 && $yn > 0 && $xn < 9 && $yn < 9) {
            if (!$x && !$y) {
               $this->x = $xn;
               $this->y = $yn;
               return false;
            } else if ($x == $xn && $y == $yn) {
               return 'Вы остались на месте';
            } else if ($x == $xn && $y != $yn) {
               $this->x = $xn;
               $this->y = $yn;
               return false;
            } else if ($y == $yn && $x != $xn) {
               $this->x = $xn;
               $this->y = $yn;
               return false;
            }
            // else if (($x + $y) % 2 && ($xn + $yn) % 2) {
            //    $this->x = $xn;
            //    $this->y = $yn;
            //    return false;
            // } 
            else if (($x - $y) == ($xn - $yn)) {
               $this->x = $xn;
               $this->y = $yn;
               return false;
            } else {
               $sts = true;
               $cord = -8 + $x + $y - 1;
               for ($i = 0; $i < 8; $i++) {
                  if ($xn - 1 == $i && $yn - 1 == 7 + $cord - $i) {
                     $sts = false;
                  }
               }

               if ($sts) {
                  return 'Нельзя туда ходить';
               } else {
                  $this->x = $xn;
                  $this->y = $yn;
                  return false;
               }
            }
         } else {
            return 'Вы вышли за гранцы';
         }
      }
   }

   if ($_POST['form_id'] == 1) {

      $King = new King();

      $xNewK = $_POST['xNewK'];
      $yNewK = $_POST['yNewK'];

      $xOldK = $_POST['xOldK'];
      $yOldK = $_POST['yOldK'];


      $King->x = $xOldK;
      $King->y = $yOldK;

      $info = $King->Move($xNewK, $yNewK);

      if (!$info) {
         echo $King->getPosition('King');
      } else {
         echo ' King ' . $info . '</br>';
         echo $King->getPosition('King');
      }

      $Queen = new Queen();

      $xNewQ = $_POST['xNewQ'];
      $yNewQ = $_POST['yNewQ'];

      $xOldQ = $_POST['xOldQ'];
      $yOldQ = $_POST['yOldQ'];


      $Queen->x = $xOldQ;
      $Queen->y = $yOldQ;

      $info = $Queen->Move($xNewQ, $yNewQ);

      if (!$info) {
         echo $Queen->getPosition('Queen');
      } else {
         echo ' Queen ' . $info . '</br>';
         echo $Queen->getPosition('Queen');
      }
   }

   ?>

   <div>
      <p>MoveKing - <span class="info" style="background-color: green;"></span></p>
      <form action="" method="post" class="from">
         <div>
            X<input type="number" name="xNewK" value="<?echo $_POST['xOldK'] ? $King->x : 4;?>">
            <input hidden name="xOldK" value="<?echo $King->x ? $King->x : 4;?>" type="number">
         </div>
         <div>
            Y<input type="number" name="yNewK" value="<?echo $_POST['yOldK'] ? $King->y : 3;?>">
            <input hidden name="yOldK" value="<?echo $King->y ? $King->y : 3;?>" type="number">
         </div>
         <input type="hidden" name="form_id" value="1" />
         <button type="submit">Изменить</button>


         <p>MoveQueen - <span class="info" style="background-color: yellow;"></span></p>
         <div>
            X<input type="number" name="xNewQ" value="<?echo $_POST['xOldQ'] ? $Queen->x : 1;?>">
            <input hidden name="xOldQ" value="<?echo $Queen->x ? $Queen->x : 1;?>" type="number">
         </div>
         <div>
            Y<input type="number" name="yNewQ" value="<?echo $_POST['yOldQ'] ? $Queen->y : 1;?>">
            <input hidden name="yOldQ" value="<?echo  $Queen->y ? $Queen->y : 1;?>" type="number">
         </div>
         <input type="hidden" name="form_id" value="1" />
         <button type="submit">Изменить</button>
      </form>

      <!-- Поле шахматное -->
      <table border="-1">
         <?php
         $out = '';
         for ($i = 0; $i < 9; $i++) {
            $out .= '<tr>';
            if ($i != 0) {
               $out .= '<td>' . $i . '</td>';
            }
            for ($j = 0; $j < 9; $j++) {
               if ($i == 0) {
                  if ($j != 0) {
                     $out .= '<td>' . $j . '</td>';
                  } else {
                     $out .= '<td></td>';
                  }
               } else if ($i == ($King->x ? $King->x : 4) && $j == ($King->y ? $King->y : 3)   && $j != 0) {
                  $out .= '<td style="background-color:green;"></td>';
               } else if ($i == ($Queen->x ? $Queen->x : 1) && $j ==  ($Queen->y ? $Queen->y : 1) && $j != 0) {
                  $out .= '<td style="background-color:yellow;"></td>';
               } else if ($j != 0) {
                  $clr = ($i + $j) % 2 ? 'white' : ' black';
                  $out .= '<td style="background-color:' . $clr . ';"></td>';
               }
            }
            $out .= '</tr>';
         }
         echo $out
         ?>
      </table>

   </div>

</body>

</html>