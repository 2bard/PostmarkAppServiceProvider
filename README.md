#PostMark Service Provider for Silex 

This is a service provider for the Silex PHP Microframework, it provides access to Postmark app via the [CentralApps mail component](https://github.com/CentralApps/Mail-PostmarkApp).

##Installation

1. Add to your `composer.json` file

	{
		"repositories": [
	        {
	            "type": "vcs",
	            "url": "http://github.com/lewisbaker/PostmarkAppServiceProvider"
	        }
	    ],
		"require": {
			"lewisbaker/silex-postmarkapp": "dev-master"
		}
	}

2. Download composer

	curl -s https://getcomposer.org/installer | php

3. Install the dependencies

	php composer.phar install
	

###Usage

$app->register(new LewisB\PostMarkServiceProvider\PostMarkServiceProvider(), array(
    'postmark.default_sender_name' => 'Bob',
    'postmark.default_sender_email' => 'bob@internet.com',
    'postmark.api_key' => 'your-api-ley'
));

$sender = $app['postmark.default_email_sender'];
$recipient = new \CentralApps\Mail\SendersReceiversEtc\Recipient("alice@internet.com");
			
$message = new \CentralApps\PostMarkApp\Message();
$message->setSender($sender);
$message->addRecipient($recipient);
$reply_to_email = $app['postmark.default_sender_email'];
$reply_to = new \CentralApps\Mail\SendersReceiversEtc\ReplyTo($reply_to_email);
$message->setReplyTo($reply_to);
$message->setSubject("Greetings");
$message->setPlainTextMessage("hello world!");
$result = $app['postmark']->send($message);