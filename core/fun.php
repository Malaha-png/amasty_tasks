<?php


function banknoteRand()
{
    $banknote = array(5, 10, 20, 50, 100, 200, 500, 1000);

    $rand_keys = array_rand($banknote, rand(2, count($banknote)));

    $rand_banknote = array();
    for ($i = 0; $i < count($rand_keys); $i++) {
        array_push($rand_banknote, $banknote[$rand_keys[$i]]);
    }

    echo  json_encode($rand_banknote);
}


function  banknoteGet()
{
    $banknote = $_POST['banknote'];
    $banknoteGet = array();
    $summ = $_POST['summ'];
    $summMin = 0;
    $summMax = 0;
    $banknoteCount = 0;

    $out = array();


    $i = count($banknote) - 1;

    while ($i > -1) {
        if ($summMin + $banknote[$i] > $summ) {
            array_push($banknoteGet, [$banknoteCount, $banknote[$i]]);
            $banknoteCount = 0;
            $i--;
        } else {
            $banknoteCount++;
            $summMin += $banknote[$i];
            $summMax += $banknote[$i];
        }
    }

    if ($summMin != $summ) {
        $tr = true;
        while ($tr) {
            if ($summMax < $summ) {
                $summMax +=  $banknote[0];
            } else {
                $tr = false;
            }
        }
    }

    $out['summMin'] = $summMin;
    $out['summMax'] = $summMax;
    $out['banknoteGet'] = $banknoteGet;

    echo  json_encode($out);
}
