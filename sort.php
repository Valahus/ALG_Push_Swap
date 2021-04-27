<?php
array_shift($argv);
$arguments = $argv;
$counter_argv = $argc - 1;
$tab = [];
$temp = [];
if (empty($arguments)) {
    $tab = array(59, 45, 21, 8, 13, 48, 23, 4, 76, 62, 62, 34, 25, 4, 52, 81, 58, 63, 10, 12, 95, 2, 11, 73, 51, 100, 47, 30, 88, 38, 36, 52, 2, 92, 97, 39, 100, 9, 34, 31, 75, 82, 10, 64, 48, 65, 32, 15, 2, 60, 85, 24, 82, 72, 98, 7, 24, 73, 55, 48, 41, 10, 55, 44, 85, 30, 3, 77, 81, 73, 70, 37, 48, 6, 88, 65, 99, 17, 41, 77, 48, 10, 87, 88, 78, 27, 42, 39, 13, 71, 17, 52, 100, 0, 26, 76, 37, 24, 11, 74);
    print("\033[36m SIZE OF GIVEN TAB:" . count($tab) . " \033[0m" . PHP_EOL . PHP_EOL);
    print("\033[36m AMELIORATED BUBBLE SORT \033[0m" . PHP_EOL . PHP_EOL);
//    bubbleSort($tab, $temp);
    bubbleSort(nb(100), $temp);
    print("\033[36m SIZE OF GIVEN TAB:" . count($tab) . " \033[0m" . PHP_EOL . PHP_EOL);
    print("\033[36m AMELIORATED SELECTION SORT \033[0m" . PHP_EOL . PHP_EOL);
//    bestSort($tab, $temp);
    bestSort(nb(100), $temp);
} else {
    createList($tab);
    print("\033[35m SIZE OF GIVEN TAB:" . count($tab) . " \033[0m" . PHP_EOL . PHP_EOL);
    print("\033[35m AMELIORATED BUBBLE SORT \033[0m" . PHP_EOL . PHP_EOL);
    bubbleSort($tab, $temp);
    print("\033[36m SIZE OF GIVEN TAB:" . count($tab) . " \033[0m" . PHP_EOL . PHP_EOL);
    print("\033[36m AMELIORATED SELECTION SORT \033[0m" . PHP_EOL . PHP_EOL);
    bestSort($tab, $temp);
}
function createList(&$tab)
{
    global $arguments;
    global $counter_argv;
    for ($i = 0; $i < $counter_argv; $i++) {
        $tab[$i] = $arguments[$i];
    }
    return $tab;
}

function nb($nb)
{
    $tab = [];
    for ($i = 0; $i < $nb; $i++) {
        $a = mt_rand(1, $nb);
        array_push($tab, $a);
    }
    return $tab;
}

function swap(&$x, &$y)
{
    $tmp = $x;
    $x = $y;
    $y = $tmp;
}

function sa(&$tab, $i)
{
    if (empty($tab)) {
        return 0;
    }
    swap($tab[$i], $tab[$i + 1]);
    print("\033[32m SA \033[0m");
    return $tab;
}

function sb(&$temp, $i)
{
    if (empty($temp)) {
        return 0;
    }
    swap($temp[$i], $temp[$i + 1]);
    print("\033[32m SB \033[0m");
    return $temp;
}

function sc(&$tab, &$temp, $i)
{
    swap($tab[$i], $tab[$i + 1]);
    swap($temp[$i], $temp[$i + 1]);
    print("\033[32m SC \033[0m");
    return array($tab, $temp);

}

function pa(&$tab, &$temp, $i)
{
    array_unshift($tab, $temp[$i]);
    $rmv = array_shift($temp);
    print("\033[33m PA \033[0m");
    return array($tab, $temp);
}

function pb(&$tab, &$temp, $i)
{
    array_unshift($temp, $tab[$i]);
    $rmv = array_shift($tab);
    print("\033[32m PB \033[0m");
    return array($tab, $temp);
}

function ra(&$tab)
{
    $head = $tab[0];
    $rmv = array_shift($tab);
    array_push($tab, $head);
    print("\033[31m RA \033[0m");
    return $tab;
}

function rb(&$temp)
{
    $head = $temp[0];
    $rmv = array_shift($temp);
    array_push($temp, $head);
    print("\033[32m RB \033[0m");
    return $temp;
}

function rr(&$tab, &$temp)
{
    $head1 = $tab[0];
    $head2 = $temp[0];
    $rmv1 = array_shift($tab);
    $rmv2 = array_shift($temp);
    array_push($tab, $head1);
    array_push($temp, $head2);
    print("\033[32m RR \033[0m");
    return array($tab, $temp);
}

function rra(&$tab)
{
    $tail = array_pop($tab);
    array_unshift($tab, $tail);
    print("\033[34m RRA \033[0m");
    return $tab;
}

function rrb(&$temp)
{
    $tail = array_pop($temp);
    array_unshift($temp, $tail);
    print("\033[32m RRB \033[0m");
    return $temp;
}

function rrr(&$tab, &$temp)
{
    $tail1 = array_pop($tab);
    $tail2 = array_pop($temp);
    array_unshift($tab, $tail1);
    array_unshift($temp, $tail2);
    print("\033[32m RRR \033[0m");
    return array($tab, $temp);
}

function bubbleSort(&$tab, &$temp)
{
    $counter = 0;
    $counter_pa = 0;
    $counter_pb = 0;
    $counter_ra = 0;
    $counter_rra = 0;
    $size = count($tab);
    $max = max($tab);
    for ($i = 0; $i < $size; $i++) {
        $half = $size / 2;
        if ($i > $half && $tab[$i] == $max) {
            rra($tab);
            $counter_rra++;
            $counter++;
            $i = -1;
            if ($max === $tab[0]) {
                pb($tab, $temp, 0);
                $counter_pb++;
                $counter++;
                $max = max($tab);
                $size = count($tab);
                $i = -1;
            }
        } else if ($i <= $half && $tab[$i] == $max) {
            ra($tab);
            $counter_ra++;
            $counter++;
            $i = -1;
            if ($max === $tab[0]) {
                pb($tab, $temp, 0);
                $counter_pb++;
                $counter++;
                $size = count($tab);
                if ($size !== 0) {
                    $max = max($tab);
                }
                $i = -1;
            }
        }
    }
    $size_temp = count($temp);
    for ($i = 0; $i < $size_temp; $i++) {
        pa($tab, $temp, $i);
        $size_temp = count($temp);
        $counter++;
        $counter_pa++;
        $i = -1;
    }
    PHP_EOL;
    PHP_EOL;
    print("\033[35m SORTED ARRAY:  \033[0m" . PHP_EOL . PHP_EOL);
    print_r($tab);
    PHP_EOL;
    PHP_EOL;
    print("\033[35m TEMPORARY ARRAY:  \033[0m" . PHP_EOL . PHP_EOL);
    print_r($temp);
    PHP_EOL;
    PHP_EOL;
    print("\033[33m TOTAL NUMBER OF PA OPERATIONS: " . $counter_pa . " \033[0m" . PHP_EOL . PHP_EOL);
    print("\033[33m TOTAL NUMBER OF PB OPERATIONS: " . $counter_pb . " \033[0m" . PHP_EOL . PHP_EOL);
    print("\033[31m TOTAL NUMBER OF RA OPERATIONS: " . $counter_ra . " \033[0m" . PHP_EOL . PHP_EOL);
    print("\033[34m TOTAL NUMBER OF RRA OPERATIONS: " . $counter_rra . " \033[0m" . PHP_EOL . PHP_EOL);
    print("\033[35m TOTAL NUMBER OF OPERATIONS: " . $counter . " \033[0m" . PHP_EOL . PHP_EOL);
    return array($tab, $temp, $counter, $counter_pa, $counter_pb, $counter_rra, $counter_ra);
}

function bestSort(&$tab, &$temp)
{
    $counter = 0;
    $counter_pa = 0;
    $counter_pb = 0;
    $counter_rra = 0;
    $size = count($tab);
    for ($i = 0; $i < $size; $i++) {
        $min = min($tab);
        if ($min !== $tab[0]) {
            rra($tab);
            $counter_rra++;
            $counter++;
            $size = count($tab);
            $i = -1;
        } else {
            pb($tab, $temp, 0);
            $counter_pb++;
            $counter++;
            $size = count($tab);
            $i = -1;
        }
    }
    $size_temp = count($temp);
    for ($i = 0; $i < $size_temp; $i++) {
        pa($tab, $temp, $i);
        $counter_pa++;
        $counter++;
        $size_temp = count($temp);
        $i = -1;
    }
    PHP_EOL;
    PHP_EOL;
    print("\033[36m SORTED ARRAY:  \033[0m" . PHP_EOL . PHP_EOL);
    print_r($tab);
    PHP_EOL;
    PHP_EOL;
    print("\033[36m TEMPORARY ARRAY:  \033[0m" . PHP_EOL . PHP_EOL);
    print_r($temp);
    PHP_EOL;
    PHP_EOL;
    print("\033[33m TOTAL NUMBER OF PA OPERATIONS: " . $counter_pa . " \033[0m" . PHP_EOL . PHP_EOL);
    print("\033[32m TOTAL NUMBER OF PB OPERATIONS: " . $counter_pb . " \033[0m" . PHP_EOL . PHP_EOL);
    print("\033[34m TOTAL NUMBER OF RRA OPERATIONS: " . $counter_rra . " \033[0m" . PHP_EOL . PHP_EOL);
    print("\033[36m TOTAL NUMBER OF OPERATIONS: " . $counter . " \033[0m" . PHP_EOL . PHP_EOL);
    return array($tab, $temp, $counter, $counter_pa, $counter_pb, $counter_rra);
}
