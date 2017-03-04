<?php
/**
 * Created by PhpStorm.
 * User: spider-ninja
 * Date: 3/4/17
 * Time: 12:28 PM
 */

$t = $_GET['t'];

$username = "Rahul.Lahoria";
$amount = "200";
$topicName = "Number Series";
?>

<html>
<head>
    <title><?= $username ?> earned <?= $amount ?> Rs on ExanHans.com by Solving <?= $topicName ?> Questions</title>
    <!-- You can use Open Graph tags to customize link previews.
    Learn more: https://developers.facebook.com/docs/sharing/webmasters -->
    <!-- for Google -->
    <meta name="description" content="Learn and Earn, Bank PO, SSC, SSC CGL, Solve Question and earn back money. Increase you chance to get selected." />
    <meta name="keywords" content="SSC, SSC CGL, Learn and Earn, competitive exams, Bank exam, bank po, bank clerk" />
    <meta name="author" content="ExamHans" />
    <meta name="copyright" content="true" />
    <meta name="application-name" content="website" />

    <!-- for Facebook -->
    <meta property="og:title" content="<?= $username ?> earned <?= $amount ?> Rs on ExanHans.com by Solving <?= $topicName ?> Questions" />
    <meta name="og:author" content="ExamHans" />
    <meta property="og:type" content="website"/>

    <meta name="p:domain_verify" content=""/>
    <meta property="og:image" content='http://examhans.com/img/logos/examhans_logo.png' />
    <meta property="og:url" content="http://examhans.com" />
    <meta property="og:image:type" content="image/png" />

    <meta property="og:description" content="Its nice to get paid while learning, I am practicing online and get paid for that. This will increase my chance of getting selected" />

    <!-- for Twitter -->
    <!-- <meta name="twitter:card" content="n/a" /> -->
    <meta name="twitter:site" content="@hireblueteam">
    <meta name="twitter:creator" content="@hireblueteam">
    <meta name="twitter:url" content="http://examhans.com/story.php?t=<?= $t ?>" />
    <meta name="twitter:title" content="<?= $username ?> earned <?= $amount ?> Rs on ExanHans.com by Solving <?= $topicName ?> Questions" />
    <meta name="twitter:description" content="Its nice to get paid while learning, I am practicing online and get paid for that. This will increase my chance of getting selected" />
    <meta name="twitter:image" content="http://examhans.com/img/logos/examhans_logo.png" />
    <style type="text/css">

        #share-buttons img {
            width: 35px;
            padding: 5px;
            border: 0;
            box-shadow: 0;
            display: inline;
        }

    </style>

</head>
<body>

<div style="text-align: center">
    hi,<br>
    <h3><?= $username ?> earned <?= $amount ?> Rs on ExanHans.com by Solving <?= $topicName ?> Questions</h3>
    <h4>Its nice to get paid while learning, I am practicing online and get paid for that. This will increase my chance of getting selected</h4>
        <br>
    <img src="http://examhans.com/img/logos/examhans_logo.png" style="max-width: 20%"/>
    <div class="intro-lead-in">Do you want to know more?</div>

    <h2><a href="http://examhans.com" class="page-scroll btn btn-xl">ExamHans.com</a></h2>
    <div id="fb-root"></div>
    <div id="share-buttons">

        <!-- Buffer -->
        <a href="https://bufferapp.com/add?url=http://examhans.com/story.php?t=<?= $t ?>&amp;text=<?= $username ?> earned <?= $amount ?> Rs on ExanHans.com by Solving <?= $topicName ?> Questions" target="_blank">
            <img src="https://simplesharebuttons.com/images/somacro/buffer.png" alt="Buffer" />
        </a>

        <!-- Digg -->
        <a href="http://www.digg.com/submit?url=http://examhans.com/story.php?t=<?= $t ?>" target="_blank">
            <img src="https://simplesharebuttons.com/images/somacro/diggit.png" alt="Digg" />
        </a>

        <!-- Email -->
        <a href="mailto:?Subject=I need to know more&amp;Body=I%20saw%20this%20and%20thought%20of%20you!%20 http://examhans.com/story.php?t=<?= $t ?>">
            <img src="https://simplesharebuttons.com/images/somacro/email.png" alt="Email" />
        </a>

        <!-- Facebook -->
        <a href="http://www.facebook.com/sharer.php?u=http://examhans.com/story.php?t=<?= $t ?>" target="_blank">
            <img src="https://simplesharebuttons.com/images/somacro/facebook.png" alt="Facebook" />
        </a>

        <!-- Google+ -->
        <a href="https://plus.google.com/share?url=http://examhans.com/story.php?t=<?= $t ?>" target="_blank">
            <img src="https://simplesharebuttons.com/images/somacro/google.png" alt="Google" />
        </a>

        <!-- LinkedIn -->
        <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=http://examhans.com/story.php?t=<?= $t ?>" target="_blank">
            <img src="https://simplesharebuttons.com/images/somacro/linkedin.png" alt="LinkedIn" />
        </a>

        <!-- Pinterest -->
        <a href="javascript:void((function()%7Bvar%20e=document.createElement('script');e.setAttribute('type','text/javascript');e.setAttribute('charset','UTF-8');e.setAttribute('src','http://assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);document.body.appendChild(e)%7D)());">
            <img src="https://simplesharebuttons.com/images/somacro/pinterest.png" alt="Pinterest" />
        </a>

        <!-- Print -->
        <a href="javascript:;" onclick="window.print()">
            <img src="https://simplesharebuttons.com/images/somacro/print.png" alt="Print" />
        </a>

        <!-- Reddit -->
        <a href="http://reddit.com/submit?url=http://examhans.com/story.php?t=<?= $t ?>&amp;title=<?= $username ?> earned <?= $amount ?> Rs on ExanHans.com by Solving <?= $topicName ?> Questions" target="_blank">
            <img src="https://simplesharebuttons.com/images/somacro/reddit.png" alt="Reddit" />
        </a>

        <!-- StumbleUpon-->
        <a href="http://www.stumbleupon.com/submit?url=http://examhans.com/story.php?t=<?= $t ?>&amp;title=<?= $username ?> earned <?= $amount ?> Rs on ExanHans.com by Solving <?= $topicName ?> Questions" target="_blank">
            <img src="https://simplesharebuttons.com/images/somacro/stumbleupon.png" alt="StumbleUpon" />
        </a>

        <!-- Tumblr-->
        <a href="http://www.tumblr.com/share/link?url=http://examhans.com/story.php?t=<?= $t ?>&amp;title=<?= $username ?> earned <?= $amount ?> Rs on ExanHans.com by Solving <?= $topicName ?> Questions" target="_blank">
            <img src="https://simplesharebuttons.com/images/somacro/tumblr.png" alt="Tumblr" />
        </a>

        <!-- Twitter -->
        <a href="https://twitter.com/share?url=http://examhans.com/story.php?t=<?= $t ?>&amp;text=<?= $username ?> earned <?= $amount ?> Rs on ExanHans.com by Solving <?= $topicName ?> Questions&amp;hashtags=examhans" target="_blank">
            <img src="https://simplesharebuttons.com/images/somacro/twitter.png" alt="Twitter" />
        </a>

        <!-- VK -->
        <a href="http://vkontakte.ru/share.php?url=http://examhans.com/story.php?t=<?= $t ?>" target="_blank">
            <img src="https://simplesharebuttons.com/images/somacro/vk.png" alt="VK" />
        </a>

        <!-- Yummly -->
        <a href="http://www.yummly.com/urb/verify?url=http://examhans.com/story.php?t=<?= $t ?>&amp;title=<?= $username ?> earned <?= $amount ?> Rs on ExanHans.com by Solving <?= $topicName ?> Questions" target="_blank">
            <img src="https://simplesharebuttons.com/images/somacro/yummly.png" alt="Yummly" />
        </a>

    </div>
</div>







</body>
</html>
