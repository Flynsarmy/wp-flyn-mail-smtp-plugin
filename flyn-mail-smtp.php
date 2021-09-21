<?php

/**
 * @package Flyn Mail SMTP
 * @version 0.0.1
 *
 * Plugin Name: Flyn Mail SMTP
 * Description: Reconfigures the wp_mail() function to use SMTP instead of the default mail.
 * Version: 0.0.1
 * Author: Flynsarmy
 * Author URI: https://www.flynsarmy.com/
 */

use PHPMailer\PHPMailer\PHPMailer;

add_action('phpmailer_init', function (PHPMailer $phpmailer) {
    $phpmailer->isSMTP();
    $phpmailer->Host = WPMS_SMTP_HOST;
    $phpmailer->SMTPAuth = WPMS_SMTP_AUTH;
    $phpmailer->Port = WPMS_SMTP_PORT;
    $phpmailer->Username = WPMS_SMTP_USER;
    $phpmailer->Password = WPMS_SMTP_PASS;
    $phpmailer->SMTPSecure = WPMS_SSL;
    $phpmailer->setFrom(WPMS_MAIL_FROM, WPMS_MAIL_FROM_NAME);
});

if (class_exists('WP_CLI')) {
    require_once __DIR__ . '/CLI.php';
    WP_CLI::add_command('flyn-mail-smtp', 'Flyn\MailSMTP\CLI');
}