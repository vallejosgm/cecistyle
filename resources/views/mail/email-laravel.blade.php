<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Ceci\'Style Alteration</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style type="text/css">
        /**
           * Google webfonts. Recommended to include the .woff version for cross-client compatibility.
           */
        @media screen {
            @font-face {
                font-family: "Source Sans Pro";
                font-style: normal;
                font-weight: 400;
                src: local("Source Sans Pro Regular"), local("SourceSansPro-Regular"), url(https://fonts.gstatic.com/s/sourcesanspro/v10/ODelI1aHBYDBqgeIAH2zlBM0YzuT7MdOe03otPbuUS0.woff) format("woff");
            }

            @font-face {
                font-family: "Source Sans Pro";
                font-style: normal;
                font-weight: 700;
                src: local("Source Sans Pro Bold"), local("SourceSansPro-Bold"), url(https://fonts.gstatic.com/s/sourcesanspro/v10/toadOcfmlt9b38dHJxOBGFkQc6VGVFSmCnC_l7QZG60.woff) format("woff");
            }
        }

        /**
           * Avoid browser level font resizing.
           * 1. Windows Mobile
           * 2. iOS / OSX
           */
        body,
        table,
        td,
        a {
            -ms-text-size-adjust: 100%;
            /* 1 */
            -webkit-text-size-adjust: 100%;
            /* 2 */
        }

        /**
           * Remove extra space added to tables and cells in Outlook.
           */
        table,
        td {
            mso-table-rspace: 0pt;
            mso-table-lspace: 0pt;
        }

        /**
           * Better fluid images in Internet Explorer.
           */
        img {
            -ms-interpolation-mode: bicubic;
        }

        /**
           * Remove blue links for iOS devices.
           */
        a[x-apple-data-detectors] {
            font-family: inherit !important;
            font-size: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
            color: inherit !important;
            text-decoration: none !important;
        }

        /**
           * Fix centering issues in Android 4.4.
           */
        div[style*="margin: 16px 0;"] {
            margin: 0 !important;
        }

        body {
            width: 100% !important;
            height: 100% !important;
            padding: 0 !important;
            margin: 0 !important;
        }

        /**
           * Collapse table borders to avoid space between cells.
           */
        table {
            border-collapse: collapse !important;
        }

        a {
            color: #1a82e2;
        }

        img {
            height: auto;
            line-height: 100%;
            text-decoration: none;
            border: 0;
            outline: none;
        }
    </style>

</head>

<body style="background-color: #e9ecef;">

    <!-- start preheader -->
    <div class="preheader"
        style="display: none; max-width: 0; max-height: 0; overflow: hidden; font-size: 1px; line-height: 1px; color: #fff; opacity: 0;">
        A preheader is the short summary text that follows the subject line when an email is viewed in the inbox.
    </div>
    <!-- end preheader -->

    <!-- start body -->
    <table border="0" cellpadding="0" cellspacing="0" width="100%">

        <!-- start logo -->
        <tr>
            <td align="center" bgcolor="#e9ecef">
                <!--[if (gte mso 9)|(IE)]>
                <table align="center" border="0" cellpadding="0" cellspacing="0" width="600">
                <tr>
                <td align="center" valign="top" width="600">
                <![endif]-->
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                    <tr>
                        <td align="center" valign="top" style="padding: 5px; background-color: white;">
                            <a href="https://cecistyle.org" target="_blank"
                                style="display: inline-block; margin-top: 20px;">
                                <img src="https://cecistyle.org/img/logo.png" alt="Logo" border="0"
                                    width="48"
                                    style="display: block; width: 150px; max-width: 150px; min-width: 48px;">
                            </a>
                            <h1
                                style="margin: 0 auto; font-size: 28px; font-weight: 400; letter-spacing: -1px; line-height: 48px; color: black; text-align: center;">
                                Your appointment has been confirmed!</h1>
                        </td>
                    </tr>
                </table>
                <!--[if (gte mso 9)|(IE)]>
                </td>
                </tr>
                </table>
                <![endif]-->
            </td>
        </tr>
        <!-- end logo -->

        <!-- start copy block -->
        <tr>
            <td align="center" bgcolor="#e9ecef">
                <!--[if (gte mso 9)|(IE)]>
                <table align="center" border="0" cellpadding="0" cellspacing="0" width="600">
                <tr>
                <td align="center" valign="top" width="600">
                <![endif]-->
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">

                    <!-- start copy -->
                    <tr>
                        <td align="left" bgcolor="#ffffff" style="padding: 24px; font-size: 16px; line-height: 24px;">
                            @php
                                $dateCreated = date_create($_POST['dHidden']);
                                $dayApp = date_format($dateCreated, 'l, d M Y');
                                $messageEmail = '';
                                $messageEmail .= '<p style="margin: 0;">' . $_POST['fullname'] . ', here are the details of your appointment with Ceci\'Style:<br><br>';
                                $messageEmail .= '<ul>';
                                $messageEmail .= '<li>Day: ' . $dayApp . '</li>';
                                $messageEmail .= '<li>Time: ' . $_POST['hHidden'] . '</li>';
                                $messageEmail .= '<li>Service: ' . $_POST['nsHidden'] . '</li>';
                                $messageEmail .= '<li>Our Address: ';
                                $messageEmail .= '<a href="https://goo.gl/maps/9kVjUsFKFMBaMLvt6" target="_blank" rel="noopener noreferrer" style="color: black;">';
                                $messageEmail .= '1347 East 4065 South Millcreeck, Salt Lake City Utah 84124';
                                $messageEmail .= '</a>';
                                $messageEmail .= '</li>';
                                $messageEmail .= '</ul></p><br>';
                                $messageEmail .= '<p>If you need to bring your shoes for this appointment, do not forget these. <br>Any questions, reschedule or cancel ';
                                $messageEmail .= 'this appointment for any reason, please contact us by calling or texting at <span style="font-weight: 800;">3852262473</span> and we will be happy to help you.  Thanks.</p>';
                                echo $messageEmail;
                            @endphp

                        </td>
                    </tr>
                    <!-- end copy -->

                    <!-- start copy -->
                    <tr>
                        <td align="left" bgcolor="#ffffff"
                            style="padding: 24px; font-size: 16px; line-height: 24px; border-bottom: 3px solid #d4dadf">
                            <p style="margin: 0;">Best,<br> <br>Ceci</p>
                        </td>
                    </tr>
                    <!-- end copy -->

                    <!-- start copy -->
                    <tr>
                        <td align="center" bgcolor="#ffffff"
                            style="padding: 10px; font-size: 16px; line-height: 24px; border-bottom: 3px solid #d4dadf; text-decoration: none; color: #dd1073;">
                            <a href="https://www.facebook.com/cecistyleutah" target="_blank" class="fa fa-facebook"
                                style="text-decoration: none; color: #dd1073; margin-right: 10px;"><img
                                    src="https://cecistyle.org/img/fa.png" style="width: 30px;"></a>
                            <a href="https://www.instagram.com/cecistyleutah" target="_blank" class="fa fa-instagram"
                                style="text-decoration: none; color: #dd1073; margin-left: 10px;"><img
                                    src="https://cecistyle.org/img/insta.png" style="width: 30px;"></a>
                        </td>
                    </tr>
                    <!-- end copy -->

                </table>
                <!--[if (gte mso 9)|(IE)]>
                </td>
                </tr>
                </table>
                <![endif]-->
            </td>
        </tr>
        <!-- end copy block -->

        <!-- start footer -->
        <tr>
            <td align="center" bgcolor="#e9ecef" style="padding: 24px;">
                <!--[if (gte mso 9)|(IE)]>
                <table align="center" border="0" cellpadding="0" cellspacing="0" width="600">
                <tr>
                <td align="center" valign="top" width="600">
                <![endif]-->
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">

                    <!-- start permission -->
                    <tr>
                        <td align="center" bgcolor="#e9ecef"
                            style="padding: 12px 24px; font-size: 14px; line-height: 20px; color: #666;">
                            <p style="margin: 0;">You received this email because we received an appointment request
                                using your email. If you did not request this appointment, you can safely delete this
                                email.</p>


                        </td>
                    </tr>
                    <!-- end permission -->

                </table>
                <!--[if (gte mso 9)|(IE)]>
                </td>
                </tr>
                </table>
                <![endif]-->
            </td>
        </tr>
        <!-- end footer -->

    </table>
    <!-- end body -->

</body>

</html>
