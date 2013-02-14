<?php
namespace LewisB\PostmarkServiceProvider;

use Silex\Application;
use Silex\ServiceProviderInterface;
use CentralApps\PostMarkApp as PostMarkApp;
use CentralApps\Mail as Mail;

class PostmarkServiceProvider implements ServiceProviderInterface
{
    public function register(Application $app)
    {
        $app['postmark'] = $app->share(function ($app) {
            $configuration = new PostMarkApp\Configuration();
            $configuration['api_key'] = (string) $app['postmark.api_key'];
            $transport = new PostMarkApp\Transport($configuration);
            $dispatcher = new Mail\Dispatcher($transport);
            return $dispatcher;
        });
        
      
        $app['postmark.default_email_sender'] = $app->share(function($app) {
            $sender = new Mail\SendersReceiversEtc\Sender((string) $app['postmark.default_sender_email'], (string) $app['postmark.default_sender_name']);
            return $sender;
        });
    }

    public function boot(Application $app)
    {
    	
    }
}