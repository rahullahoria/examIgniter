<?php
/**
 * Created by PhpStorm.
 * User: spider-ninja
 * Date: 6/22/16
 * Time: 3:06 PM
 */
define('MB', 1048576);

function saveFile($username){

    $request = \Slim\Slim::getInstance()->request();

    $file = json_decode("{'file_name':'','size':''}");
    //var_dump($_FILES["fileToUpload"]["name"]);die();
    //$file->file_name = $_FILES["fileToUpload"]["name"];
    //$file->size = $_FILES['fileToUpload']['size']/MB;






    $sql = "insert into files ( file_name, username, location, size) VALUES ( :file_name, :username, :location, :size)";

    try {

        $filePath = checkNCreateFolder($username, date("Y-m-d") ) . "/" . date("h:i:sa") . "_" . $_FILES["fileToUpload"]["name"];

        saveFile1($filePath);

        $size = $_FILES['fileToUpload']['size']/MB;

        $db = getDB();
        $stmt = $db->prepare($sql);

        $stmt->bindParam("file_name", $_FILES["fileToUpload"]["name"]);
        $stmt->bindParam("username", $username);
        $stmt->bindParam("location", $filePath);
        $stmt->bindParam("size", $size);


        $stmt->execute();

        $id = $db->lastInsertId();


        $db = null;

        echo '{"file": { "id":"' . $id . '"}}';


    } catch (PDOException $e) {
        //error_log($e->getMessage(), 3, '/var/tmp/php.log');
        echo '{"error":{"text":"' . $e->getMessage() . '"}}';
    }
}

function checkNCreateFolder($username, $dir)
{
    //global $configs;

    //$root = $configs['COLLAP_FILE_ROOT'];
    $root = "/var/www/html/shatkonlabs/prod/file-dog-files/";

    if (!file_exists($root . $username)) {

        mkdir($root . $username, 0777, true);
    }
    if (!file_exists($root . $username . "/" . $dir)) {
        mkdir($root . $username . "/" . $dir, 0777, true);
    }
    return $username . "/" . $dir;
}

function saveFile1($filePath){

    //global $configs;
    //$root = $configs['COLLAP_FILE_ROOT'];
    $root = "/var/www/html/shatkonlabs/prod/file-dog-files/";

    if (file_exists($root . $filePath)) {

        //echo $_FILES["file"]["name"] . " already exists. ";
    } else {

        move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $root . $filePath);

    }
}


?>
