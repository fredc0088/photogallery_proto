<?php
/**
 * Resize images
 *
 * Function to resize images to fit area specified when called
 * 
 * @param string $in_img_file Input image file
 * @param string $out_img_file Output image filename
 * @param int $req_width Width of area the image should fill
 * @param int $req_height Height of area the image should fill
 * @return bool 
 */
function img_resize($in_img_file, $out_img_file, $req_width, $req_height) {
    
    // THE COMMENTS OUTLINE SOME OF THE REQUIRED STEPS

    // Get image file details

    // Check image type and use correct imagecreatefrom* function
    // Allow only gif, jpeg and png files
    
    // Check if image is smaller (in both directions) than required image
    // If so, use original image dimensions
    // Otherwise, Test orientation of image and set new dimensions appropriately
    // i.e. calculate the scale factor

    // Create the new canvas ready for resampled image to be inserted into it

    // Resample input image into newly created image

    // Create output jpeg at quality level of 90

    // Destroy any intermediate image files

    // Return a value indicating success or failure (true/false)
}
?>