<?php
/**
 * Created by PhpStorm.
 * User: spider-ninja
 * Date: 3/16/17
 * Time: 4:37 PM
 */

function getAllUsers(){
    $sql = "SELECT `id`, `username`, `email`, `mobile`, `ref_user_id`, `md5`, `creation`, `amount`, `exam_id`, `email_verified`, `sms_verified` FROM `users` WHERE 1";

    try {

        $db = getDB();
        $stmt = $db->prepare($sql);

        $stmt->bindParam("topic_id", $topicId);

        $stmt->execute();
        $videos = $stmt->fetchAll(PDO::FETCH_OBJ);

        $db = null;

        echo '{"users": ' . json_encode($videos) . '}';



    } catch (Exception $e) {
        //error_log($e->getMessage(), 3, '/var/tmp/php.log');
        echo '{"error":{"text":"' . $e->getMessage() . '"}}';
    }
}