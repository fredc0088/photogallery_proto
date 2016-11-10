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

class web_service {

    /**
     * results
     *
     * @access private
     * @var string
     */
    private $results;

    /**
     * php data to be transformed in json
     *
     * @access private
     * @var array
     */
    private $to_be_processed;

    /**
     * errors encountetered
     *
     * @access private
     * @var string
     */
    private $errors;

    function __construct($entry) {
        $this->to_be_processed = $entry;
    }

    /*
     * Retrieve the outcome of the service
     * 
     * @return string $results
     * 
     * server
     */

    function outcome() {
        if (!empty($this->results)) {
            return $this->results;
        }
        if (!empty($this->errors)) {
            $this->errors;
            header('Location:index.php?message=' . $this->errors);
        }
    }

    /*
     * Process to convert into a json object
     * 
     * server
     */

    function server() {
        if (!empty($this->to_be_processed)) {
            $encoded_data = json_encode($this->to_be_processed, true);
        }
        if (json_last_error() == JSON_ERROR_NONE) {
            header('Content-Type: application/json');
            echo json_encode($encoded_data);
        } else {
// Errors encountered
            $errors .= '<p>Something is wrong with JSON during encoding process:';
            $errors .= '<br>';
            $errors .= 'CODE: ' . json_last_error() . '</p>';
        }
    }

    /*
     * Destroy current object
     * 
     * dismiss
     */

    function dismiss($obj) {
        unset($obj);
    }

}
