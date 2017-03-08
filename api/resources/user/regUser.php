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


    $updateOTP = 'update users set sms_otp = :sms_otp, email_otp = :email_otp where id = :id';


    try {

        if(isset($requestJson->reg_username) &&
            isset($requestJson->email) &&
            isset($requestJson->mobile) &&
            isset($requestJson->reg_password) &&
            isset($requestJson->exam_id)

        ) {

            $db = getDB();
            $stmt = $db->prepare($getUserId);

            $stmt->bindParam("username", $requestJson->ref_username);

            $stmt->execute();
            $refIdArr = $stmt->fetchAll(PDO::FETCH_OBJ);

            if (!isset($requestJson->ref_username) && count($refIdArr) == 0) {
                echo '{"error":{"text":"Referring User Don\'t exists "}}';
                die();
            }
            //var_dump($response1);die();

            $requestJson->md5 = md5($requestJson->reg_username);
            $stmt = $db->prepare($sql);

            $stmt->bindParam("username", $requestJson->reg_username);
            $stmt->bindParam("email", $requestJson->email);
            $stmt->bindParam("mobile", $requestJson->mobile);
            $stmt->bindParam("ref_user_id", $refIdArr[0]->id);
            $stmt->bindParam("password", $requestJson->reg_password);
            $stmt->bindParam("md5", $requestJson->md5);
            $stmt->bindParam("exam_id", $requestJson->exam_id);

            $stmt->execute();


            $requestJson->id = $db->lastInsertId();
            if($requestJson->id){
                $optSMS = getOTP();
                $message = "Thank you for registring with ExamHans.com,\nyou Mobile OTP is\n".$optSMS;
                sendSMS($requestJson->mobile, $message);

                $opt = getOTP();
                //var_dump($optSMS,$opt);die();
                $subject = "Activate you ExamHans Account by OTP ".$opt;
                $message = "Thank you for registring with ExamHans.com,\nyou Email OTP is\n <h1>".$opt."</h1>";
                sendMail($requestJson->email, $subject, $message);

                $stmt = $db->prepare($updateOTP);
                $stmt->bindParam("sms_otp", $optSMS);
                $stmt->bindParam("email_otp", $opt);
                $stmt->bindParam("id", $requestJson->id);
                $stmt->execute();


            }
            $db = null;


            echo '{"results": ' . json_encode($requestJson) . '}';

        }

    } catch (Exception $e) {
        $errorMessage = " Already Exists";
        $errors = array('username','mobile','email');
        $flag = false;
        foreach($errors as $error){
            if (strpos($e->getMessage(), $error) !== false) {
                echo '{"error":{"text":"' . $error.$errorMessage . '"}}';
                $flag = true;
            }

        }
        //error_log($e->getMessage(), 3, '/var/tmp/php.log');
        if(!$flag)
        echo '{"error":{"text":"' . $e->getMessage() . '"}}';
    }
}