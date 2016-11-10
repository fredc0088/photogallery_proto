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


//Define log in parameters
define('DB_HOST', '');
define('DB_USER', '');
define('DB_PASS', '');
define('DB_NAME', '');


$config['lang'] = 'en';

//Define directories
define('DIR_IMG', './img/');
define('DIR_THUMB', './img/thumbnails/');


//Define image parameters
define('MAX_HEIGTH_PIC', 600);
define('MAX_WIDTH_PIC', 600);
define('MAX_HEIGTH_THUMB', 150);
define('MAX_WIDTH_THUMB', 150);


//Define URL parameters
define('URL_CHECK_INFO', 'INFO');
define('URL_CHECK_ID', 'ID');
define('URL_CHECK', 'UPLOAD');
define('ERROR', 'message');
define('SUBMISSION', 'submit_img');
define('FILE', 'userfile');
define('DESC', 'description');