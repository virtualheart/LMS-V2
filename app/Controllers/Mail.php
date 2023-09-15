<?php

namespace App\Controllers;
use App\Controllers\BaseController;

use App\Models\SettingsModel;
use App\Models\BarrowBooksModel;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mail extends BaseController
{
    public function __construct()
    {
        $this->settingsModel = new SettingsModel();
        $this->barrowBooksModel = new BarrowBooksModel();
    }

    public function sendmail($getmail,$sname,$bcode,$subject,$body)
    {
        $session = session();

        if ($session->get('role') != ("staff" or "admin" or "student")) {
//            return redirect()->to('/');
        }

        $app_name = $this->settingsModel->getAppName();

        $data = [
            'detilesMail' => $this->settingsModel->getAppSmtp(),
        ];

        $host = $data['detilesMail']['smtp_host'];
        $port = $data['detilesMail']['smtp_port'];
        $user = $data['detilesMail']['smtp_user'];
        $pass = $data['detilesMail']['smtp_pass'];
        $sec_type = $data['detilesMail']['smtp_sec_type'];

       
        $mail = new PHPMailer(true);  
        try {
            
            $mail->IsSMTP();                                        //Sets Mailer to send message using SMTP
            $mail->Mailer = "smtp";
            $mail->Host = $host;                                    //Sets the SMTP hosts of your Email hosting, this for Godaddy
            $mail->Port = $port;                                    //Sets the default SMTP  server port 587 / 
            $mail->SMTPAuth = true;                                 //Sets SMTP authentication. Utilizes the Username and Password variables
            $mail->Username = $user;                                //Sets SMTP username
            $mail->Password = $pass;                                //Sets SMTP password
            $mail->SMTPSecure = $sec_type;                          //Sets connection prefix. Options are "", "ssl" or "tls"
            $mail->From = $user;                                    //Sets the From email address for the message
            $mail->FromName = $app_name;                            //Sets the From name of the message
            $mail->AddAddress($getmail,$sname );                    //Adds a "To" address
            //$mail->AddCC($_POST["email"], $_POST["name"]);        //Adds a "Cc" address
            $mail->WordWrap = 50;                                   //Sets word wrapping on the body of the message to a given number of characters
            $mail->IsHTML(true);                                    //Sets message type to HTML             
            $mail->Subject = $subject;                              //Sets the Subject of the message
            //$mail->Body = $_POST["message"];                      //An HTML or plain text message body
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );
            $mail->MsgHTML($body);
            
            // help to easy to debug (1 - warring + mgs / 2 - mgs )
            $mail->SMTPDebug = 0;        
            
            if(!$mail->send()) {
                return false;
                // echo "Something went wrong. Please try again.";
            }
            else {
                return true;
                // echo "Email sent successfully.";
            }
            
        } catch (Exception $e) {
            return false;
            // echo "Something went wrong. Please try again.";
        }
        
        
    }
}