<?php

namespace Flyn\MAILSMTP;

use WP_CLI;
use WP_Error;

/**
 * Allows for testing the SMTP connection.
 */
class CLI
{

    /**
     * Email post authors a reminder to take their old CCTV images down.
     *
     * ## OPTIONS
     *
     * [--to=<email_address>]
     * : Test email recipient. Default is DEBUG_EMAILS
     * ---
     *
     * ## EXAMPLES
     *
     *     wp qps-mail-smtp test --to=flynsarmy@gmail.com
     *
     * @when after_wp_load
     */
    public function test($args, $assoc_args)
    {
        /**
         * Fires after a PHPMailer\PHPMailer\Exception is caught.
         *
         * @since 4.4.0
         *
         * @param WP_Error $error A WP_Error object with the PHPMailer\PHPMailer\Exception message, and an array
         *                        containing the mail recipient, subject, message, headers, and attachments.
         */
        add_action('wp_mail_failed', function (WP_Error $error) {
            WP_CLI::error(implode("\n", $error->get_error_messages()));
        });

        $to = isset($assoc_args['to']) ? $assoc_args['to'] : get_bloginfo('admin_email');

        add_filter('wp_mail_content_type', function () {
            return 'text/html';
        });

        $success = wp_mail(
            $to,
            "Just a test",
            "<p>This is a <strong>Test</strong> email. Please do not reply to it.</p>" .
            "<p>This email was created at <em>" . date('r') . "</em>." .
            "<p>Cheers,<br/>Flyn Mail SMTP</p>"
        );

        if ($success) {
            WP_CLI::success("Email sent successfully.");
        } else {
            WP_CLI::error("Email did not send successfully.");
        }
    }
}
