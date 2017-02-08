<?php
//
//define('ROOT', dirname(__DIR__) . DIRECTORY_SEPARATOR);
//// set a constant that holds the project's "application" folder, like "/var/www/application".
//define('APP', ROOT . 'application' . DIRECTORY_SEPARATOR);
//date_default_timezone_set("Asia/Bangkok");
//// This is the auto-loader for Composer-dependencies (to load tools into your project).
//require ROOT . 'vendor/autoload.php';
//
//$client = new \AlgoliaSearch\Client("CE3HYAJLFY", "b11f9cc56c414c141b5e6107c4114bcf");
//$index = $client->initIndex('albums');
//$pdo = new PDO('mysql:host=localhost;dbname=photo', 'root', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
////$results = $pdo->query('SELECT user_id, username, email, avatar, fullname from users');
//$results = $pdo->query('SELECT album_id, caption, content, content_type from albums');
////$results = $pdo->query('SELECT image_id, title, caption FROM images');
//if ($results)
//{
//    $batch = array();
//    // iterate over results and send them by batch of 10000 elements
//    foreach ($results as $row)
//    {
//        // select the identifier of this row
//        $row['objectID'] = $row['album_id'];
//        array_push($batch, $row);
//
//        if (count($batch) == 10000)
//        {
//            $index->saveObjects($batch);
//            $batch = array();
//        }
//    }
//
//    $index->saveObjects($batch);
//}

session_start();
// set a constant that holds the project's folder path, like "/var/www/".
// DIRECTORY_SEPARATOR adds a slash to the end of the path
define('ROOT', dirname(__DIR__) . DIRECTORY_SEPARATOR);
// set a constant that holds the project's "application" folder, like "/var/www/application".
define('APP', ROOT . 'application' . DIRECTORY_SEPARATOR);
date_default_timezone_set("Asia/Bangkok");
// This is the auto-loader for Composer-dependencies (to load tools into your project).
require ROOT . 'vendor/autoload.php';

// load application config (error reporting etc.)
require APP . 'config/config.php';

// load database info
$dotenv = new \Dotenv\Dotenv(ROOT);
$dotenv->load();

// load application class
use App\Core\Application;

$app = new Application();