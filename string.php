<?php
include 'lib/KsuStudent.php';
use kst\KsuStudent;

header('Content-Type: text/plain; charset=UTF-8');

$str = "１２Ⅾ　D　Ⅾ08";
echo "'{$str}'\n";
$st_info = KsuStudent::parseSid($str);
if ($st_info){
    echo '[', implode(', ', $st_info), "]";
}else{
    echo "Unrecognized string of student id '{$str}'";
}
echo "\n";
// '１２Ⅾ　D　Ⅾ08'
// Unrecognized string of student id '１２Ⅾ　D　Ⅾ08'

$str = "２４as １　　０ ２　 　";
echo "'{$str}'\n";
$st_info = KsuStudent::parseSid($str);
if ($st_info){
    echo '[', implode(', ', $st_info), "]";
}else{
    echo "Unrecognized string '{$str}'";
}
echo "\n";
// '２４as １　　０ ２　 　'
// [24AS102, 24, AS, 102, 芸術学部, ソーシャルデザイン学科]

$str = "2２GJK   ０　 ３　 　";
echo "'{$str}'\n";
$st_info = KsuStudent::parseSid($str);
if ($st_info){
    echo '[', implode(', ', $st_info), "]";
}else{
    echo "Unrecognized string '{$str}'";
}
echo "\n";
// '2２GJK   ０　 ３　 　'
// [22GJK03, 22, GJK, 03, 情報科学研究科, 情報科学専攻]

$str = "１２DTI　 　　０　 ２　　 ";
echo "'{$str}'\n";
$st_info = KsuStudent::parseSid($str);
if ($st_info){
    echo '[', implode(', ', $st_info), "]";
}else{
    echo "Unrecognized string '{$str}'";
}
echo "\n";
// '１２DTI　 　　０　 ２　　 '
// [12DTI02, 12, DTI, 02, 工学研究科, 産業技術デザイン専攻]

echo "\n\n";


$unit =  \DateInterval::createFromDateString('10 minute');
echo $unit->format('%I'), "\n";
// OUTPUT: 10 

$base = mktime(0,0,0,1,1,2023);

foreach (['0231','020031', '2-31', '02-31','2/31'] as $dt){
    $x =  mkdate($dt);
    printf("mkdate('%s') =\t '%s' \n\n",  $dt, $x);
}

/**OUPUT:
2, 31
mkdate('0231') =	 '03-03' 

2, 31
mkdate('020031') =	 '03-03' 

2, 31
mkdate('2-31') =	 '03-03' 

2, 31
mkdate('02-31') =	 '03-03' 

2, 31
mkdate('2/31') =	 '03-03' 
*/
function mkdate ($date, $days = 0)
{
    $year = 2023;
    if (preg_match('/^[0-9]+-[0-9]+$/', $date)){
        list ($m, $d) = explode('-', $date);
    }
    if (preg_match('/^[0-9]+\/[0-9]+$/', $date)){
        list ($m, $d) = explode('/', $date);
    }elseif (preg_match('/^[0-9]{4,}$/', $date)){
        $m = substr($date, 0, 2);
        $d = substr($date, 2);
    }
    if (!isset($m, $d)) {
        throw new Exception('Invalid date format!');
    }
    printf("%d, %d\n", $m, $d);
    $time = mktime(0, 0, 0, $m, $d + $days, $year);
    return date('m-d', $time);
}