<?php
/*
Plugin Name:        Register Mail
Plugin URI:         https://github.com/atamj/register_mail.git
Description:        Plugin qui permet d'envoyer un mail à l'admin à l'inscription d'un nouvel utilisateur
Version:            1.0.0
Author:             Jaël Atam
Author URI:         portfolio.jaelatam.com
*/

class register_mail
{
    public function __construct()
    {
        add_action('user_register',[$this,'register_mail']);
    }

    public function register_mail(){
        if (isset($_POST["email"])){
            $user_mail = $_POST["email"];
            $site_name = get_bloginfo('name');
            $to = get_option('admin_email');
            $subject = $_POST["register"];
            $message = "<p style='font-size: 18px'>Bonjour,</p>
                    <p style='font-size: 18px'>".$subject." d'un nouvel utilisateur sous l'adresse courriel : '".$user_mail."'.<br>
                    Vous pouvez maintenant le contacter pour le rajouter dans un groupe.</p>
                    <p style='font-size: 18px'>Cordialement,</p>";
            $headers = array('Content-Type: text/html; charset=UTF-8', "From: ".$site_name." < ne_pas_repondre@".str_ireplace("http://", "", get_bloginfo('url'))." >");
            wp_mail($to, $subject, $message, $headers);
        }

    }
}

new register_mail();
