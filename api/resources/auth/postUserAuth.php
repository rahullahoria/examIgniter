<?php
/**
 * Created by PhpStorm.
 * User: spider-ninja
 * Date: 6/22/16
 * Time: 2:13 PM
 */


function userAuth(){

    $request = \Slim\Slim::getInstance()->request();

    $user = json_decode($request->getBody());


    $sql = "SELECT a.`username`, a.`md5`, b.name
                FROM users as a
                inner join exams as b
                 WHERE a.exam_id = b.id
                 and a.mobile =:mobile
                 and a.password=:password
                  and a.amount != 0;";


    try {
        $db = getDB();
        $stmt = $db->prepare($sql);

        $stmt->bindParam("mobile", $user->mobile);
        $stmt->bindParam("password", $user->password);

       // var_dump($user);die();

        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_OBJ);


        $db = null;

        if(count($users) == 1)
            echo '{"user": ' . json_encode($users[0]) . ',"auth": "true"}';
        else
            echo '{"auth": "false"}';


    } catch (PDOException $e) {
        //error_log($e->getMessage(), 3, '/var/tmp/php.log');
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}


