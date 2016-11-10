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


//Define queries
define('QUERY_SELECT_ALL', 'SELECT * FROM image_file');
define('QUERY_SELECT_IMG', 'SELECT title,filename FROM image_file');
define('QUERY_SELECT_JSON', 'SELECT title, description, heigth, width FROM image_file');
