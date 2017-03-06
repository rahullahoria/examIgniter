<?php
/**
 * Created by PhpStorm.
 * User: spider-ninja
 * Date: 2/20/17
 * Time: 5:05 PM
 */

function startDemoTest($userMd5){

    /*
     * {
     * test_id:4,
     * question_ids:[]
     * question_id:3,
     *  question:'sadfasdf?',
     *  option 1: 'sdfa'
     *  option 2: 'sdfa'
     *  option 3: 'sdfa'
     *  option 4: 'sdfa'
     * }
     * */

    $request = \Slim\Slim::getInstance()->request();

    $topic = json_decode($request->getBody());



    $sql = "SELECT a.id
                  FROM `questions` as a inner join topics as b inner join topic_exam_mappings as c
                  WHERE a.status = 'active' and a.topic_id = b.id and b.id = c.topic_id and c.exam_id = 2 ORDER BY RAND() limit 0,30";

    $sqlGettingUserId = "Select id from users where md5 = :user_md5";

    $sqlCreateTest = "INSERT INTO `tests`(`topic_id`, `user_id`)
                          VALUES (0, :user_id)";

    $sqlSaveQuestion = "INSERT INTO `responses`(`test_id`, `question_id`)
                              VALUES (:test_id, :question_id)";


    try {

        $response = array();

        $db = getDB();
        //Getting Questions
        $stmt = $db->prepare($sql);

        //$stmt->bindParam("topic_id", $topic->topic_id);
        //$stmt->bindParam("no_of_question", $topic->no_of_question);


        $stmt->execute();
        $questions = $stmt->fetchAll(PDO::FETCH_OBJ);
        // var_dump($questions);die();

        //getting userId
        $stmt = $db->prepare($sqlGettingUserId);
        $stmt->bindParam("user_md5", $userMd5);
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_OBJ);

        //creating test
        $stmt = $db->prepare($sqlCreateTest);

        //$stmt->bindParam("topic_id", 0);
        $stmt->bindParam("user_id", $users[0]->id);

        $stmt->execute();
        $testId = $db->lastInsertId();
        $response['test_id'] = $testId;
        $response['test_start_time'] =  date("Y-m-d H:i:s");

        //saving questions
        foreach($questions as $question){

            /* $question->question = htmlspecialchars($question->question);
             $question->option_1 = htmlspecialchars($question->option_1);
             $question->option_2 = htmlspecialchars($question->option_2);
             $question->option_3 = htmlspecialchars($question->option_3);
             $question->option_4 = htmlspecialchars($question->option_4);*/

            $stmt = $db->prepare($sqlSaveQuestion);

            $stmt->bindParam("test_id", $testId);
            $stmt->bindParam("question_id", $question->id);

            $stmt->execute();
            $question->response_id = $db->lastInsertId();
        }

        $response['questions'] = $questions;

        $db = null;

        echo '{"response": ' . json_encode($response) . '}';

    } catch (Exception $e) {
        //error_log($e->getMessage(), 3, '/var/tmp/php.log');
        echo '{"error":{"text":"' . $e->getMessage() . '"}}';
    }
}