<?php

session_start();

header("Content-Type: text/html; charset=UTF-8");

error_reporting(-1);
/**
* Search words in sub file
*
*@srt = subbtitry
*@fileName = file name where will store translation
*@return array with words order by decrease
*/
function searchWords( $srt, $UpFirstLetter = false ) {
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

function myShuffle( array $words ) {
    for ( $i = 0; $i < 10; $i ++ ) {
        shuffle($words);
    }
    return $words;
}

function saveWords( array $words ) {
    $words = serialize($words);
    file_put_contents('mywords.txt', $words); // No check if return false
    return true;
} 

function takeWords( $path ) {
    $words = file_get_contents($path);
    $words = unserialize($words);
    return $words;
}

/**
*Main initialization
*Need function?
*/
if ( !isset($_SESSION['number']) ) {
    $words = searchWords('The.Doctor.Blake.Mysteries.S01E03.HDTV.IVIEW.en.srt');
    saveWords($words);
    //$words = myShuffle($words); // Button "shuffle words"
    $_SESSION['number'] = 0;
    $number = 0;
} else {
    $number = $_SESSION['number'];
    $words = takeWords('mywords.txt');
}


if ( isset($_POST['shuffleArray']) ) {
    echo "+";
    $words = myShuffle($words);
    saveWords($words);
    $words = takeWords('mywords.txt'); // Polymorphism :P
    $_SESSION['number'] = 0;
    $number = 0;
}

if ( isset($_GET['next']) && $_GET['next'] == 'next' ) {
    $number++;
    $_SESSION['number'] = $number;
}

if ( isset($_GET['previous']) && $_GET['previous'] == 'previous' ) {
    $number--;
    $_SESSION['number'] = $number;
}

echo $number;
require_once 'page.php';