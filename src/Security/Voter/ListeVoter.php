<?php

namespace App\Security\Voter;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Entity\Liste;
use Symfony\Component\Security\Core\Security;

class ListeVoter extends Voter
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }
    
    protected function supports(string $attribute, $subject): bool
    {
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return in_array($attribute, ['LISTE_CREATE','LISTE_EDIT', 'LISTE_VIEW','LISTE_DELETE'])
            && $subject instanceof \App\Entity\Liste;
    }

    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();
        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
        }

        //Si je suis l'administrateur j'ai tous les droit
        if ($this->security->isGranted('ROLE_ADMIN')) {
            return true;
        }

        /** @var Liste $liste */
        $liste = $subject;

        // ... (check conditions and return true to grant permission) ...
        switch ($attribute) {
            case 'LISTE_CREATE':
                return true;
                break;
            case 'LISTE_EDIT':
                return ($liste->getUser() == $user);
                break;
            case 'LISTE_VIEW':
                return ($liste->getUser() == $user);
                break;
            case 'LISTE_DELETE':
                return ($liste->getUser() == $user);
        }

        return false;
    }
}
