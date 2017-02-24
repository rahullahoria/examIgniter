<?php

require_once "header.php";

include 'db.php';
require 'Slim/Slim.php';

require_once "resources/auth/postUserAuth.php";
require_once "resources/user/getUserStatus.php";
require_once "resources/user/test/getTestQuestionNo.php";
require_once "resources/user/test/getTestResult.php";
require_once "resources/user/test/saveTestQuestionAnswer.php";
require_once "resources/user/test/startTopicTest.php";
require_once "resources/questions/insertQuestion.php";


//app
require_once "app.php";


?>