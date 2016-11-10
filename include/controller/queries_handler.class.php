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
 * This class inherits from my old class DBconnection to manage a connection
 * to a database mysql.
 * Also it is designed to manage the queries passed on. 
 */

require_once 'DBconnection.class.php';
require_once './include/model/queries.php';

class queries_handler extends DBconnection {

    /**
     * It can either contain the mysql query with its instruction 'case' or
     * the query itself 
     *
     * @access private
     * @var array or string
     */
    private $query;

    /*
     * Modify the query depending on the parameters
     * 
     * @param OPTIONAL (string or array) $request 
     *        OPTIONAL string $user_query
     * 
     * change_query
     */

    function change_query($request = NULL, $user_query = NULL) {
        $default_query = array(
            'case' => 'select',
            'query' => QUERY_SELECT_ALL
        );
        if (!empty($request) && !is_bool($request)) {
            $getValue = array_keys($request);
            $sanitized_req = filter_var($getValue[0], FILTER_SANITIZE_STRING);
            switch ($sanitized_req) {
                case 'IMG' :
                    $this->query = array(
                        'case' => 'real_img',
                        'query' => QUERY_SELECT_IMG
                    );
                    break;
                case 'INFO' :
                    $this->query = array(
                        'case' => 'api',
                        'query' => QUERY_SELECT_JSON
                    );
                    break;
                default :
                    $this->query = $default_query;
            }
        } else if (is_bool($request)) {
            $this->query = array(
                'case' => 'insert',
                'query' => $user_query
            );
        } else {
            $this->query = $default_query;
        }
    }

    /*
     * Wrapper that handles the query and acts also as a further decisioner
     * of which query will be processed and how
     * 
     * @param OPTIONAL string $info_req 
     *        
     * requests_DB_wrapper
     */

    function requests_DB_wrapper($info_req = null) {
        $results = '';
        if (is_array($this->query)) {
            if (mysqli_connect_errno()) {
                $errors = mysqli_connect_error();
                header('Location:index.php?message=' . $errors);
            }
            if (array_key_exists('case', $this->query) && $this->query['case'] === 'insert') {
                $this->query = $this->query['query'];
                $results = $this->update_DB();
            } else if (array_key_exists('case', $this->query) && $this->query['case'] === 'select') {
                $this->query = $this->query['query'];
                $results = $this->retrieve_img();
            } else if (isset($info_req)) {
                $info_req = trim(filter_var($info_req, FILTER_SANITIZE_STRING));
                $query_filter = ' WHERE filename = "' . $info_req . '"';
                if (array_key_exists('case', $this->query) && $this->query['case'] === 'real_img') {
                    $this->query = $this->query['query'] . $query_filter;
                    $results = $this->retrieve_img();
                } else if (array_key_exists('case', $this->query) && $this->query['case'] === 'api') {
                    $this->query = $this->query['query'] . $query_filter;
                    $results = $this->retrieve_info();
                }
            }
        }
        return $results;
    }

    /*
     * Retrieve data from db and open a webservice to get JSON
     * 
     *        
     * @return string json $structure;
     * 
     * retrieve_info
     */

    function retrieve_info() {
        // Execute the query, assigning the result to $result
        $result = mysqli_query($this->connection, $this->query);
        // If the query failed, $result will be "false", so we test for this, and exit if it is
        if ($result === false) {
            $error = "Error retrieving records from database: mysqli_error($this->connection)";
            header('Location:index.php?message=' . $error);
        }
        // Check if the query returned anything
        else if (mysqli_num_rows($result) > 0) {
            // Make result into array of JSON objects
            $row = mysqli_fetch_assoc($result);
            include_once('web_service.class.php');
            $service = new web_service($row);
            $service->server();
            $structure = $service->outcome();
            //garbage collection
            unset($service);
        } else {
            $structure = 'No images oin the database';
        }
        return $structure;
    }

    /*
     * Retrieve data from db and open a webservice to get JSON
     * 
     *        
     * @return multidimensional array $img;
     * 
     * retrieve_img
     */

    function retrieve_img() {
        $result = mysqli_query($this->connection, $this->query);
        // check query 
        if ($result === false) {
            $error = "Error retrieving records from database: mysqli_error($this->connection)";
            header('Location:index.php?message=' . $error);
        } else {
            $img = array();
            if ($result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                    $inner_array = array();
                    $inner_array['title'] = $row["title"];
                    $inner_array['filename'] = $row["filename"];
                    array_push($img, $inner_array);
                    unset($inner_array);
                }
                mysqli_free_result($result);
            } else {
                $img = "No results to display.";
            }
            return $img;
        }
    }

    /*
     * Update a database with new data
     * 
     *        
     * @return multidimensional array $img;
     * 
     * update_DB
     */

    function update_DB() {
        $result = mysqli_query($this->connection, $this->query);
        if ($result === false) {
            $error = "Error retrieving records from database: mysqli_error($this->connection)";
            header('Location:index.php?message=' . $error);
        } else {
            $successful = 'Data inserted...';
            return $successful;
        }
    }

}
