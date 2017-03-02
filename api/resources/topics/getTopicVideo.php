<?php
/**
 * Created by PhpStorm.
 * User: spider-ninja
 * Date: 3/2/17
 * Time: 3:31 PM
 */

function getTopicVideo($topicId){


    $sql = "SELECT `id`, `topic_id`, `url`, `creation` FROM `topic_videos` WHERE `topic_id` = :topic_id";

    try {

        $db = getDB();
        $stmt = $db->prepare($sql);

        $stmt->bindParam("topic_id", $topicId);

        $stmt->execute();
        $videos = $stmt->fetchAll(PDO::FETCH_OBJ);

        $db = null;

        echo '{"videos": ' . json_encode($videos) . '}';



    } catch (Exception $e) {
        //error_log($e->getMessage(), 3, '/var/tmp/php.log');
        echo '{"error":{"text":"' . $e->getMessage() . '"}}';
    }
}