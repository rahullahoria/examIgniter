<?php
/**
 * Created by PhpStorm.
 * User: spider-ninja
 * Date: 3/2/17
 * Time: 3:20 PM
 */

function insertTopicVideo($topicId){
    $request = \Slim\Slim::getInstance()->request();

    $response = json_decode($request->getBody());

    $sql = "INSERT INTO `topic_videos`(`topic_id`, `url`)
              VALUES (:topic_id,:url)";




    try {

        $db = getDB();
        $stmt = $db->prepare($sql);

        $stmt->bindParam("topic_id", $topicId);
        $stmt->bindParam("url", $response->url);

        $stmt->execute();

        //var_dump($response1);die();
        $response->id = $db->lastInsertId();
        $db = null;


        echo '{"results": ' . json_encode($response) . '}';



    } catch (Exception $e) {
        //error_log($e->getMessage(), 3, '/var/tmp/php.log');
        echo '{"error":{"text":"' . $e->getMessage() . '"}}';
    }
}