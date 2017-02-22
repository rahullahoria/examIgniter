<?php
/**
 * Created by PhpStorm.
 * User: spider-ninja
 * Date: 6/4/16
 * Time: 1:12 PM
 */

\Slim\Slim::registerAutoloader();

global $app;

if (!isset($app))
    $app = new \Slim\Slim();

$app->response->headers->set('Access-Control-Allow-Credentials', 'true');

$app->response->headers->set('Content-Type', 'application/json');

/* Starting routes */

//get user status
$app->get('/user/:userMd5/status', 'getUserStatus');

//Start Test
$app->post('/user/:userMd5/test/', 'startTopicTest');

//next question
$app->get('/user/:userMd5/test/:testId/goto/:questionNo', 'getTestQuestionNo');
$app->post('/user/:userMd5/test/:testId/question/:questionNo', 'saveTestQuestionAnswer');

//result
$app->get('/user/:userMd5/test/:testId/result', 'getTestResult');

$app->post('/auth', 'userAuth');

/* Ending Routes */

$app->run();