# Flyn Mail SMTP

Reconfigures the wp_mail() function to use SMTP instead of the default mail.

## Requirements

* [WP-CLI](https://wp-cli.org/) (Only for sending test emails)
* `WPMS_SMTP_HOST`, `WPMS_SMTP_AUTH`, `WPMS_SMTP_PORT`, `WPMS_SMTP_USER`, `WPMS_SMTP_PASS`, `WPMS_SSL`, `WPMS_MAIL_FROM`, `WPMS_MAIL_FROM_NAME` constants defined in *wp-config.php*

Example config:

```php
define('WPMS_ON', true);
define('WPMS_MAIL_FROM', 'no-reply@your-email.com');
define('WPMS_MAIL_FROM_NAME', 'no-reply');
define('WPMS_SSL', 'tls'); // Possible values '', 'ssl', 'tls' - note TLS is not STARTTLS
define('WPMS_SMTP_HOST', 'smtp.server.com'); // The SMTP mail host
define('WPMS_SMTP_PORT', WPMS_SSL == 'ssl' ? 465 : 587); // The SMTP server port number
define('WPMS_SMTP_AUTH', true); // True turns on SMTP authentication, false turns it off
define('WPMS_SMTP_USER', 'my-user'); // SMTP authentication username, only used if WPMS_SMTP_AUTH is true
define('WPMS_SMTP_PASS', 'my-pass'); // SMTP authentication password, only used if WPMS_SMTP_AUTH is true
```

## Installation

* `git clone` into */wp-content/plugins/flyn-mail-smtp* directory
* Ensure all required constants are defined in *wp-config.php*
* Activate the plugin

## Testing

You can test whether or not mail is working with the following WP-CLI command:
```
wp flyn-mail-smtp test --to="some@email.com"
```