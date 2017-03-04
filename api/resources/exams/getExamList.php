<?php
/**
 * Created by PhpStorm.
 * User: spider-ninja
 * Date: 3/4/17
 * Time: 9:06 PM
 */

function getExamList(){

    $sql = "Select * from exams WHERE 1";

    try {

        $db = getDB();
        $stmt = $db->prepare($sql);



        $stmt->execute();
        $exams = $stmt->fetchAll(PDO::FETCH_OBJ);

        $db = null;

        echo '{"exams": ' . json_encode($exams) . '}';



    } catch (Exception $e) {
        //error_log($e->getMessage(), 3, '/var/tmp/php.log');
        echo '{"error":{"text":"' . $e->getMessage() . '"}}';
    }
}

