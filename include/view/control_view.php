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



/*
 * This function print out a string to visualise the image
 * directly from the uploads saved
 * 
 * @params multidimensiional array $src, string $directory
 *
 * @return String $view
 * 
 * view_img
 */

function view_images($src, $directory) {
    $view = '';
	if(isset($src) && is_array($src) && isset($directory)){
    foreach ($src as $key) {
        $source = '.' . $directory . $key['filename'];
        $view .= '<div class="thumbnail">';
        $view .= "<img src= $source />";
        $view .= "<a href=index.php?IMG&ID=" . $key['filename'] . ">"
                . $key['title'] . "</a>";
        $view .= '</div>';
    }
    return $view;
	} else {
		$error = 'View_images could not find a valid parameter, probably a parameter is missing';
		header('Location:index.php?message=' . $error);
	}
}

/*
 * This function print out a string to visualise the image
 * directly from the uploads saved
 * 
 * @params multidimensiional array $src, string $directory
 *
 * @return String $view
 * 
 * view_img
 */

function view_img($src, $directory) {
	if(isset($src) && is_array($src) && isset($directory)){
		$view = '<div id="unscaled_img">';
		$source = '.' . $directory . $src[0]['filename'];
		$view .= $src[0]['title'];
		$view .= "<a href=index.php><img src= $source /></a>";
		$view .= "<br><a href=index.php?INFO&ID="
				. $src[0]['filename']
				. ">Info web service</a>";
		$view .= '</div>';
    return $view;
	} else {
		$error = 'View_img could not find a valid parameter, probably a parameter is missing';
		header('Location:index.php?message=' . $error);
	}
}
