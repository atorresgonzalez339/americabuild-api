<?php

namespace AppBundle\Libs\Helper;


use AppBundle\Libs\Decorator\MailDecorator;
use Twig_Environment as Environment;

class SendCustomEmail
{

    private $container;
    private $dir;
    private $twig;

    public function __construct($container, Environment $twig )
    {
        $this->twig = $twig;
        $this->container = $container;
        $separator = DIRECTORY_SEPARATOR;
        $this->dir = $this->container->getParameter('kernel.root_dir') . "$separator" . "logs" . $separator . "emails" . $separator;
    }

    public function sendMessage($emailValues,$emailType)
    {
        $mailAcount = $this->container->getParameter('mailer_user');

        if ($mailAcount) {

            $message = \Swift_Message::newInstance()
                ->setSubject($emailValues["subject"])
                ->setFrom($mailAcount)
                ->setTo($emailValues["email"]);

            switch ($emailType)
            {
                case MailDecorator::REGISTER_ACTIVATION:
                {
                    $body = $this->twig->render("AppBundle:Emails:user_registration_email.html.twig",
                                                array("activationUrl" => $emailValues["url"], "fullname" => $emailValues["fullname"], "systemName" => "American Build" ));
                    $this->writeEmail($body,$emailValues["email"]);
                    $message->setBody($body,"html/text");
                    break;
                }
                case MailDecorator::PASSWORD_RECOVERY:
                {
                    $body = $this->twig->render("AppBundle:Emails:password_reset_email.html.twig",
                        array("activationUrl" => $emailValues["url"], "fullname" => $emailValues["fullname"], "systemName" => "American Build" ));
                    $this->writeEmail($body,$emailValues["email"]);
                    $message->setBody($body,"html/text");
                    break;
                }
            }

            try {
                $send = $this->container->get('swiftmailer.mailer.default')->send($message);

                if ($send) {
                    return true;
                } else {
                    return false;
                }
            } catch (\Exception $e) {

                $this->registerTraceOfEmail('FAILED_TO_SEND_THE EMAIL');
            }
        }
    }

    // this method is temporal. It's only for testing.
    private function writeEmail($body, $recipient)
    {
        try {
            $date = new \DateTime('now');
            $date = $date->format('YmdHis');
            $myfile = @fopen($this->dir . ($recipient.$date) . ".html", "w");

            @fwrite($myfile, $body);
        } catch (\Exception $e) {

        }
    }

    private function registerTraceOfEmail($text)
    {
        try {
            $date = new \DateTime('now');
            $date = $date->format('YmdHis');
            $myfile = @fopen($this->dir . ($date . uniqid()) . ".log", "w");

            @fwrite($myfile, $text);
        } catch (\Exception $e) {

        }
    }
}
