<?php
/**
 * Created by PhpStorm.
 * User: spider-ninja
 * Date: 6/22/16
 * Time: 3:06 PM
 */


function getFile($username, $fileId){

    $sql = "SELECT * FROM files WHERE id=:id and username =:username ";

    try {
        $db = getDB();
        $stmt = $db->prepare($sql);

        $stmt->bindParam("id", $fileId);
        $stmt->bindParam("username", $username);

        $stmt->execute();
        $file = $stmt->fetchAll(PDO::FETCH_OBJ);

        $root = "/var/www/html/shatkonlabs/prod/file-dog-files/";


        $db = null;

        if (file_exists($root.$file[0]->location)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="'.basename($root.$file[0]->file_name).'"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($root.$file[0]->location));
            readfile($root.$file[0]->location);
            exit;
        } else {
            $defFile = "/var/www/html/shatkonlabs/prod/file-dog/web-site/logo.jpg";
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="'.basename($defFile).'"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($defFile));
            readfile($defFile);
            exit;

        }


    } catch (PDOException $e) {
        //error_log($e->getMessage(), 3, '/var/tmp/php.log');
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}