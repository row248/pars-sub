<?php

session_start();

header("Content-Type: text/html; charset=UTF-8");

error_reporting(-1);

require_once 'db.php';

if ( isset($_SESSION['number']) ) {
    define('STORENUMBER', $_SESSION['number']);
}

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

function calculation($number, $session, $sign) {
    if ( $sign === '+' ) {
        $number++;
    } elseif ( $sign === '-' ) {
        $number--;
    } elseif ( $sign === '=' ) {
        $number = 0;
    } else {
        throw new Exception(' $sing must be "+" or "-" '); // not work, because AJAX
    }

    $_SESSION['number'] = $number; // store $number in $_SESSION

    return $number;
}

//if ( isset($_POST['word']) ) {
$pdo = Db::connect();
var_dump($pdo);

//}

/**
*Main initialization
*Need function?
*/
if ( !isset($_SESSION['number']) ) {
    $words = searchWords('The.Doctor.Blake.Mysteries.S01E03.HDTV.IVIEW.en.srt');
    saveWords($words);
    $_SESSION['number'] = 0;
    $number = 0;
} else {
    $number = $_SESSION['number'];
    $words = takeWords('mywords.txt');
}

$countWords = count($words);

if ( isset($_POST['shuffleArray']) ) {
    $words = myShuffle($words);
    saveWords($words);
    $words = takeWords('mywords.txt'); // Polymorphism :P
    $_SESSION['number'] = 0;
    $number = 0;
}

if ( isset($_GET['next']) && $_GET['next'] == 'next' ) {
    $number = calculation($number, STORENUMBER, '+');
}

if ( isset($_GET['previous']) && $_GET['previous'] == 'previous' ) {
    $number = calculation($number, STORENUMBER, '-');
}

if ( $number < 0 ) {
    $number = calculation($number, STORENUMBER, '=');
}

require_once 'page.php';