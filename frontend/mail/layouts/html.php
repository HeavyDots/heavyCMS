<?php
use yii\helpers\Html;

/* @var $this \yii\web\View view component instance */
/* @var $message \yii\mail\MessageInterface the message being composed */
/* @var $content string main view render result */

// Open Source email template: https://www.sendwithus.com/resources/templates/go
?>
<?php $this->beginPage() ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; <?= Yii::$app->charset ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <!-- Designed by https://github.com/kaytcat -->
    <!-- Header image designed by Freepik.com -->

    <style type="text/css">
    /* Take care of image borders and formatting */

    img { max-width: 600px; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic;}
    a img { border: none; }
    table { border-collapse: collapse !important; }
    #outlook a { padding:0; }
    .ReadMsgBody { width: 100%; }
    .ExternalClass {width:100%;}
    .backgroundTable {margin:0 auto; padding:0; width:100%;!important;}
    table td {border-collapse: collapse;}
    .ExternalClass * {line-height: 115%;}


    /* General styling */

    td {
      font-family: Arial, sans-serif;
      color: #5e5e5e;
      font-size: 16px;
      text-align: left;
    }

    body {
      -webkit-font-smoothing:antialiased;
      -webkit-text-size-adjust:none;
      width: 100%;
      height: 100%;
      color: #5e5e5e;
      font-weight: 400;
      font-size: 16px;
    }


    h1 {
      margin: 10px 0;
    }

    a {
      color: #2b934f;
      text-decoration: none;
    }


    .body-padding {
      padding: 0 75px;
    }


    .force-full-width {
      width: 100% !important;
    }

    .icons {
      text-align: right;
      padding-right: 30px;
    }

    .logo {
      text-align: left;
      padding-left: 30px;
    }

    .computer-image {
      padding-left: 30px;
    }

    .header-text {
      text-align: left;
      padding-right: 30px;
      padding-left: 20px;
    }

    .header {
      color: #232925;
      font-size: 24px;
    }



    </style>

    <style type="text/css" media="screen">
        @media screen {
          /*@import url(http://fonts.googleapis.com/css?family=PT+Sans:400,700);*/
          <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=PT+Sans:400,700">
          /* Thanks Outlook 2013! http://goo.gl/XLxpyl */
          * {
            font-family: 'PT Sans', 'Helvetica Neue', 'Arial', 'sans-serif' !important;
          }
        }
    </style>

    <style type="text/css" media="only screen and (max-width: 599px)">
      /* Mobile styles */
      @media only screen and (max-width: 599px) {

        table[class*="w320"] {
          width: 320px !important;
        }

        td[class*="icons"] {
          display: block !important;
          text-align: center !important;
          padding: 0 !important;
        }

        td[class*="logo"] {
          display: block !important;
          text-align: center !important;
          padding: 0 !important;
        }

        td[class*="computer-image"] {
          display: block !important;
          width: 230px !important;
          padding: 0 45px !important;
          border-bottom: 1px solid #e3e3e3 !important;
        }


        td[class*="header-text"] {
          display: block !important;
          text-align: center !important;
          padding: 0 25px!important;
          padding-bottom: 25px !important;
        }

        *[class*="mobile-hide"] {
          display: none !important;
          width: 0 !important;
          height: 0 !important;
          line-height: 0 !important;
          font-size: 0 !important;
        }


      }
    </style>
  </head>
  <body offset="0" class="body" style="padding:0; margin:0; display:block; background:#ffffff; -webkit-text-size-adjust:none" bgcolor="#ffffff">
    <?php $this->beginBody() ?>
    <?= $content ?>
    <?php $this->endBody() ?>
  </body>
</html>
<?php $this->endPage() ?>