<?php
/**
 * Created by PhpStorm.
 * User: spider-ninja
 * Date: 2/20/17
 * Time: 5:06 PM
 */

function saveTestQuestionAnswer($userMd5,$testId,$responseId){
    /* {question_id:id,response:2}*/

    $request = \Slim\Slim::getInstance()->request();

    $response = json_decode($request->getBody());

    $sql = "UPDATE `responses`
                SET `response`=:response, submit_response =:submit_response
                WHERE id = :id ";




    try {

        $db = getDB();
        $stmt = $db->prepare($sql);

        $stmt->bindParam("id", $responseId);
        $stmt->bindParam("response", $response->response);
        $stmt->bindParam("submit_response", date("Y-m-d H:i:s"));

        $stmt->execute();

        //var_dump($response1);die();

        $db = null;

        echo '{"status": true}';



    } catch (Exception $e) {
        //error_log($e->getMessage(), 3, '/var/tmp/php.log');
        echo '{"error":{"text":"' . $e->getMessage() . '"}}';
    }
}