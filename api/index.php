<?php

require_once "header.php";

include 'db.php';
require 'Slim/Slim.php';

//sms lib
require_once "includes/sms.php";

//email lib
require_once "includes/error.php";

//Random string lib
require_once "includes/getRandonString.php";

require_once "resources/auth/postUserAuth.php";
require_once "resources/user/getUserStatus.php";
require_once "resources/user/test/getTestQuestionNo.php";
require_once "resources/user/test/getTestResult.php";
require_once "resources/user/regUser.php";
require_once "resources/user/checkOtp.php";
require_once "resources/user/test/saveTestQuestionAnswer.php";
require_once "resources/user/test/startTopicTest.php";
require_once "resources/questions/insertQuestion.php";

//topic
require_once "resources/topics/getTopicVideo.php";
require_once "resources/topics/insertTopicVideo.php";


//app
require_once "app.php";


?>