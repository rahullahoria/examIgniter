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

    $getUserId = "SELECT id FROM  users where mobile = :mobile";

    $sql = "INSERT INTO `users`(`username`, `email`, `mobile`, `ref_user_id`, `password`, `md5`,`exam_id`)
              VALUES
            (:username, :email, :mobile, :ref_user_id, :password, :md5, :exam_id)";

    $sqlUpdate = "UPDATE `users` SET
                      `username`=:username,
                      `email`=:email,
                      `ref_user_id`=:ref_user_id,
                      `password`=:password,
                      `exam_id`=:exam_id,
                      WHERE mobile = :mobile";


    $updateOTP = 'update users set sms_otp = :sms_otp, email_otp = :email_otp where id = :id';

    $sqlCheckUserState = "SELECT
                a.`id`, a.`username`, a.`mobile`, a.`ref_user_id`, a.`md5`, a.`creation`, a.`amount`, a.`exam_id`,
                    a.`sms_verified`, b.`account_holder_name`, b.`account_number`, b.`ifsc_code`, c.amount_made
                    FROM  `users` as a left join
                    bank_accounts as b on a.id = b.user_id left join
                    tests as c on a.id = c.user_id
                    WHERE a.mobile = :mobile";


    $demo = false;
    if(!isset($requestJson->reg_username)){
        $requestJson->reg_username = $requestJson->mobile;
        $demo = true;
    }
    try {

        if(/*isset($requestJson->reg_username) &&*/
            /*isset($requestJson->email) &&*/
            isset($requestJson->mobile) &&
            /*isset($requestJson->reg_password) &&*/
            isset($requestJson->exam_id)

        ) {

            $db = getDB();

            $stmt = $db->prepare($sqlCheckUserState);

            $stmt->bindParam("mobile", $requestJson->mobile);

            $stmt->execute();
            $userObjs = $stmt->fetchAll(PDO::FETCH_OBJ);

            //user trying to reg for demo again,
            // user failed to do demo and trying again
            //user failed to verify otp

            //demo done, tyring to by.



            if(count($userObjs) >= 1){

                if(!$demo){

                    $stmt = $db->prepare($getUserId);

                    $stmt->bindParam("mobile", $requestJson->ref_username);

                    $stmt->execute();
                    $refIdArr = $stmt->fetchAll(PDO::FETCH_OBJ);


                    if (isset($requestJson->ref_username) && count($refIdArr) == 0) {
                        ///echo '{"error":{"text":"Referring User Don\'t exists "}}';
                        //die();
                        $refUserID = 0;

                    } else
                        $refUserID = $refIdArr[0]->id;
                    var_dump($requestJson,$refUserID);die();
                    $stmt = $db->prepare($sqlUpdate);

                    $stmt->bindParam("username", $requestJson->reg_username);
                    $stmt->bindParam("email", $requestJson->email);

                    $stmt->bindParam("ref_user_id", $refUserID);
                    $stmt->bindParam("password", $requestJson->reg_password);
                    $stmt->bindParam("exam_id", $requestJson->exam_id);
                    $stmt->bindParam("mobile", $requestJson->mobile);

                    $stmt->execute();


                    $requestJson->id = $userObjs[0]->id;
                    $requestJson->md5 = $userObjs[0]->md5;

                        $optSMS = getOTP();
                        $message = "Thank you for registring with ExamHans.com,\nyou Mobile OTP is\n" . $optSMS;
                        sendSMS($requestJson->mobile, $message);

                        $opt = getOTP();
                        //var_dump($optSMS,$opt);die();
                        $subject = "Activate you ExamHans Account by OTP " . $opt;
                        $message = "Thank you for registring with ExamHans.com,\nyou Email OTP is\n <h1>" . $opt . "</h1>";
                        /*sendMail($requestJson->email, $subject, $message);*/

                        $stmt = $db->prepare($updateOTP);
                        $stmt->bindParam("sms_otp", $optSMS);
                        $stmt->bindParam("email_otp", $opt);
                        $stmt->bindParam("id", $requestJson->id);
                        $stmt->execute();



                    echo '{"results": ' . json_encode($requestJson) . '}';


                }else
                if($demo && ($userObjs[0]->amount_made > 0 || $userObjs[0]->amount_made != null) ){
                    echo '{"error":{"text":"You have already done demo test"}}';
                }else
                //sms_verified
                if(
                    $userObjs[0]->sms_verified == 'no' ||
                    ($userObjs[0]->amount_made == 0 || $userObjs[0]->amount_made == null) ){
                    $requestJson->id = $userObjs[0]->id;
                    $requestJson->md5 = $userObjs[0]->md5;

                    $optSMS = getOTP();
                    $message = "Thank you for registring with ExamHans.com,\nyou Mobile OTP is\n" . $optSMS;
                    sendSMS($requestJson->mobile, $message);

                    $opt = getOTP();
                    //var_dump($optSMS,$opt);die();
                    $subject = "Activate you ExamHans Account by OTP " . $opt;
                    $message = "Thank you for registring with ExamHans.com,\nyou Email OTP is\n <h1>" . $opt . "</h1>";
                    /*sendMail($requestJson->email, $subject, $message);*/

                    $stmt = $db->prepare($updateOTP);
                    $stmt->bindParam("sms_otp", $optSMS);
                    $stmt->bindParam("email_otp", $opt);
                    $stmt->bindParam("id", $requestJson->id);
                    $stmt->execute();



                    echo '{"results": ' . json_encode($requestJson) . '}';

                }



            }else {

                //var_dump($requestJson);die();
                $stmt = $db->prepare($getUserId);

                $stmt->bindParam("mobile", $requestJson->ref_username);

                $stmt->execute();
                $refIdArr = $stmt->fetchAll(PDO::FETCH_OBJ);


                if (isset($requestJson->ref_username) && count($refIdArr) == 0) {
                    ///echo '{"error":{"text":"Referring User Don\'t exists "}}';
                    //die();
                    $refUserID = 0;

                } else
                    $refUserID = $refIdArr[0]->id;
                //var_dump($response1);die();

                $requestJson->md5 = md5($requestJson->reg_username);


                $stmt = $db->prepare($sql);

                $stmt->bindParam("username", $requestJson->reg_username);
                $stmt->bindParam("email", $requestJson->email);
                $stmt->bindParam("mobile", $requestJson->mobile);
                $stmt->bindParam("ref_user_id", $refUserID);
                $stmt->bindParam("password", $requestJson->reg_password);
                $stmt->bindParam("md5", $requestJson->md5);
                $stmt->bindParam("exam_id", $requestJson->exam_id);

                $stmt->execute();


                $requestJson->id = $db->lastInsertId();
                if ($requestJson->id) {
                    $optSMS = getOTP();
                    $message = "Thank you for registring with ExamHans.com,\nyou Mobile OTP is\n" . $optSMS;
                    sendSMS($requestJson->mobile, $message);

                    $opt = getOTP();
                    //var_dump($optSMS,$opt);die();
                    $subject = "Activate you ExamHans Account by OTP " . $opt;
                    $message = "Thank you for registring with ExamHans.com,\nyou Email OTP is\n <h1>" . $opt . "</h1>";
                    /*sendMail($requestJson->email, $subject, $message);*/

                    $stmt = $db->prepare($updateOTP);
                    $stmt->bindParam("sms_otp", $optSMS);
                    $stmt->bindParam("email_otp", $opt);
                    $stmt->bindParam("id", $requestJson->id);
                    $stmt->execute();


                }
                echo '{"results": ' . json_encode($requestJson) . '}';
            }
            $db = null;




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