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

class Upload_controller {

    /**
     * The resource file
     *
     * @access private
     * @var resource
     */
    private $source;

    /**
     * The details (such heigth,width, etc..) of the file
     * obtained with getimagesize
     *
     * @access private
     * @var array
     */
    private $details;

    /**
     * flag to keep the upload process continuing
     *
     * @access private
     * @var boolean
     */
    private $ok = FALSE;

    /**
     * flag to check if the dimensions of the image exceed
     *
     * @access private
     * @var boolean
     */
    private $excess_dim = FALSE;

    /**
     * root directory to append
     *
     * @access private
     * @var string
     */
    private $root;

    /**
     * file name of the original resource
     *
     * @access private
     * @var string
     */
    private $or_file_name;

    /**
     * unique id as new file name for the new resource
     * its original type is appended as only jpeg are accepted
     *
     * @access private
     * @var string
     */
    private $id;

    /**
     * width of the image
     *
     * @access private
     * @var int
     */
    private $width;

    /**
     * heigth of the image
     *
     * @access private
     * @var int
     */
    private $heigth;


    public function __construct($src, $root) {
        $this->source = $src;
        $this->details = getimagesize($src['tmp_name']);
        $this->root = $root;
        $this->or_file_name = basename($src["name"]);
        $this->id = uniqid() . '.' . pathinfo($src['name'], PATHINFO_EXTENSION);
    }

    function checkUploading() {
        if (is_uploaded_file($_FILES['userfile']['tmp_name']) && $_FILES['userfile']['type'] === 'image/jpeg') {
            $this->ok = TRUE;
            if ($this->details > 600) {
                $this->excess_dim = TRUE;
            }
        } else {
            $error = '<p>An error occur during upload or there was an attempt to upload a file different than jpeg<br>';
            $error .= 'NOTE: Only jpeg image can be uploaded. Please check your file type<p>';
            header('Location:index.php?message=' . $error);
        }
    }

    /*
     * Check if a file with the same name is already saved 
     * 
     * @params string $dir
     * 
     * file_isset
     */

    function file_isset($dir) {
        //Check if file already exists
        if (file_exists($this->root . $dir . $this->id)) {
            $error = "Sorry, file already exists.";
            $this->ok = FALSE;
            header('Location:index.php?message=' . $error);
        }
    }

    /*
     * Takes care of the actual upload 
     * 
     * @params string $target, int $dim_heigth $dim_width
     * 
     * file_isset
     */

    function upload($target, $dim_heigth, $dim_width) {
        //error
        if ($this->ok === FALSE) {
            $error = "Sorry, your file was not uploaded.";
            header('Location:index.php?message=' . $error);
            // ok, but image needs to be resized
        } else if ($this->ok === TRUE && $this->excess_dim === TRUE) {
            $this->resize($dim_heigth, $dim_width);
            $this->create_newJpeg($target);
            $this->ok = TRUE;
            // upload allowed    
        } else {
            if (move_uploaded_file($this->source['tmp_name'], $this->root . $target . $this->id)) {
                $this->ok = TRUE;
            } else {
                $error = "There was an error uploading your file.";
                $this->ok = FALSE;
                header('Location:index.php?message=' . $error);
            }
        }
    }

    /*
     * If the image exceeds the parameters, new parameter
     * for the size are set  
     * 
     * @params int $new_width $new_heigth
     * 
     * resize
     */

    function resize($new_width, $new_heigth) {
        if ($this->details[0] > $new_width) {
            $this->width = $new_width;
        } else {
            $this->width = $this->details[0];
        }
        if ($this->details[1] > $new_heigth) {
            $this->heigth = $new_heigth;
        } else {
            $this->heigth = $this->details[1];
        }
    }

    /*
     * create a new jpeg image 
     * 
     * @params string $dir
     * 
     * create_newJpeg
     */

    function create_newJpeg($dir) {
        $img = imagecreatetruecolor($this->heigth, $this->width);
        $pic = imagecreatefromjpeg($this->source['tmp_name']);
        imagecopyresampled($img, $pic, 0, 0, 0, 0, $this->width, $this->heigth, $this->details[0], $this->details[1]);
        imagejpeg($img, $this->root . $dir . $this->id, 100);
        imagedestroy($pic);
        imagedestroy($img);
    }

    /*
     * create thumbnails 
     * 
     * @params string $dir, int $dim_heigth, $dim_width
     * 
     * create_thumb
     */

    function create_thumb($dir, $dim_heigth, $dim_width) {
        if ($this->ok === TRUE) {
            $this->resize($dim_heigth, $dim_width);
            $this->create_newJpeg($dir);
        }
    }

    /*
     * prepare query for upload on database 
     * 
     * @params string $dir $description
     * 
     * @return string $string_query or empty
     * 
     * prepareInsert
     */

    function prepareInsert($dir, $description) {
        if ($this->ok === TRUE) {
            $description = trim(filter_var($description,FILTER_SANITIZE_STRING,FILTER_FLAG_NO_ENCODE_QUOTES));
            $file = $this->root . $dir . $this->id;
            $file_details = getimagesize($file);
            $string_query = 'INSERT INTO image_file '
                    . '(title, filename, description, heigth, width, path) VALUES '
                    . '("' . $this->or_file_name . '","' . $this->id . '","'
                    . $description . '",' . $file_details[0] . ','
                    . $file_details[1] . ',"' . $dir . '");';
            return $string_query;
        }
        return '';
    }

    /*
     * confirm success saving of the file and allow to continue the process
     * 
     * @return boolean
     * 
     * confirm_success
     */

    function confirm_success() {
        if ($this->ok === TRUE) {
            header('Location:index.php');
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
