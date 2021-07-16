<?php

namespace App\Events;

use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\Liste;
use App\Repository\ListeRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\String\Slugger\SluggerInterface;

class ListeSubscriber implements EventSubscriberInterface
{

    private $security;
    private $slug;
    private $repository;

    public function __construct(Security $security, SluggerInterface $slug, ListeRepository $repository)
    {
        $this->security = $security;
        $this->slug = $slug;
        $this->repository = $repository;
    }

    public static function getSubscribedEvents()
    {
        //on se place au pre-validate (avant la validation des données de l'entité ici Liste)
        //car on envoie pas la donnée user et chrono dans le json, on les ajoute dans ce subscriber
        return [
            KernelEvents::VIEW => ['setUserForListe',EventPriorities::PRE_VALIDATE]
        ];
    }

    public function setUserForListe(ViewEvent $event)
    {
        $result = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        //on verifie qu'on est avec une instance de Liste et que le verbe Http est POST
        if ($result instanceof Liste && $method == 'POST') {

            $result->setUser($this->security->getUser());
            $chrono = ($this->repository->findNextChrono($this->security->getUser()) == null)? 1 : $this->repository->findNextChrono($this->security->getUser());
            $result->setChrono($this->repository->findNextChrono($this->security->getUser()));

            if(empty($result->getCreatedAt())){
                $result->setCreatedAt(new \DateTimeImmutable());
            }
        }
    }
}
