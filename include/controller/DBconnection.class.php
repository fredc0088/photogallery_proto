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

//include 'include/lang/en.php';

/**
 * This class (from my PHP and MYSQL's TMA) create and 
 * manage a connection to a database 
 */
class DBconnection {

    /**
     * host
     *
     * @access public
     * @var string
     */
    public $host_server;

    /**
     * username for access
     *
     * @access public
     * @var string
     */
    public $username;

    /**
     * password
     *
     * @access public
     * @var string
     */
    public $password_sql;

    /**
     * databases to be accessed
     *
     * @access public
     * @var string
     */
    public $database_used;

    /**
     * connection
     *
     * @access public
     * @var mysql connection 
     */
    public $connection;

    public function __construct($host_name, $username_used, $password_used, $database_accessed) {
        $this->host_server = $host_name;
        $this->username = $username_used;
        $this->password_sql = $password_used;
        $this->database_used = $database_accessed;
    }

    /*
     * Retrieve the outcome of the service
     * 
     * @return mysql connection $connection
     * 
     * dbConnect
     */

    public function dbConnect() {
        $this->connection = mysqli_connect($this->host_server, $this->username, $this->password_sql, $this->database_used);
        // check connection 
        if ($this->connection->connect_errno) {
            $error =  "Problem of connection";
            header('Location:index.php?message=' . $error);
        }
        return $this->connection;
    }

    /*
     * Destroy current connection
     * dbDisconnect
     */

    public function dbDisconnect() {
        // free result set 
        if (!empty($this->connection)) {
            $this->connection->close();
            unset($this->connection);
        }
    }

}
