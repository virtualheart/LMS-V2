<?php

namespace App\Controllers;
use App\Controllers\BaseController;

use App\Models\SettingsModel;
use App\Models\BarrowBooksModel;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mail
{
    public function __construct()
    {
        $this->settingsModel = new SettingsModel();
        $this->barrowBooksModel = new BarrowBooksModel();
    }

    public function sendmail($getmail,$sname,$subject,$body)
    {
        $session = session();

        // if ($session->get('role') != ("staff" or "admin" or "student")) {
        //    return ;
        // }

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
            
                $mail->IsSMTP();                                        
            //Sets Mailer to send message using SMTP
                $mail->Mailer = "smtp";
            //Sets the SMTP hosts of your Email hosting, this for Godaddy
                $mail->Host = $host;                                    
            //Sets the default SMTP server port 587 / 465
                $mail->Port = $port;                                    
            //Sets SMTP authentication. Utilizes the Username and Password variables
                $mail->SMTPAuth = true;                                 
            //Sets SMTP username
                $mail->Username = $user;                                
            //Sets SMTP password
                $mail->Password = $pass;                                
            //Sets connection prefix. Options are "", "ssl" or "tls"
                $mail->SMTPSecure = $sec_type;                          
            //Sets the From email address for the message
                $mail->From = $user;                                    
            //Sets the From name of the message
                $mail->FromName = $app_name;                            
            //Adds a "To" address
                $mail->AddAddress($getmail,$sname );                    
            //Adds a "Cc" address
            //  $mail->AddCC("name@mail.com");                       
            //Adds a "BCc" address
                $mail->AddBCC("computersearch4@gmail.com","Super Admin");        
            //Sets word wrapping on the body of the message to a given number of characters
                $mail->WordWrap = 50;                                   
            //Sets message type to HTML             
                $mail->IsHTML(true);                                    
            //Sets the Subject of the message
                $mail->Subject = $subject;                              
            //An HTML or plain text message body
            //  $mail->Body = $mgs;                      
            //Set SMTP Options    
                $mail->SMTPOptions = array(
                    'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                    )
                );
            
            //An HTML text message body
                $mail->MsgHTML($body);
            // help to easy to debug (0 - no output / 1 - warring + mgs / 2 - mgs )
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