<?php
/**
 * Created by PhpStorm.
 * User: spider-ninja
 * Date: 2/20/17
 * Time: 5:07 PM
 */

function getTestResult($userMd5,$testId){
    /*
     * {
     *  Total Questions:50,
     *  Answered: 	40,
     *  Correct: 	28,
     *  Wrong: 	12,
     *  Earned: 200
     * }
     * */

    $request = \Slim\Slim::getInstance()->request();

    $user = json_decode($request->getBody());

    $sql = "SELECT a.`id`, a.`test_id`, a.`question_id`, a.`response`, b.answer
                  FROM `responses` as a INNER JOIN questions as b WHERE a.question_id = b.id and `test_id` = :test_id";

    $sqlUpdateResponse = "update responses set status = :status where id = :id";
    $sqlUpdateTest = 'update tests
set amount_made = :amount,total_questions =:total_questions,answered=:answered,correct=:correct,wrong=:wrong where id =:id';


    try {
        $response1 = array();

        $db = getDB();
        $stmt = $db->prepare($sql);

        $stmt->bindParam("test_id", $testId);



        $stmt->execute();
        $responses = $stmt->fetchAll(PDO::FETCH_OBJ);
        $response1['total_questions'] = count($responses);
        $response1['answered'] = 0;
        $response1['correct'] = 0;
        $response1['wrong'] = 0;
        $response1['earned'] = 0;
        //var_dump($subjects);die();

        foreach($responses as $response){
            $status = "";
            if($response->answer == $response->response){
                $response1['correct'] += 1 ;
                $response1['earned'] += 5 ;
                $response1['answered'] += 1;
                $status = 'correct';
            }
            else if($response->response != 0) {
                $response1['answered'] += 1;
                $response1['wrong'] += 1;
            }

            if($status == "")
                $status = 'incorrect';

            $stmt = $db->prepare($sqlUpdateResponse);

            $stmt->bindParam("status", $status);
            $stmt->bindParam("id", $response->id);

            $stmt->execute();

        }

        $stmt = $db->prepare($sqlUpdateTest);

        $stmt->bindParam("amount", $response1['earned']);
        $stmt->bindParam("total_questions", $response1['total_questions']);
        $stmt->bindParam("answered", $response1['answered']);
        $stmt->bindParam("correct", $response1['correct']);
        $stmt->bindParam("wrong", $response1['wrong']);
        $stmt->bindParam("id", $testId);

        $stmt->execute();

        //var_dump($response1);die();

        $db = null;

        echo '{"subjects": ' . json_encode($response1) . '}';



    } catch (Exception $e) {
        //error_log($e->getMessage(), 3, '/var/tmp/php.log');
        echo '{"error":{"text":"' . $e->getMessage() . '"}}';
    }
}