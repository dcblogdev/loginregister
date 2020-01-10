Login Register
=============

These files acompany the tutorial: [Login and Registration system with PHP](https://daveismyname.blog/login-and-registration-system-with-php)

## send emails locally

For anyone who is struggling with emails locally I highly recommend using https://mailtrap.io this is a great service to catch emails when working locally.

To set it up open classes/phpmailer/mail.php and enter the SMTP details:

Ensure you enter the username and password provided from mailtrap.


```php
public $Host = 'smtp.mailtrap.io';
public $Mailer = 'smtp';
public $SMTPAuth = true;
public $Username = '';
public $Password = '';
//public $SMTPSecure = 'tls';
```
