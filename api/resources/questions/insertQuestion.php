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
                      (`question`, `img_id`, `option_1`, `option_2`, `option_3`, `option_4`, `answer`, `topic_id`,`source`)
                      VALUES
                      (:question,:img_id,:option_1,:option_2,:option_3,:option_4,:answer,:topic_id)";

    try {


        $db = getDB();
        $stmt = $db->prepare($sql);

        $stmt->bindParam("question", htmlspecialchars($question->question), ENT_QUOTES);
        $stmt->bindParam("img_id", htmlspecialchars($question->img_id, ENT_QUOTES));
        $stmt->bindParam("option_1", htmlspecialchars($question->option_1, ENT_QUOTES));
        $stmt->bindParam("option_2", htmlspecialchars($question->option_2, ENT_QUOTES));
        $stmt->bindParam("option_3", htmlspecialchars($question->option_3, ENT_QUOTES));
        $stmt->bindParam("option_4", htmlspecialchars($question->option_4, ENT_QUOTES));
        $stmt->bindParam("answer", $question->answer);
        $stmt->bindParam("topic_id", $question->topic_id);
        $stmt->bindParam("source", $question->source);


        $stmt->execute();

        $question->id = $db->lastInsertId();


        $db = null;

        echo '{"question": ' . json_encode($question) . '}';


    } catch (PDOException $e) {
        //error_log($e->getMessage(), 3, '/var/tmp/php.log');
        echo '{"error":{"text":"' . $e->getMessage() . '"}}';
    }
}