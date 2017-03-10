<?php
/**
 * Created by PhpStorm.
 * User: spider-ninja
 * Date: 3/4/17
 * Time: 12:28 PM
 */

$t = $_GET['t'];
//exam_igniter

$dbHandle = mysqli_connect("localhost","root","redhat@11111p","exam_igniter");
$sql = "SELECT a.amount_made, b.username, c.name
          FROM `tests` as a
          inner join users as b
          inner join exams as c
          WHERE a.id=$t
          and a.user_id = b.id  and b.exam_id = c.id  ";
//echo $sql;
$tests = mysqli_query($dbHandle, $sql);
//var_dump(mysqli_error($dbHandle));
$test = mysqli_fetch_array($tests);
//var_dump($test);

$username = "Hi, I have";
$amount = $test['amount_made'];
$topicName = $test['name'];
mysqli_close($dbHandle);
?>

<html>
<head>
    <title><?= $username ?> earned <?= $amount ?> Rs on ExanHans.com by Solving <?= $topicName ?> Questions</title>
    <!-- You can use Open Graph tags to customize link previews.
    Learn more: https://developers.facebook.com/docs/sharing/webmasters -->

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

    <!-- Theme CSS -->
    <link href="css/agency.min.css" rel="stylesheet">

    <link rel="apple-touch-icon" sizes="57x57" href="img/favicons/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="img/favicons/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="img/favicons/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="img/favicons/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="img/favicons/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="img/favicons/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="img/favicons/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="img/favicons/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="img/favicons/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="img/favicons/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="img/favicons/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicons/favicon-16x16.png">
    <link rel="manifest" href="img/favicons/manifest.json">
    <meta name="msapplication-TileColor" content="#277ebd">
    <meta name="msapplication-TileImage" content="img/favicons/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">


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
    <meta property="og:image" content='http://examhans.com/img/logos/examhans_logo_1200x800.png' />

    <meta property="og:image:type" content="image/png" />

    <meta property="og:description" content="Its nice to get paid while learning, I am practicing online and get paid for that. This will increase my chance of getting selected" />

    <!-- for Twitter -->
    <!-- <meta name="twitter:card" content="n/a" /> -->
    <meta name="twitter:site" content="@hireblueteam">
    <meta name="twitter:creator" content="@hireblueteam">
    <meta name="twitter:url" content="http://examhans.com/story.php?t=<?= $t ?>" />
    <meta name="twitter:title" content="<?= $username ?> earned <?= $amount ?> Rs on ExanHans.com by Solving <?= $topicName ?> Questions" />
    <meta name="twitter:description" content="Its nice to get paid while learning, I am practicing online and get paid for that. This will increase my chance of getting selected" />
    <meta name="twitter:image" content="http://examhans.com/img/logos/examhans_logo_1200x800.png" />
    <style type="text/css">

        #share-buttons img {
            width: 35px;
            padding: 5px;
            border: 0;
            box-shadow: 0;
            display: inline;
        }

    </style>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js" integrity="sha384-0s5Pv64cNZJieYFkXYOTId2HMA2Lfb6q2nAcx2n0RTLUnCAoTTsS0nKEO27XyKcY" crossorigin="anonymous"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js" integrity="sha384-ZoaMbDF+4LeFxg6WdScQ9nnR1QC2MIRxA1O9KWEXQwns1G8UNyIEZIQidzb0T1fo" crossorigin="anonymous"></script>
    <![endif]-->


</head>
<body>

<body id="page-top" class="index">

<!-- Navigation -->
<nav id="mainNav" class="navbar navbar-default navbar-custom navbar-fixed-top">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header page-scroll">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
            </button>
            <img src="img/logos/examhans_logo.png" height="50px" />
            <a class="navbar-brand page-scroll" href="#page-top">ExamHans</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li class="hidden">
                    <a href="#page-top"></a>
                </li>
                <li>
                    <a class="page-scroll" href="#services">How?</a>
                </li>

                <li>
                    <a class="page-scroll" href="#plans">Plans</a>
                </li>
                <li>
                    <a class="page-scroll" href="blog/">Blog</a>
                </li>
                <li>
                    <a class="page-scroll" href="members/" target="_blank">Members</a>
                </li>
                <li>
                    <a class="page-scroll" href="https://rahul372.typeform.com/to/Wq52n6">Enquiry</a>
                </li>
                <li>
                    <a class="page-scroll" href="https://rahul372.typeform.com/to/Wq52n6">Survey</a>
                </li>
                <li>
                    <a class="page-scroll" href="members/" target="_blank">Login/Register</a>
                </li>
                <li>
                    <a class="page-scroll" href="#contact">Contact</a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>

<!-- Header -->
<header>
    <div class="container">
        <div class="intro-text" style="padding-top: 100px;">

            <div class="row">
                <div class="col-md-2">
                    <img src="img/logos/examhans_logo.png" style="max-width: 100%;"/>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-12" style="">
                    Hi,<br>
                    <h3>I (<?= $username ?>) have earned <?= $amount ?> Rs on ExanHans.com by Solving <?= $topicName ?> Questions</h3>
                    <h4>Its nice to get paid while learning, I am practicing online and get paid for that. This will increase my chance of getting selected</h4>
                    <br>
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


            </div>
            <br>
            <!--<div class="intro-lead-in">Welcome To ExamHans!</div>-->
            <!--<div class="intro-heading">It's Nice To Meet You </div>-->
            <div class="intro-lead-in">
                Get Selected in SSC/Bank PO by practicing special Questions<br><br>
                <b>Also Earn 5 Rs per correct answer</b><br><br>
                Start 30 question <a href="members/" class="page-scroll btn btn-xl" target="_blank">Demo Test</a> Now & Earn 150 Rs
            </div>

        </div>
    </div>
</header>



<!-- Contact Section -->
<section id="contact">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading">Contact Us</h2>
                <h3 class="section-subheading text-muted">We are ready to give you answers 24x7.</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <form name="sentMessage" id="contactForm" novalidate>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Your Name *" id="name" required data-validation-required-message="Please enter your name.">
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" placeholder="Your Email *" id="email" required data-validation-required-message="Please enter your email address.">
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="form-group">
                                <input type="tel" class="form-control" placeholder="Your Phone *" id="phone" required data-validation-required-message="Please enter your phone number.">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <textarea class="form-control" placeholder="Your Message *" id="message" required data-validation-required-message="Please enter a message."></textarea>
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-lg-12 text-center">
                            <div id="success"></div>
                            <button type="submit" class="btn btn-xl">Send Message</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <span class="copyright">Copyright &copy; Your Website 2015</span>
            </div>
            <div class="col-md-4">
                <ul class="list-inline social-buttons">
                    <li><a href="#"><i class="fa fa-twitter"></i></a>
                    </li>
                    <li><a href="https://www.facebook.com/Examhans-1449442445128231/"><i class="fa fa-facebook"></i></a>
                    </li>
                    <li><a href="#"><i class="fa fa-linkedin"></i></a>
                    </li>
                </ul>
            </div>
            <div class="col-md-4">
                <ul class="list-inline quicklinks">
                    <li><a href="#">Privacy Policy</a>
                    </li>
                    <li><a href="#">Terms of Use</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>

<!-- Portfolio Modals -->
<!-- Use the modals below to showcase details about your portfolio projects! -->


<?php /*
    <!-- Portfolio Modal 2 -->
    <div class="portfolio-modal modal fade" id="portfolioModal2" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close-modal" data-dismiss="modal">
                    <div class="lr">
                        <div class="rl">
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-lg-offset-2">
                            <div class="modal-body">
                                <h2>Project Heading</h2>
                                <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>
                                <img class="img-responsive img-centered" src="img/portfolio/startup-framework-preview.png" alt="">
                                <p><a href="http://designmodo.com/startup/?u=787">Startup Framework</a> is a website builder for professionals. Startup Framework contains components and complex blocks (PSD+HTML Bootstrap themes and templates) which can easily be integrated into almost any design. All of these components are made in the same style, and can easily be integrated into projects, allowing you to create hundreds of solutions for your future projects.</p>
                                <p>You can preview Startup Framework <a href="http://designmodo.com/startup/?u=787">here</a>.</p>
                                <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close Project</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Portfolio Modal 3 -->
    <div class="portfolio-modal modal fade" id="portfolioModal3" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close-modal" data-dismiss="modal">
                    <div class="lr">
                        <div class="rl">
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-lg-offset-2">
                            <div class="modal-body">
                                <!-- Project Details Go Here -->
                                <h2>Project Name</h2>
                                <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>
                                <img class="img-responsive img-centered" src="img/portfolio/treehouse-preview.png" alt="">
                                <p>Treehouse is a free PSD web template built by <a href="https://www.behance.net/MathavanJaya">Mathavan Jaya</a>. This is bright and spacious design perfect for people or startup companies looking to showcase their apps or other projects.</p>
                                <p>You can download the PSD template in this portfolio sample item at <a href="http://freebiesxpress.com/gallery/treehouse-free-psd-web-template/">FreebiesXpress.com</a>.</p>
                                <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close Project</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Portfolio Modal 4 -->
    <div class="portfolio-modal modal fade" id="portfolioModal4" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close-modal" data-dismiss="modal">
                    <div class="lr">
                        <div class="rl">
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-lg-offset-2">
                            <div class="modal-body">
                                <!-- Project Details Go Here -->
                                <h2>Project Name</h2>
                                <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>
                                <img class="img-responsive img-centered" src="img/portfolio/golden-preview.png" alt="">
                                <p>Start Bootstrap's Agency theme is based on Golden, a free PSD website template built by <a href="https://www.behance.net/MathavanJaya">Mathavan Jaya</a>. Golden is a modern and clean one page web template that was made exclusively for Best PSD Freebies. This template has a great portfolio, timeline, and meet your team sections that can be easily modified to fit your needs.</p>
                                <p>You can download the PSD template in this portfolio sample item at <a href="http://freebiesxpress.com/gallery/golden-free-one-page-web-template/">FreebiesXpress.com</a>.</p>
                                <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close Project</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Portfolio Modal 5 -->
    <div class="portfolio-modal modal fade" id="portfolioModal5" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close-modal" data-dismiss="modal">
                    <div class="lr">
                        <div class="rl">
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-lg-offset-2">
                            <div class="modal-body">
                                <!-- Project Details Go Here -->
                                <h2>Project Name</h2>
                                <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>
                                <img class="img-responsive img-centered" src="img/portfolio/escape-preview.png" alt="">
                                <p>Escape is a free PSD web template built by <a href="https://www.behance.net/MathavanJaya">Mathavan Jaya</a>. Escape is a one page web template that was designed with agencies in mind. This template is ideal for those looking for a simple one page solution to describe your business and offer your services.</p>
                                <p>You can download the PSD template in this portfolio sample item at <a href="http://freebiesxpress.com/gallery/escape-one-page-psd-web-template/">FreebiesXpress.com</a>.</p>
                                <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close Project</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Portfolio Modal 6 -->
    <div class="portfolio-modal modal fade" id="portfolioModal6" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close-modal" data-dismiss="modal">
                    <div class="lr">
                        <div class="rl">
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-lg-offset-2">
                            <div class="modal-body">
                                <!-- Project Details Go Here -->
                                <h2>Project Name</h2>
                                <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>
                                <img class="img-responsive img-centered" src="img/portfolio/dreams-preview.png" alt="">
                                <p>Dreams is a free PSD web template built by <a href="https://www.behance.net/MathavanJaya">Mathavan Jaya</a>. Dreams is a modern one page web template designed for almost any purpose. It’s a beautiful template that’s designed with the Bootstrap framework in mind.</p>
                                <p>You can download the PSD template in this portfolio sample item at <a href="http://freebiesxpress.com/gallery/dreams-free-one-page-web-template/">FreebiesXpress.com</a>.</p>
                                <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close Project</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
*/ ?>
<!-- jQuery -->
<script src="vendor/jquery/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>

<!-- Plugin JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js" integrity="sha384-mE6eXfrb8jxl0rzJDBRanYqgBxtJ6Unn4/1F7q4xRRyIw7Vdg9jP4ycT7x1iVsgb" crossorigin="anonymous"></script>

<!-- Contact Form JavaScript -->
<script src="js/jqBootstrapValidation.js"></script>
<script src="js/contact_me.js"></script>

<!-- Theme JavaScript -->
<script src="js/agency.min.js"></script>

<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-92692012-1', 'auto');
    ga('send', 'pageview');

</script>

<!--Start of Tawk.to Script-->
<script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/58aff7d56b2ec15bd9f002fe/default';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
    })();
</script>
<!--End of Tawk.to Script-->


</body>





</body>
</html>
