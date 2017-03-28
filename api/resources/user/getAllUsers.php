<?php
/**
 * Created by PhpStorm.
 * User: spider-ninja
 * Date: 3/16/17
 * Time: 4:37 PM
 */

function getAllUsers(){

    global $app;

    $type = $app->request()->get('type');

    switch($type){
        case 'nd':
            $con = "c.amount_made is null AND a.amount = 0";
            break;
        case 'd':
            $con = "c.amount_made is not null AND a.amount = 0";
            break;
        case 'p':
            $con = " a.amount != 0";
            break;
        default:
            $con = "c.amount_made is null AND a.amount = 0";
    }
    $sql = "SELECT
                a.`id`, a.`username`, a.`mobile`, a.`ref_user_id`, a.`md5`, a.`creation`, a.`amount`, a.`exam_id`,
                    a.`sms_verified`, b.`account_holder_name`, b.`account_number`, b.`ifsc_code`, c.amount_made, c.id as test_id
                    FROM  `users` as a left join
                    bank_accounts as b on a.id = b.user_id left join
                    tests as c on a.id = c.user_id
                    WHERE  ".$con;

    //not complete c.amount_made = null
    //compled c.amount_made != null
    //payed a.amount != 0

    try {

        $db = getDB();
        $stmt = $db->prepare($sql);

        $stmt->bindParam("topic_id", $topicId);

        $stmt->execute();
        $videos = $stmt->fetchAll(PDO::FETCH_OBJ);

        $db = null;

        echo '{"users": ' . json_encode($videos) . '}';



    } catch (Exception $e) {
        //error_log($e->getMessage(), 3, '/var/tmp/php.log');
        echo '{"error":{"text":"' . $e->getMessage() . '"}}';
    }
}