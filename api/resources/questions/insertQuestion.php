<?php
/**
 * Created by PhpStorm.
 * User: spider-ninja
 * Date: 2/24/17
 * Time: 1:56 PM
 */

function insertQuestion(){
    $request = \Slim\Slim::getInstance()->request();

    $question = json_decode($request->getBody());

    $sql = "INSERT INTO `questions`
                      (`question`, `img_id`, `option_1`, `option_2`, `option_3`, `option_4`, `answer`, `topic_id`)
                      VALUES
                      (:question,:img_id,:option_1,:option_2,:option_3,:option_4,:answer,:topic_id)";

    try {


        $db = getDB();
        $stmt = $db->prepare($sql);

        $stmt->bindParam("question", $question->question);
        $stmt->bindParam("img_id", $question->img_id);
        $stmt->bindParam("option_1", $question->option_1);
        $stmt->bindParam("option_2", $question->option_2);
        $stmt->bindParam("option_3", $question->option_3);
        $stmt->bindParam("option_4", $question->option_4);
        $stmt->bindParam("answer", $question->answer);
        $stmt->bindParam("topic_id", $question->topic_id);


        $stmt->execute();

        $question->id = $db->lastInsertId();


        $db = null;

        echo '{"question": ' . json_encode($question) . '}';


    } catch (PDOException $e) {
        //error_log($e->getMessage(), 3, '/var/tmp/php.log');
        echo '{"error":{"text":"' . $e->getMessage() . '"}}';
    }
}