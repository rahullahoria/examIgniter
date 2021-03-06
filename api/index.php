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

//exams
require_once "resources/exams/getExamList.php";
require_once "resources/exams/subjects/getExamSubjects.php";
require_once "resources/exams/subjects/topics/getExamSubjectTopics.php";

require_once "resources/auth/postUserAuth.php";
require_once "resources/user/getUserStatus.php";
require_once "resources/user/test/getTestQuestionNo.php";
require_once "resources/user/test/getTestResult.php";
require_once "resources/user/test/startDemoTest.php";

require_once "resources/user/regUser.php";
require_once "resources/channels/sendSMS.php";

require_once "resources/user/bankAccount/addBankAccount.php";

//check otp
require_once "resources/user/checkOtp.php";
require_once "resources/user/getAllUsers.php";
require_once "resources/user/test/saveTestQuestionAnswer.php";
require_once "resources/user/test/startTopicTest.php";
require_once "resources/questions/insertQuestion.php";

//topic
require_once "resources/topics/getTopicVideo.php";
require_once "resources/topics/insertTopicVideo.php";


//app
require_once "app.php";


?>