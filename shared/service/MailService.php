<?php

namespace Service;

/**
 * Description of ExcelService
 *
 * @author Thomasino
 */
class MailService extends \Core\Service\Service
{



    /**
     * 
     * 
     */
    public function send($to, $subject, $message)
    {
        $headers = array(
            'From' => 'webmaster@example.com',
            'Reply-To' => 'webmaster@example.com',
            'X-Mailer' => 'PHP/' . phpversion()
        );


        return mail($to, $subject, $message, $headers);
    }


   
}
