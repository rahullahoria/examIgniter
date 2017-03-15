<?php
/**
 * Created by PhpStorm.
 * User: spider-ninja
 * Date: 2/20/17
 * Time: 5:05 PM
 */

function startTopicTest($userMd5){

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


    $sqlConStmt = "SELECT `id` FROM `connected_stmts` WHERE topic_id =:topic_id ORDER BY RAND()";

    $sqlConQuestions = "SELECT a.id
                  FROM `questions` as a  WHERE  a.status = 'active' and a.connected_stmt_id = :connected_stmt_id ";

    $sql = "SELECT a.id
                  FROM `questions` as a  WHERE  a.status = 'active' and a.topic_id = :topic_id ORDER BY RAND() limit 0,".$topic->no_of_question;

    $sqlGettingUserId = "Select id from users where md5 = :user_md5";

    $sqlCreateTest = "INSERT INTO `tests`(`topic_id`, `user_id`)
                          VALUES (:topic_id, :user_id)";

    $sqlSaveQuestion = "INSERT INTO `responses`(`test_id`, `question_id`)
                              VALUES (:test_id, :question_id)";


    try {

        $response = array();
        $questions = array();

        $db = getDB();
        //Getting Questions

        if($topic->atomic == 0) {
            $stmt = $db->prepare($sql);
            $stmt->bindParam("topic_id", $topic->topic_id);

            $stmt->execute();
            $questions = $stmt->fetchAll(PDO::FETCH_OBJ);
        } else {
            $stmt = $db->prepare($sqlConStmt);
            $stmt->bindParam("topic_id", $topic->topic_id);

            $stmt->execute();
            $conStmts = $stmt->fetchAll(PDO::FETCH_OBJ);

            for($i=0;$i<count($conStmts) && count($questions)<=$topic->no_of_question;$i++){
                $stmt = $db->prepare($sqlConQuestions);
                $stmt->bindParam("connected_stmt_id", $conStmts[$i]->id);

                $stmt->execute();
                $tQuestion = $stmt->fetchAll(PDO::FETCH_OBJ);
                foreach($tQuestion as $q){
                    //$q->stmt = $conStmts[$i]->stmt;
                    $questions[] = $q;
                }
            }

        }
            // var_dump($questions);die();

            //getting userId
            $stmt = $db->prepare($sqlGettingUserId);
            $stmt->bindParam("user_md5", $userMd5);
            $stmt->execute();
            $users = $stmt->fetchAll(PDO::FETCH_OBJ);

            //creating test
            $stmt = $db->prepare($sqlCreateTest);

            $stmt->bindParam("topic_id", $topic->topic_id);
            $stmt->bindParam("user_id", $users[0]->id);

            $stmt->execute();
            $testId = $db->lastInsertId();
            $response['test_id'] = $testId;
            $response['test_start_time'] = date("Y-m-d H:i:s");

            //saving questions
            foreach ($questions as $question) {

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