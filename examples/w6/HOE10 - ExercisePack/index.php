<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <title>BBK ITApps - Building Web Applications using MySQL and PHP: Manipulating Graphics</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    </head>
    <body>
    
        <img src="create.php" alt="My streamed pic" />
        
        <?php
        // Part 2, resizing images
        
        // Require the config settings
        require_once 'includes/config.inc.php';
		
		// Require the image manipulation function
        require_once 'includes/functions.inc.php';

        // Call img_resize function with suitable parameters
		// e.g. img_resize('racoon.jpg', $config['thumbs_dir'].'racoon_small.jpg', 200, 200);
		
		// If resizing was successful display images, in HTML image tag
		
		// Otherwise echo appropriate error

        ?>
    </body>
</html>