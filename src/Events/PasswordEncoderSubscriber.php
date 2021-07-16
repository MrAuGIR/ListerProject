<?php

namespace App\Events;

use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\User;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class PasswordEncoderSubscriber implements EventSubscriberInterface{

    private $encoder;

    public function __construct(UserPasswordHasherInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    /** 
    * Branchement a un event
    * https://api-platform.com/docs/core/events/#the-event-system
    */
    public static function getSubscribedEvents()
    {
        /**
         *  Je me branche a l'event kernel::view
         *  si j'ai cette event j'appel la fonction 'encodePassword'
         *  on indique la priorité ici : EventPriorites
         *  je branche après la desirialization du json et avant l'ecriture par doctrine de notre objet
         * 
         */
        return [
            KernelEvents::VIEW => ['encodePassword', EventPriorities::PRE_WRITE]
        ];
        
    }

    public function encodePassword(ViewEvent $event){
        /**
         *  event represente l'event qui vient de se reproduire
         *  getcontrollerresult() donne l'entity deserializer par api platform avant l'envoi dans bdd par doctrine
         *  il faut precisé qu'on est dans le cas d'un requète en POST user
         * $result est en faite $user
         */
        
        $result = $event->getControllerResult();

        $method = $event->getRequest()->getMethod(); //méthode utilisé (POST, PUt ...)
        // on verifie qu'on travail avec une instance de la classe User
        if ($result instanceof User && $method === 'POST') {
            // hash du mot de passe passé dans le json (il est dans result) et mise a jour du mot de passe
            $hash = $this->encoder->hashPassword($result, $result->getPassword());
            $result->setPassword($hash);
        }
    }


}