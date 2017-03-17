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
$app->post('/user/:userMd5/demo_test', 'startDemoTest');

//next question
$app->get('/user/:userMd5/test/:testId/goto/:questionNo', 'getTestQuestionNo');
$app->post('/user/:userMd5/test/:testId/question/:responseId', 'saveTestQuestionAnswer');

$app->get('/user/:userMd5/verify/:type/otp/:otp', 'checkOtp');

//result
$app->get('/user/:userMd5/test/:testId/result', 'getTestResult');

$app->post('/user/:userMd5/bank_account', 'addBankAccount');

$app->post('/auth', 'userAuth');
$app->post('/auth', 'userAuth');
$app->post('/user', 'regUser');

$app->get('/users', 'getAllUsers');

$app->post('/question', 'insertQuestion');

//exams
$app->get('/exams', 'getExamList');

//topic
$app->get('/topics/:topicId/videos', 'getTopicVideo');

$app->post('/topics/:topicId/videos', 'insertTopicVideo');

/* Ending Routes */

$app->run();