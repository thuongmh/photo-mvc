<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 12/22/2016
 * Time: 4:04 PM
 */

namespace App\Core;

use PDO;

class Controller
{
    /**
     * @var null Database Connection
     */
    public $db = null;


    /**
     * Whenever controller is created, open a database connection too and load "the model".
     */
    function __construct()
    {
        try {
            self::openDatabaseConnection();
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
    }

    /**
     * Open the database connection with the credentials from application/config/config.php
     */
    private function openDatabaseConnection()
    {
        try {
            // set the (optional) options of the PDO connection. in this case, we set the fetch mode to
            // "objects", which means all results will be objects, like this: $result->user_name !
            // For example, fetch mode FETCH_ASSOC would return results like this: $result["user_name] !
            // @see http://www.php.net/manual/en/pdostatement.fetch.php
            $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING);

            // generate a database connection, using the PDO connector
            // @see http://net.tutsplus.com/tutorials/php/why-you-should-be-using-phps-pdo-for-database-access/
            $this->db = new PDO(getenv('DB_TYPE') . ':host=' . getenv('DB_HOST') . ';dbname=' . getenv('DB_NAME') . ';charset=' . DB_CHARSET, getenv('DB_USER'), getenv('DB_PASS'), $options);
        } catch (PDOException $e) {
            die($e->getMessage());
        }

    }


}
