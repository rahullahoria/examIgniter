<?php
/**
 * Created by PhpStorm.
 * User: spider-ninja
 * Date: 3/6/17
 * Time: 1:36 PM
 */

function addBankAccount($userMd5){

    $request = \Slim\Slim::getInstance()->request();

    $account = json_decode($request->getBody());




    $sqlGettingUserId = "Select id,username from users where md5 = :user_md5";

    $sqlCreateTest = "INSERT INTO `bank_accounts`(`user_id`, `account_holder_name`, `account_number`, `ifsc_code`)
                                VALUES (:user_id, :account_holder_name, :account_number, :ifsc_code)";

    try {

        $db = getDB();


        //getting userId
        $stmt = $db->prepare($sqlGettingUserId);
        $stmt->bindParam("user_md5", $userMd5);
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_OBJ);

        //creating test
        $stmt = $db->prepare($sqlCreateTest);


        $stmt->bindParam("user_id", $users[0]->id);
        $stmt->bindParam("account_holder_name", $account->account_holder_name);
        $stmt->bindParam("account_number", $account->account_number);
        $stmt->bindParam("ifsc_code", $account->ifsc_code);

        $message = "Dear Rajnish Sir,\nPlease make this Transaction\nname: "
                            .$account->account_holder_name
                            ."\na.no.: "
                            .$account->account_number."\nifsc: ".$account->ifsc_code."\n amount: ".$account->amount."\n\nusername: ".$users[0]->username;
        sendSMS('8901414422', $message);

        $stmt->execute();
        $account->id = $db->lastInsertId();


        $db = null;

        echo '{"response": ' . json_encode($account) . '}';

    } catch (Exception $e) {
        //error_log($e->getMessage(), 3, '/var/tmp/php.log');
        echo '{"error":{"text":"' . $e->getMessage() . '"}}';
    }

}