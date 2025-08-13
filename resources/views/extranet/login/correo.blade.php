@php
// Include the Autoloader (see "Libraries" for install instructions)


require __DIR__.'/../../../vendor/autoload.php';

// Use the Mailgun class from mailgun/mailgun-php v4.2
use Mailgun\Mailgun;

// Instantiate the client.
$mg = Mailgun::create(getenv('API_KEY') ?: 'API_KEY');
// When you have an EU-domain, you must specify the endpoint:
// $mg = Mailgun::create(getenv('API_KEY') ?: 'API_KEY', 'https://api.eu.mailgun.net');

// Compose and send your message.
$result = $mg->messages()->send(
'quiku.co',
[
'from' => 'Mailgun Sandbox <postmaster@quiku.co>',
    'to' => 'Cesar Maya <mayatolozacesar@gmail.com>',
        'subject' => 'Hello Cesar Maya',
        'text' => 'Congratulations Cesar Maya, you just sent an email with Mailgun! You are truly awesome!'
        ]
        );

        print_r($result->getMessage());

        @endphp
