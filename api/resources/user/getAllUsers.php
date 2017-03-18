<?php
/**
 * Created by PhpStorm.
 * User: spider-ninja
 * Date: 3/16/17
 * Time: 4:37 PM
 */

function getAllUsers(){
    $sql = "SELECT
                a.`id`, a.`username`, a.`mobile`, a.`ref_user_id`, a.`md5`, a.`creation`, a.`amount`, a.`exam_id`,
                    a.`sms_verified`, b.`account_holder_name`, b.`account_number`, b.`ifsc_code`, c.amount_made
                    FROM  `users` as a left join
                    bank_accounts as b on a.id = b.user_id left join
                    tests as c on a.id = c.user_id
                    WHERE 1 ORDER BY `users`.`creation` DESC limit 0,50 ";

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