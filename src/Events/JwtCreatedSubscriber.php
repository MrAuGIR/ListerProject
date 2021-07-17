<?php

namespace App\Events;

use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;

class JwtCreatedSubscriber
{
    private $security;

    public function __construct()
    {
        
    }

    public function updateJwtData(JWTCreatedEvent $event){
        //dans event on a les donnée de l'utilisateur qui vient de se connecter
        //et les données  du token

        /** @var User $user */
        $user = $event->getUser();

        $data = $event->getData();
        $data['firstName'] = $user->getFirstName();
        $data['lastName'] = $user->getLastName();

        $event->setData($data);  
    }
}
