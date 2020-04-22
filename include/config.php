<?php
session_start();
include_once dirname(dirname(__FILE__))."/class/sessions.php";
foreach (glob(dirname(dirname(__FILE__))."/class/*.php") as $filename)
{
    include_once $filename;
}

if(!isset($_SESSION['isLoggin']) || empty($_SESSION)) {
  ## set Session isLoggedIn to = false if not logged in;
  $_SESSION['isLoggin'] = false;
  $_SESSION['role'] =0;
}

if(isset($_GET)&&!empty($_GET)){
  $_SESSION['uid'] = $_GET['uid'];
  $_SESSION['name'] = $_GET['name'];
  $_SESSION['avartar'] = $_GET['avartar'];
  $_SESSION['isLoggin'] = $_GET['isLoggin'];
  $_SESSION['role'] = $_GET['role'];
  header('Location: home-page.php');
}

define('root', 'http://' . $_SERVER['SERVER_NAME'] . dirname($_SERVER['PHP_SELF']) . "/");
$currentPage = basename($_SERVER['SCRIPT_FILENAME'], ".php");

function restyle_text($input){
    $input = number_format($input);
    $input_count = substr_count($input, ',');
    if($input_count != '0'){
        if($input_count == '1'){
            return substr($input, 0, -4).'k';
        } else if($input_count == '2'){
            return substr($input, 0, -8).'mil';
        } else if($input_count == '3'){
            return substr($input, 0,  -12).'bil';
        } else {
            return;
        }
    } else {
        return $input;
    }
}

function readmore($string, $num = 200)
{
    $string = strip_tags($string);
    if (strlen($string) > $num) {

        // truncate string
        $stringCut = substr($string, 0, $num);
        $endPoint = strrpos($stringCut, ' ');

        //if the string doesn't contain any space then it will cut without word basis.
        $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
        $string .= '...';
    }
    echo $string;
}

 ?>