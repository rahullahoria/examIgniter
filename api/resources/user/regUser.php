<?php
/**
 * Created by PhpStorm.
 * User: spider-ninja
 * Date: 3/4/17
 * Time: 8:06 AM
 */

function regUser(){
    $request = \Slim\Slim::getInstance()->request();

    $requestJson = json_decode($request->getBody());

    $getUserId = "SELECT id FROM  users where username = :username";

    $sql = "INSERT INTO `users`(`username`, `email`, `mobile`, `ref_user_id`, `password`, `md5`,`exam_id`)
              VALUES
            (:username, :email, :mobile, :ref_user_id, :password, :md5, :exam_id)";


    $updateOTP = 'update users set sms_otp = :sms_otp, email_otp = :email_otp where 1';


    try {

        if(isset($requestJson->reg_username) &&
            isset($requestJson->email) &&
            isset($requestJson->mobile) &&
            isset($requestJson->reg_password) &&
            isset($requestJson->exam_id) &&
            isset($requestJson->ref_username)
        ) {

            $db = getDB();
            $stmt = $db->prepare($getUserId);

            $stmt->bindParam("username", $requestJson->ref_username);

            $stmt->execute();
            $refIdArr = $stmt->fetchAll(PDO::FETCH_OBJ);

            if (count($refIdArr) == 0) {
                echo '{"error":{"text":"this bitch is not registered"}}';
                die();
            }
            //var_dump($response1);die();


            $stmt = $db->prepare($sql);

            $stmt->bindParam("username", $requestJson->reg_username);
            $stmt->bindParam("email", $requestJson->email);
            $stmt->bindParam("mobile", $requestJson->mobile);
            $stmt->bindParam("ref_user_id", $refIdArr[0]->id);
            $stmt->bindParam("password", $requestJson->reg_password);
            $stmt->bindParam("md5", md5($requestJson->username));
            $stmt->bindParam("exam_id", md5($requestJson->exam_id));

            //$stmt->execute();


            $requestJson->id = $db->lastInsertId();
            if($requestJson->id){
                $optSMS = getOTP();
                $message = "Thank you for registring with ExamHans.com,\nyou Mobile OTP is\n".$optSMS;
                sendSMS($requestJson->mobile, $message);

                $opt = getOTP();
                var_dump($optSMS,$opt);die();
                $subject = "Activate you ExamHans Account by OTP ".$opt;
                $message = "Thank you for registring with ExamHans.com,\nyou Email OTP is\n <h1>".$opt."</h1>";
                sendMail($requestJson->email, $subject, $message);

                $stmt = $db->prepare($updateOTP);
                $stmt->bindParam("sms_otp", $optSMS);
                $stmt->bindParam("email_otp", $opt);
                $stmt->execute();


            }
            $db = null;


            echo '{"results": ' . json_encode($requestJson) . '}';

        }

    } catch (Exception $e) {
        //error_log($e->getMessage(), 3, '/var/tmp/php.log');
        echo '{"error":{"text":"' . $e->getMessage() . '"}}';
    }
}