<?php
/**
 * Created by PhpStorm.
 * User: spider-ninja
 * Date: 2/20/17
 * Time: 5:06 PM
 */

function getTestQuestionNo($userMd5, $testId,$questionNo){
    /*
        * {
        * question_id:3,
        *  question:'sadfasdf?',
        *  option 1: 'sdfa'
        *  option 2: 'sdfa'
        *  option 3: 'sdfa'
        *  option 4: 'sdfa'
        * }
        * */
    $request = \Slim\Slim::getInstance()->request();

    $user = json_decode($request->getBody());

    $sql = "SELECT a.id, a.question, a.img_id, a.option_1, a.option_2, a.option_3, a.option_4, a.source,
                b.response,b.id as responses_id
                  FROM `questions` as a INNER JOIN responses as b
                  WHERE
                    b.test_id = :test_id
                    and b.question_id = a.id
                    and  a.id = :id";

    $sqlUpdateGetQuestionTime = "Update responses set get_question = :question_fetch_time where id=:responses_id ";




    try {

        $db = getDB();
        $stmt = $db->prepare($sql);

        $stmt->bindParam("test_id", $testId);
        $stmt->bindParam("id", $questionNo);

        $stmt->execute();
        $questions = $stmt->fetchAll(PDO::FETCH_OBJ);

        $questions[0]->question_fetch_time =  date("Y-m-d H:i:s");
        //var_dump($response1);die();

        $stmt = $db->prepare($sqlUpdateGetQuestionTime);

        $stmt->bindParam("question_fetch_time", $questions[0]->question_fetch_time);
        $stmt->bindParam("responses_id", $questions[0]->responses_id);

        $stmt->execute();

        $db = null;

        echo '{"questions": ' . json_encode($questions) . '}';



    } catch (Exception $e) {
        //error_log($e->getMessage(), 3, '/var/tmp/php.log');
        echo '{"error":{"text":"' . $e->getMessage() . '"}}';
    }
}