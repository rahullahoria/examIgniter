<?php
/**
 * Created by PhpStorm.
 * User: spider-ninja
 * Date: 3/28/17
 * Time: 4:20 PM
 */

function sendSMSApi($mobile){
    $request = \Slim\Slim::getInstance()->request();
    $requestJson = json_decode($request->getBody());
    echo sendSMS($mobile, $requestJson->text);
}