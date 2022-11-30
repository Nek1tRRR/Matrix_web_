<?php

class Mail
{
    protected $mail, $config;
    public function __construct()
    {
        $this -> config = include 'core/config/default.php';
        include 'libs/PHPMailer/class.phpmailer.php';
        include 'libs/PHPMailer/class.smtp.php';
        $this -> mail = new PHPMailer();
        $this -> mail -> SMTPAuth = true;
        $this -> mail -> Username = $this -> config['MAIL']['user'];
        $this -> mail -> Password = $this -> config['MAIL']['pass'];
        $this -> mail -> CharSet = "UTF-8";
        $this -> mail -> IsHTML(true );
        $this -> mail -> SetFrom( $this -> config['MAIL']['user'], $this -> config['MAIL']['name'] );
    }

    public function Send($address, $body, $subject)
    {
        $this -> mail -> AddAddress($address);
        $this -> mail -> MsgHTML($body);
        $this -> mail -> Subject = $subject;
        if ( $this -> mail -> Send() )
        {
            return true;
        }else{
            return false;
        }
    }
}