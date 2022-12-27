<?php
	class Email_temp{
		private $CI;
		
		public function __construct(){
			$this->CI = & get_instance();
		}
			
		// OTP Email
		public function otp_template($name='', $email_val='', $randomOtp=''){
	
			$subject   = 'One Time Password (OTP)';

			$html_view = '
				<!DOCTYPE html>
				<html xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office" lang="en">
				    <head>
				        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
				        <meta charset="utf-8">
				        <meta name="x-apple-disable-message-reformatting">
				        <meta http-equiv="x-ua-compatible" content="ie=edge">
				        <meta name="viewport" content="width=device-width, initial-scale=1">
				        <meta name="format-detection" content="telephone=no, date=no, address=no, email=no">
				        <title>Verify Email Address</title>
				        <link href="Verify%20Email%20Address_files/css.css" rel="stylesheet" media="screen">
				        <style>
				            .hover-underline:hover {
				            text-decoration: underline !important;
				            }
				            @keyframes spin {
				            to {
				            transform: rotate(360deg);
				            }
				            }
				            @keyframes ping {
				            75%,
				            100% {
				            transform: scale(2);
				            opacity: 0;
				            }
				            }
				            @keyframes pulse {
				            50% {
				            opacity: .5;
				            }
				            }
				            @keyframes bounce {
				            0%,
				            100% {
				            transform: translateY(-25%);
				            animation-timing-function: cubic-bezier(0.8, 0, 1, 1);
				            }
				            50% {
				            transform: none;
				            animation-timing-function: cubic-bezier(0, 0, 0.2, 1);
				            }
				            }
				            @media (max-width: 600px) {
				            .sm-leading-32 {
				            line-height: 32px !important;
				            }
				            .sm-px-24 {
				            padding-left: 24px !important;
				            padding-right: 24px !important;
				            }
				            .sm-py-32 {
				            padding-top: 32px !important;
				            padding-bottom: 32px !important;
				            }
				            .sm-w-full {
				            width: 100% !important;
				            }
				            }
				        </style>
				    </head>
				    <body style="margin: 0; padding: 0; width: 100%; word-break: break-word; -webkit-font-smoothing: antialiased; --bg-opacity: 1; background-color: #eceff1; background-color: rgba(236, 239, 241, var(--bg-opacity));" data-new-gr-c-s-check-loaded="8.901.0" data-gr-ext-installed="">
				        <div style="display: none;">Please verify your email address</div>
				        <div role="article" aria-roledescription="email" aria-label="Verify Email Address" lang="en">
				            <table style="font-family: Montserrat, -apple-system, \'Segoe UI\', sans-serif; width: 100%;" role="presentation" width="100%" cellspacing="0" cellpadding="0">
				                <tbody>
				                    <tr>
				                        <td style="--bg-opacity: 1; background-color: #eceff1; background-color: rgba(236, 239, 241, var(--bg-opacity)); font-family: Montserrat, -apple-system, \'Segoe UI\', sans-serif;" bgcolor="rgba(236, 239, 241, var(--bg-opacity))" align="center">
				                            <table class="sm-w-full" style="font-family: \'Montserrat\',Arial,sans-serif; width: 600px;" role="presentation" width="600" cellspacing="0" cellpadding="0">
				                                <tbody>
				                                    <tr>
				                                        <td class="sm-py-32 sm-px-24" style="font-family: Montserrat, -apple-system, \'Segoe UI\', sans-serif; padding: 48px; text-align: center;" align="center">
				                                            <a href="'.SITE_LINK.'">
				                                            <img src="'.BASE_LOGO.'" alt="'.SITE_NAME.'" style="border: 0; max-width: 100%; line-height: 100%; vertical-align: middle;" width="155">
				                                            </a>
				                                        </td>
				                                    </tr>
				                                    <tr>
				                                        <td class="sm-px-24" style="font-family: \'Montserrat\',Arial,sans-serif;" align="center">
				                                            <table style="font-family: \'Montserrat\',Arial,sans-serif; width: 100%;" role="presentation" width="100%" cellspacing="0" cellpadding="0">
				                                                <tbody>
				                                                    <tr>
				                                                        <td class="sm-px-24" style="--bg-opacity: 1; background-color: #ffffff; background-color: rgba(255, 255, 255, var(--bg-opacity)); border-radius: 4px; font-family: Montserrat, -apple-system, \'Segoe UI\', sans-serif; font-size: 14px; line-height: 24px; padding: 48px; text-align: left; --text-opacity: 1; color: #626262; color: rgba(98, 98, 98, var(--text-opacity));" bgcolor="rgba(255, 255, 255, var(--bg-opacity))" align="left">
				                                                            <p style="font-weight: 700; font-size: 20px; margin-top: 0; --text-opacity: 1; color: #ff5850; color: rgba(255, 88, 80, var(--text-opacity));"><span style="font-weight: 600; font-size: 18px; margin-bottom: 0; color: #626262;">Hey</span> '.$name.'! 👋</p>

				                                                            <p class="sm-leading-32" style="font-weight: 600; font-size: 30px; margin: 0 0 16px; --text-opacity: 1; color: #263238; color: rgba(38, 50, 56, var(--text-opacity)); text-align: center;">'.$randomOtp.'
				                                                            </p>

				                                                            <p style="margin: 0 0 24px; text-align: center;">
				                                                                Here is your OTP Verification Code. It will expire in 6 minutes.
				                                                            </p>
				                                                            <p style="margin: 0 0 16px;">Thanks, <br>'.SITE_NAME.' Team</p>
				                                                        </td>
				                                                    </tr>
				                                                    <tr>
				                                                        <td style="font-family: \'Montserrat\',Arial,sans-serif; height: 20px;" height="20"></td>
				                                                    </tr>
				                                                    <tr>
				                                                        <td style="font-family: Montserrat, -apple-system, \'Segoe UI\', sans-serif; font-size: 12px; padding-left: 48px; padding-right: 48px; --text-opacity: 1; color: #eceff1; color: rgba(236, 239, 241, var(--text-opacity));">
				                                                            <p style="cursor: default; margin-bottom: 16px;" align="center">
				                                                                <a href="'.FACEBOOK_LINK.'" style="--text-opacity: 1; color: #263238; color: rgba(38, 50, 56, var(--text-opacity)); text-decoration: none;"><img src="'.IMG_URL.'icon/facebook.png" alt="Facebook" style="border: 0; max-width: 100%; line-height: 100%; vertical-align: middle; margin-right: 12px;" width="17"></a>
				                                                                <a href="'.TWITTER_LINK.'" style="--text-opacity: 1; color: #263238; color: rgba(38, 50, 56, var(--text-opacity)); text-decoration: none;"><img src="'.IMG_URL.'icon/twitter.png" alt="Twitter" style="border: 0; max-width: 100%; line-height: 100%; vertical-align: middle; margin-right: 12px;" width="17"></a>
				                                                                •
				                                                                <a href="'.INSTAGRAN_LINK.'" style="--text-opacity: 1; color: #263238; color: rgba(38, 50, 56, var(--text-opacity)); text-decoration: none;"><img src="'.IMG_URL.'icon/instagram.png" alt="Instagram" style="border: 0; max-width: 100%; line-height: 100%; vertical-align: middle; margin-right: 12px;" width="17"></a>
				                                                            </p>
				                                                            <p style="--text-opacity: 1; color: #263238; color: rgba(38, 50, 56, var(--text-opacity));">
				                                                                Use of our service and website is subject to our
				                                                                <a href="'.TERMS.'" class="hover-underline" style="--text-opacity: 1; color: #7367f0; color: rgba(115, 103, 240, var(--text-opacity)); text-decoration: none;">Terms of Use</a> and
				                                                                <a href="'.POLICY.'" class="hover-underline" style="--text-opacity: 1; color: #7367f0; color: rgba(115, 103, 240, var(--text-opacity)); text-decoration: none;">Privacy Policy</a>.
				                                                            </p>
				                                                        </td>
				                                                    </tr>
				                                                    <tr>
				                                                        <td style="font-family: \'Montserrat\',Arial,sans-serif; height: 16px;" height="16"></td>
				                                                    </tr>
				                                                </tbody>
				                                            </table>
				                                        </td>
				                                    </tr>
				                                </tbody>
				                            </table>
				                        </td>
				                    </tr>
				                </tbody>
				            </table>
				        </div>
				    </body>
				</html>
			';

			$data_1 = array(
                'to'       => $email_val,
                'subject'  => $subject,
                'sitename' => SITE_NAME,
                'site'     => SITE_LINK,
                'message'  => $html_view,
            );

            $sendMail = avul_sendmail($data_1);
		}
	}
?>