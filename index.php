<?php

/*
 * module: Building Web Application using PHP with MySql
 * author : Federico Cocco
 * username :  fcocco01 
 * Birkbeck University of London 
 * tutor : John Macnabb
 *
 * April 2016
 * I declare this being my work, designed and developed by myself 
 * I have also made use of the material provided on the slides 
 * andsome code inspired from PHP manual and W3SCHOOL
 * Also I resued some class, logic and template from my old TMA project
 * for the same module, as I saw great reusability for them with the
 * kind of application I had in my mind
 * 
 */

include_once"include/config.ini.php";

//include_once 'include/lang/'.$lang.'.php';
//statement that checks wheter there is a style.css file 
if (file_exists('include/css/style.css')) {
    $style = '<link rel="stylesheet" href="include/css/style.css">';
} else {
    $style = '';
}



//establish connection to a DB
require_once "include/controller/queries_handler.class.php";
$con = new queries_handler(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$connection = $con->dbConnect();


include_once"include/view/control_view.php";

$request = $_GET;

//gets the errors through URL
$error_message = '';
if (isset($request[ERROR])) {
    $error_message = filter_var($request[ERROR], FILTER_SANITIZE_STRING);
}

/**
 * CONTROL OF THE VIEW
 */

//set default query
$con->change_query($request);

//checks URL to take next action and pass the right query
if (isset($request[URL_CHECK_ID]) && !empty($request[URL_CHECK_ID])) {
    if (isset($request[URL_CHECK_INFO])) {
        $content = $con->requests_DB_wrapper($request[URL_CHECK_ID]);
    } else {
        $display = $con->requests_DB_wrapper($request[URL_CHECK_ID]);
        $content = view_img($display, DIR_IMG);
    }
} else {
    //upload image
    $success = false;
    if (isset($_POST[SUBMISSION])) {
        if ($_POST[SUBMISSION]) {
            require_once("include/controller/upload.class.php");
            $upload = new Upload_controller($_FILES[FILE], getcwd());
            $upload->checkUploading();
            $upload->file_isset(DIR_IMG);
            $upload->upload(DIR_IMG, MAX_HEIGTH_PIC, MAX_WIDTH_PIC);
            $upload->create_thumb(DIR_THUMB, MAX_HEIGTH_THUMB, MAX_WIDTH_THUMB);
            $query = $upload->prepareInsert(DIR_IMG, $_POST[DESC]);
            $success = $upload->confirm_success();
            unset($upload);
        }
    }
//update database with new image's details
    if ($success) {
        if (isset($query)) {
            $con->change_query($success, $query);
            echo $con->requests_DB_wrapper();
        }
    }
    //default view
    $display = $con->requests_DB_wrapper();
    if (is_array($display)) {
        $content = view_images($display, DIR_THUMB);
    } else {
        $content = $display;
    }
}


$heading = 'welcome user';


$file = 'include/model/main.html';
$page = file_get_contents($file);


$upload_form = file_get_contents('include/model/uploading_form.html');



/*
 * This fragment of code replace template tags
 * in different views
 * 
 */
$page = str_replace('[+style+]', $style, $page);
$page = str_replace('[+website_name+]', 'PHP_fma', $page);
$page = str_replace('[+heading+]', $heading, $page);
$page = str_replace('[+form+]', $upload_form, $page);
$page = str_replace('[+errors+]', $error_message, $page);
$page = str_replace('[+content+]', $content, $page);
echo $page;


// close connection
$con->dbDisconnect();


// include the tail of the html main
include_once 'include/model/endOfHtml.html';
