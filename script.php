<?php
header("Content-Type: text/html; charset=UTF-8");

error_reporting(-1);


/**
* Search words in sub file
*
*@srt = subbtitry
*@fileName = file name where will store translation
*@return array with words order by decrease
*/
function searchWords( $srt, $UpFirstLetter = false) {
    $file = file_get_contents($srt);

    $array = array();

    if ( $UpFirstLetter === true ) {
        preg_match_all('![a-zA-Z]{4,}!', $file, $array);
    } else {
        preg_match_all('!(\b[^A-Z][a-z]{4,})!', $file, $array);
    }
    
    $result = array_count_values($array[0]);
    arsort($result);
    $result = array_keys($result);

    return $result;
}

function view( array $srt ) {
    echo "Всего слов: " . count($srt) . "<br><br>";
    foreach ( $srt as $word ) {
        echo "$word <br>";
    }
} 

$words = searchWords('The.Doctor.Blake.Mysteries.S01E03.HDTV.IVIEW.en.srt');

if ( !isset($_COOKIE['number']) ) {
    shuffle($words);
    shuffle($words); // Control shot
    setcookie('number', 0, time() + 3600);
    $number = 0;
} else {
    $number = $_COOKIE['number'];
}

if ( isset($_POST['deleteCookie']) ) {
    setcookie('number', '', time() - 3600);
    var_dump($_COOKIE);
    echo "deleteCookie";
}

if ( isset($_POST['next']) ) {
    $number++;
    setcookie('number', $number, time() + 3600);
}

if ( isset($_POST['previous']) ) {
    $number--;
    setcookie('number', $number, time() + 3600);
}

echo $number;