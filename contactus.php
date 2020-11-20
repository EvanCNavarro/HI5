<?php
/**
 * This example shows how to handle a simple contact form.
 */

$msg = '';
//Don't run this unless we're handling a form submission
if (array_key_exists('email', $_POST)) {
    date_default_timezone_set('Etc/UTC');

    require 'phpmailer/PHPMailerAutoload.php';

    //Create a new PHPMailer instance
    $mail = new PHPMailer;
    //Tell PHPMailer to use SMTP - requires a local mail server
    //Faster and safer than using mail()
    //$mail->isSMTP();
    $mail->SMTPDebug = 2;
    $mail->Debugoutput = 'html';
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->SMTPSecure = 'tls';
    $mail->SMTPAuth = true;
    $mail->Username = "ronacards@gmail.com";
    $mail->Password = "COP4331_G6";

    //Use a fixed address in your own domain as the from address
    //**DO NOT** use the submitter's address here as it will be forgery
    //and will cause your messages to fail SPF checks
    $mail->setFrom('ronacards@gmail.com', 'Rona Cards');
    //Send the message to yourself, or whoever should receive contact for submissions
    $mail->addAddress('evancnavarro@gmail.com', 'Evan Navarro');
    //Put the submitter's address in a reply-to header
    //This will fail if the address provided is invalid,
    //in which case we should ignore the whole request
    if ($mail->addReplyTo($_POST['email'], $_POST['name'])) {
        $mail->Subject = 'LHI CONTACT FORM SUBMISSION SUCCESS';
        //Keep it simple - don't use HTML
        $mail->isHTML(false);
        //Build a simple message body
        $mail->Body = <<<EOT
Email: {$_POST['email']}
Name: {$_POST['name']}
Message: {$_POST['message']}
EOT;
        //Send the message, check for errors
        if (!$mail->send()) {
            //The reason for failing to send will be in $mail->ErrorInfo
            //but you shouldn't display errors to users - process the error, log it on your server.
            $msg = 'Sorry, something went wrong. Please try again later.';
        } else {
            $message = 'Message sent! Thanks for contacting us.';
            echo "<script type='text/javascript'>alert('$message');</script>";
        }
    } else {
        $msg = 'Invalid email address, message ignored.';
    }
}
?>

<!DOCTYPE html>

<html lang="en">

  <!--  START: head  -->
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--  Internet Search Information  -->
    <title> Contact Us | Mayflower Apartments • LHI</title>
    <meta name="description" content="LHI is a Property Management and Home Improvement family-run company, based out of Port St. Lucie. We maintain the beautiful Mayflower Apartments, now available to rent; Apply Online today!">
    <meta name="keywords" content="LHI, Mayflower, Apartments, Rental, Affordable, Port Saint Lucie, St., Letelier, Home, Improvements, Mayflower Apartments, Letelier Home Improvements, Application">

    <!--  Favicon  -->
    <link rel="icon" href="supporting/img/favicon.png">

    <!--  Google Fonts  -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Lato:400,300,700,900">

    <!--  Main CSS File  -->
    <link rel="stylesheet" href="supporting/css/style.css">

    <!--  Vendor CSS Files  -->
    <link rel="stylesheet" href="supporting/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="supporting/vendor/icofont/icofont.min.css">


  </head>
  <!--  END: head  -->

  <!--  START: body  -->
  <body>

    <!--  START: header -->
    <header id="header" class="fixed-top">

      <div class="container">

        <div class="logo float-left">
          <a href="#"><img src="supporting/img/LHI_Logo.png" alt="<Letelier Home Improvements>" class="img-fluid"></a>
        </div>

        <div class="underline">
          <nav class="nav-menu float-right d-none d-lg-block">
            <ul>
              <li class="home-button"><a class="cta-btn" href="index.html">Back to Main Site</a></li>
            </ul>
          </nav>
        </div>

      </div>

    </header>

    <main id="main" style="margin-top: 65px;">


<section id="contact" class="contact section-bg">
        <div class="container">

          <div class="section-title">
            <h2>Contact Us</h2>
            <hr>
          </div>


              <div class="connections" >
                <center>
                  <div class="bio" style="font-size: 20px; padding: 20px; max-width: 80%;">Thank you for interest in connecting with us!<br></div>
          <p style="margin-left: 2%; max-width: 80%; width: 500px; padding: 0px 20px 0px 20px; text-align: left;">We respond back to all serious inquiries, within one business day.<br><br>If you'd like to connect to us through a different method, here is our contact information:</p>

              <div class="connecting" style="margin-top: 25px; width: 444px; max-width: 73%; text-align: left">
                <h4><b>LHI's Contact Information:</b></h4>

                <div class="connect-icons" style="margin-bottom: 20px;">
                  <i class="icofont-envelope"></i>
                  contact@letelierhi.com
                </div>

                <div class="connect-icons" style="margin-bottom: 20px;">
                  <i class="icofont-phone"></i>
                  (561) 523-5209
                </div>

                <div class="connect-icons" style="margin-bottom: 38px;">
                  <i class="icofont-clock-time"></i>
                  MON - SAT <i class="fineprint" style="font-size: 13px;">from</i> 9:00AM - 5:00PM EST<p style="font-size: 13px; margin-left: 13%;"><i class="fineprint">• (We provide 24/7 availability for emergency maintenence.)</i></p>
                </div>

        </div>
          <hr>
                <h5 style="max-width: 80%; padding: 20px;"><b>Fill out the form to Send an Email:</b></h5>
                <?php
                  if (!empty($msg)) {
                    echo "<h2>$msg</h2>";
                  }
                ?>
                  <div class="contact-session">
                    <div class="contact-form">
                      <form class="contact" action="" method="post">
                        <input type="text" name="name" class="text-box" placeholder="Your Name" id="name" style="max-width: 85%; min-width: 60%; padding: 7px;" required>
                        <br><br>
                        <input type="email" name="email" class="text-box" placeholder="Your Email" id="email" style="max-width: 85%; min-width: 60%; padding: 7px;" required>
                        <br><br>
                        <textarea name="message" rows="5" placeholder="Your Message" id="message" style="max-width: 85%; min-width: 60%; padding: 7px;" required></textarea>
                        <br><br>
                        <input type="submit" name="submit" class="send-btn" value="Send" style="padding: 10px; min-width: 8%; font-weight: bolder; letter-spacing: 1px; background-color: lightgreen; border: 1px solid grey;">
                      </form>
                    </div>
                  </div>
              </center>
            </div>

        </div>
      </section>
    </main>
    <!--  END: main -->

    <!--  START: footer -->
    <footer id="footer">

      <div class="container">

        <div class="copyright">

          Copyright &copy; 2004 - 2020. All Rights Reserved.
          <p><strong><span><a href="http://search.sunbiz.org/Inquiry/CorporationSearch/SearchResultDetail?inquirytype=EntityName&directionType=Initial&searchNameOrder=LETELIERHOMEIMPROVEMENTS%20L040000365870&aggregateId=flal-l04000036587-2e0a8d05-6c26-4783-9688-7c564960375c&searchTerm=Letelier%2C%20LLC&listNameOrder=LETELIER%20L040000365890" target="_blank">Letelier Home Improvements, LLC</a></span></strong></p>

        </div>

      </div>

    </footer>
    <!--  END: footer -->

  </body>
  <!--  END: body -->

</html>