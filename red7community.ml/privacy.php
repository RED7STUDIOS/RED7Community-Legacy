<?php
/*
  File Name: privacy.php
  Original Location: /privacy.php
  Description: The privacy policy stuff.
  Author: Mitchell (BlxckSky_959)
  Copyright (C) RED7 STUDIOS 2021
*/

include_once $_SERVER["DOCUMENT_ROOT"] . "/assets/common.php";

// Initialize the session
if (!isset($_SESSION)) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Privacy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <link rel="stylesheet" href="/assets/css/style.css">
    <link href="/assets/css/paper-kit.css?v=2.2.0" rel="stylesheet"/>

    <script src="/assets/js/fontawesome.js"></script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body onload="init();">
<?php include_once $_SERVER["DOCUMENT_ROOT"] . "/account/navbar.php" ?>
<div class="page-content-wrapper">
    <script>
        var observe;
        if (window.attachEvent) {
            observe = function (element, event, handler) {
                element.attachEvent('on' + event, handler);
            };
        } else {
            observe = function (element, event, handler) {
                element.addEventListener(event, handler, false);
            };
        }

        function init() {
            var text = document.getElementById('text');

            function resize() {
                text.style.height = 'auto';
                text.style.height = text.scrollHeight + 'px';
            }

            /* 0-timeout to get the already changed text */
            function delayedResize() {
                window.setTimeout(resize, 0);
            }

            observe(text, 'change', resize);
            observe(text, 'cut', delayedResize);
            observe(text, 'paste', delayedResize);
            observe(text, 'drop', delayedResize);
            observe(text, 'keydown', delayedResize);

            text.focus();
            text.select();
            resize();
        }
    </script>

    <?php
    if (isset($your_isBanned)) {
        if ($your_isBanned == 1) {
            echo "<script type='text/javascript'>location.href = '/errors/banned.php';</script>";
        }
    }

    if (isset($maintenanceMode)) {
        if ($maintenanceMode == "on") {
            echo "<script type='text/javascript'>location.href = '/errors/maintenance.php';</script>";
        }
    }
    ?>
    <main class="col-md-9">
        <h1>Privacy Policy for RED7Community</h1>

        <p>At RED7Community, accessible from red7community.ml, one of our main priorities is the privacy of our
            visitors. This Privacy Policy document contains types of information that is collected and recorded by
            RED7Community and how we use it.</p>

        <p>If you have additional questions or require more information about our Privacy Policy, do not hesitate to
            contact us.</p>

        <h2>Log Files</h2>

        <p>RED7Community follows a standard procedure of using log files. These files log visitors when they visit
            websites. All hosting companies do this and a part of hosting services' analytics. The information collected
            by log files include internet protocol (IP) addresses, browser type, Internet Service Provider (ISP), date
            and time stamp, referring/exit pages, and possibly the number of clicks. These are not linked to any
            information that is personally identifiable. The purpose of the information is for analyzing trends,
            administering the site, tracking users' movement on the website, and gathering demographic information.</p>

        <h2>Cookies and Web Beacons</h2>

        <p>Like any other website, RED7Community uses 'cookies'. These cookies are used to store information including
            visitors' preferences, and the pages on the website that the visitor accessed or visited. The information is
            used to optimize the users' experience by customizing our web page content based on visitors' browser type
            and/or other information.</p>

        <p>For more general information on cookies, please read <a
                    href="https://www.privacypolicyonline.com/what-are-cookies/">"What Are Cookies"</a>.</p>


        <h2>Privacy Policies</h2>

        <P>You may consult this list to find the Privacy Policy for each of the advertising partners of
            RED7Community.</p>

        <p>Third-party ad servers or ad networks uses technologies like cookies, JavaScript, or Web Beacons that are
            used in their respective advertisements and links that appear on RED7Community, which are sent directly to
            users' browser. They automatically receive your IP address when this occurs. These technologies are used to
            measure the effectiveness of their advertising campaigns and/or to personalize the advertising content that
            you see on websites that you visit.</p>

        <p>Note that RED7Community has no access to or control over these cookies that are used by third-party
            advertisers.</p>

        <h2>Third Party Privacy Policies</h2>

        <p>RED7Community's Privacy Policy does not apply to other advertisers or websites. Thus, we are advising you to
            consult the respective Privacy Policies of these third-party ad servers for more detailed information. It
            may include their practices and instructions about how to opt-out of certain options. </p>

        <p>You can choose to disable cookies through your individual browser options. To know more detailed information
            about cookie management with specific web browsers, it can be found at the browsers' respective
            websites.</p>

        <h2>Children's Information</h2>

        <p>Another part of our priority is adding protection for children while using the internet. We encourage parents
            and guardians to observe, participate in, and/or monitor and guide their online activity.</p>

        <p>RED7Community does not knowingly collect any Personal Identifiable Information from children under the age of
            13. If you think that your child provided this kind of information on our website, we strongly encourage you
            to contact us immediately and we will do our best efforts to promptly remove such information from our
            records.</p>

        <h2>Online Privacy Policy Only</h2>

        <p>This Privacy Policy applies only to our online activities and is valid for visitors to our website with
            regards to the information that they shared and/or collect in RED7Community. This policy is not applicable
            to any information collected offline or via channels other than this website.</p>

        <h2>Consent</h2>

        <p>By using our website, you hereby consent to our <a href="/privacy.php">Privacy Policy</a> and agree to its <a
                    href="/terms-of-service.php">Terms Of Service</a>.</p>
    </main>
</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0"
        crossorigin="anonymous"></script>
<!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
<script src="./assets/js/plugins/bootstrap-switch.js"></script>
<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
<script src="./assets/js/plugins/nouislider.min.js" type="text/javascript"></script>
<!--  Plugin for the DatePicker, full documentation here: https://github.com/uxsolutions/bootstrap-datepicker -->
<script src="./assets/js/plugins/moment.min.js"></script>
<script src="./assets/js/plugins/bootstrap-datepicker.js" type="text/javascript"></script>
<!-- Control Center for Paper Kit: parallax effects, scripts for the example pages etc -->
<script src="./assets/js/paper-kit.js?v=2.2.0" type="text/javascript"></script>
</body>
</html>