<?php

namespace App\Doctrine;

use ApiPlatform\Core\Bridge\Doctrine\Orm\Extension\QueryCollectionExtensionInterface;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Extension\QueryItemExtensionInterface;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Util\QueryNameGeneratorInterface;
use App\Entity\Liste;
use App\Entity\ListeLine;
use App\Entity\User;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Security;

/**
 * Quand doctrine va faire une requète pour par exmple chopper une collection il va voir qu'il y a une extension
 * une extension pour apporter des correctifs ou des amelioration a la requète
 */
class CurrentUserExtension implements QueryCollectionExtensionInterface, QueryItemExtensionInterface
{
    public function __construct(private Security $security, private AuthorizationCheckerInterface $auth)
    {
    }

    private function addWhere(QueryBuilder $queryBuilder, string $resourceClass)
    {
        $user = $this->security->getUser();

        //on n'applique les modif uniquement si on n'est pas administrateur
        //si on est administrateur on recupère normalment la liste ou l'item
        //et si user est connecté
        if (($resourceClass === Liste::class || $resourceClass === ListeLine::class) && !$this->auth->isGranted('ROLE_ADMIN') && $user instanceof User) {
            //alias dans la requète sql par exemple 'liste as c' ici le 'c' est l'alias
            $rootAlias = $queryBuilder->getRootAliases()[0];

            if ($resourceClass === Liste::class) {
                $queryBuilder->andWhere("$rootAlias.user = :user");
            } elseif ($resourceClass === ListeLine::class) {
                $queryBuilder->join("$rootAlias.liste", "c")
                    ->andWhere("c.user = :user");
            }

            $queryBuilder->setParameter('user', $user);
        }
    }

    /**
     * Pour faire en sorte de recupèere la liste des customers ou invoices de l'utilisateur connecté uniquement
     * QueryBuilder ('fabrique de requète') represente la requète qui va partir
     * On grèfe le code par dessus (surcharge)
     */
    public function applyToCollection(QueryBuilder $queryBuilder, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, string $operationName = null)
    {
        $this->addWhere($queryBuilder, $resourceClass);
    }

    public function applyToItem(QueryBuilder $queryBuilder, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, array $identifiers, string $operationName = null, array $context = [])
    {
        $this->addWhere($queryBuilder, $resourceClass);
    }

    
}