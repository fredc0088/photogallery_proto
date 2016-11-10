<?php

/*
 * module: Building Web Application using PHP with MySql
 * author : Federico Cocco
 * username :  fcocco01 
 * Birkbeck University of London 
 * tutor : John Macnabb
 *
 * February 2016
 * I declare this being my work, designed and developed by myself 
 * I have also made use of the material provided on the slides, the FMA 
 * workshop and some code inspired from PHP manual and W3SCHOOL
 * 
 *
 * Here lie all the functions that process data. They are being called in the 
 * other pages when needed
 */

include("include/config.ini.php");
include_once("include/functions.php");
//Prep
include_once 'include/lang/en.php';

//statement that checks wheter there is a style.css file 
if (file_exists('include/css/style.css')) {
    $style = '<link rel="stylesheet" href="include/css/style.css">';
} else {
    $style = '';
}
	
//establish connection to a DB
require_once "include/class/DBconnection.class.php";
$con = new DBconnection(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$connection = $con->dbConnect();

//if a link in the menu bar is selected, it sends out a different view.
//Otherwise the main view will be the default
if (isset($_GET['action'])) {
    $action = trim(filter_var($_GET['action'], FILTER_SANITIZE_STRING));
} else {
    $action = '';
}
if ($action == 'artists') {
    $heading = $lang['active_artist'];
    $content = getActiveArtists($connection);
} else if ($action === 'songs') {
    $heading = $lang['songs_link'];
    $content = getSongsList($connection);
} else {
    $heading = $lang['welcome'];
    $content = homeView();
}



$summary = footerShow($connection);

$file = 'include/template/main.html';
$page = file_get_contents($file);
$footer_tpl = 'include/template/footer.html';
$footer_tpl = file_get_contents($footer_tpl);


/*
 * This fragment of code replace template tags
 * in different views
 * 
 */
$page = str_replace('[+style+]', $style, $page);
$page = str_replace('[+website_name+]', 'W1 Music', $page);
$page = str_replace('[+heading+]', $heading, $page);
$page = str_replace('[+content+]', $content, $page);
echo $page;
$page2 = str_replace('[+footer+]', $summary, $footer_tpl);
echo $page2;

// close db connection
$con->dbDisconnect();

// include the tail of the html main
include_once 'include/template/endOfHtml.html';
