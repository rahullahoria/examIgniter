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

    $sql = "SELECT a.id, a.question, a.img_id, a.option_1, a.option_2, a.option_3, a.option_4, b.response
                  FROM `questions` as a INNER JOIN responses as b
                  WHERE
                    b.test_id = :test_id
                    and b.question_id = a.id
                    and  a.id = :id";




    try {

        $db = getDB();
        $stmt = $db->prepare($sql);

        $stmt->bindParam("id", $questionNo);

        $stmt->execute();
        $questions = $stmt->fetchAll(PDO::FETCH_OBJ);


        //var_dump($response1);die();

        $db = null;

        echo '{"questions": ' . json_encode($questions) . '}';



    } catch (Exception $e) {
        //error_log($e->getMessage(), 3, '/var/tmp/php.log');
        echo '{"error":{"text":"' . $e->getMessage() . '"}}';
    }
}