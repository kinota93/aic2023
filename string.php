<?php

header('Content-Type: text/plain; charset=UTF-8');

$str = "１２Ⅾ　D　Ⅾ08";
echo "'{$str}'\n";
if ($sid){
    echo $sid, ", ", KsuStudent::getDept($sid), "\n";
    echo $sid, ", ", KsuStudent::getDept($sid, 'FALT'), "\n";
    echo $sid, ", ", KsuStudent::getDept($sid, 'DEPT'), "\n";
}else{
    echo "Unrecognized student id '{$str}'\n";
}
echo "\n";

$str = "１２as １　　０ ２　 　";
echo "'{$str}'\n";
$sid =  KsuStudent::validateSid($str);
if ($sid){
    echo $sid, ", ", KsuStudent::getDept($sid), "\n";
    echo $sid, ", ", KsuStudent::getDept($sid, 'FALT'), "\n";
    echo $sid, ", ", KsuStudent::getDept($sid, 'DEPT'), "\n";
}
echo "\n";

// OUTPUT: 12RS102

$str = "2２GJK   ０　 ３　 　";
echo "'{$str}'\n";
$sid =   KsuStudent::validateSid($str);
if ($sid){
    echo $sid, ", ", KsuStudent::getDept($sid), "\n";
    echo $sid, ", ", KsuStudent::getDept($sid, 'FALT'), "\n";
    echo $sid, ", ", KsuStudent::getDept($sid, 'DEPT'), "\n";
}
echo "\n";
// OUTPUT: 22GJK03

$str = "１２DTI　 　　０　 ２　　 ";
echo "'{$str}'\n";
$sid = KsuStudent::validateSid($str);
if ($sid){
    echo $sid, ", ", KsuStudent::getDept($sid), "\n";
    echo $sid, ", ", KsuStudent::getDept($sid, 'FALT'), "\n";
    echo $sid, ", ", KsuStudent::getDept($sid, 'DEPT'), "\n";
}
// OUTPUT: 

echo "\n\n";

class KsuStudent{
    const FACULTY_DEPT =[
        //学科のIDと名称
        'RS'=>'理工学部 情報科学科',
        'RM'=>'理工学部 機械工学科',
        'RE'=>'理工学部 電気工学科',        
        'LL'=>'生命科学部 生命科学科',        
        'UA'=>'建築都市工学部 建築学科',
        'UH'=>'建築都市工学部 住居・インテリア学科',
        'UC'=>'建築都市工学部 都市デザイン工学科',
        'CB'=>'商学部 経営・流通学科',
        'EE'=>'経済学部 経済学科',        
        'DT'=>'地域共創学部 観光学科',
        'DR'=>'地域共創学部 地域づくり学科',
        'AA'=>'芸術学部 芸術表現学科',
        'AP'=>'芸術学部 写真・映像メディア学科',
        'AD'=>'芸術学部 ビジュアルデザイン学科',
        'AE'=>'芸術学部 生活環境デザイン学科',
        'AS'=>'芸術学部 ソーシャルデザイン学科',        
        'KK'=>'国際文化学部 国際文化学科',
        'KN'=>'国際文化学部 日本文化学科',        
        'HP'=>'人間科学部 臨床心理学科',
        'HC'=>'人間科学部 子ども教育学科',
        'HS'=>'人間科学部 スポーツ学科',
    ];

    //大学院のIDと名称
    const GRADUATE_SCHL = [   
        'GBE'=>'経済・ビジネス研究科 経済学専攻',
        'GBM'=>'経済・ビジネス研究科 現代ビジネス専攻',
        'GTI'=>'工学研究科 産業技術デザイン',
        'GJK'=>'情報科学研究科 情報科学専攻',
        'GAC'=>'芸術研究科 造形表現専攻',
        'GKK'=>'国際文化研究科 国際文化専攻',

        'DBE'=>'経済・ビジネス研究科 経済学専攻',
        'DBM'=>'経済・ビジネス研究科 現代ビジネス専攻',
        'DTI'=>'工学研究科 産業技術デザイン専攻',
        'DJK'=>'情報科学研究科 情報科学専攻',
        'DAC'=>'芸術研究科 造形表現専攻',
        'DKK'=>'国際文化研究科 国際文化専攻',
    ];
    /** 標準の学籍番号（半角英数大文字）に変換（全角半角変換、スペースや改行コード削除、大文字変換） */
    public static function getDept($sid, $part=''){
        // $part: 'FULL', 'DFALT', 'DEPT'
        $sid = self::validateSid($sid);
        if (!$sid) return null;
        $dept = null; 
        if (preg_match('/^\d{2}[A-Z]{2}\d{3}$/', $sid)){
            $dept_id = substr($sid, 2, 2);
            if (in_array($dept_id, array_keys(self::FACULTY_DEPT))){
                $dept = self::FACULTY_DEPT[$dept_id];
            }
        }
        if (preg_match('/^\d{2}[A-Z]{3}\d{2}$/', $sid)){
            $dept_id = substr($sid, 2,3);
            if (in_array($dept_id, array_keys(self::GRADUATE_SCHL))){
                $dept = self::GRADUATE_SCHL[$dept_id];
            }
        }
        if (!$dept) return null;
        list ($flt_name, $dpt_name) = explode(' ', $dept);
        if ($part == 'DEPT'){
            return $dpt_name;
        }
        if ($part == 'FALT'){
            return $flt_name;
        }
        if ($part == 'FULL'){
            return $dept;
        }
        return $dept_id;

    }
    
    public static function validateSid($str)
    {
        $str = preg_replace("/( |　)/", "", trim($str) );//空白文字を削除
        $str = preg_replace("/Ⅾ/", "D", $str );//全角と認識できない文字を変換
        $str = mb_convert_kana($str, "a");//全角英数を半角英数へ変換
        $str = strtoupper($str);//小文字を大文字に変換
    
        $pattern = implode('|',array_keys(self::FACULTY_DEPT));//学部IDのパターン
        if (preg_match('/^\d{2}('. $pattern . ')\d{3}$/', $str)){
            return $str;
        }
        $pattern = implode('|',array_keys(self::GRADUATE_SCHL));//大学院IDのパターン
        if (preg_match('/^\d{2}('. $pattern . ')\d{2}$/', $str)){
            return $str;
        }
        return null;
    }
}
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