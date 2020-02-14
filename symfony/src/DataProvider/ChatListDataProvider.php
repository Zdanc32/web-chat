<?php
/**
 * Created by PhpStorm.
 * User: lokalny
 * Date: 2/14/2020
 * Time: 10:27 AM
 */

namespace App\DataProvider;

use ApiPlatform\Core\Bridge\Doctrine\Orm\Extension\ContextAwareQueryCollectionExtensionInterface;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Extension\QueryResultCollectionExtensionInterface;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Util\QueryNameGenerator;
use ApiPlatform\Core\DataProvider\CollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Entity\Chat;
use App\Entity\User;
use App\Repository\ChatRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\NonUniqueResultException;
use Symfony\Component\Security\Core\Security;

class ChatListDataProvider implements CollectionDataProviderInterface, RestrictedDataProviderInterface
{
    private $collectionExtensions;
    private $managerRegistry;
    private $security;

    public function __construct(
        ManagerRegistry $managerRegistry,
        Security $security,
        iterable $collectionExtensions
    ) {
        $this->managerRegistry = $managerRegistry;
        $this->collectionExtensions = $collectionExtensions;
        $this->security = $security;
    }

    public function supports(
        string $resourceClass,
        string $operationName = null,
        array $context = []
    ): bool {
        return Chat::class === $resourceClass;
    }

    /**
     * @param string $resourceClass
     * @param string|null $operationName
     * @param array $context
     * @return iterable|mixed|null|object
     * @throws NonUniqueResultException
     */
    public function getCollection(
        string $resourceClass,
        string $operationName = null,
        array $context = []
    ) {
        $manager = $this->managerRegistry->getManagerForClass($resourceClass);

        /**@var ChatRepository $repository*/
        $repository = $manager->getRepository($resourceClass);

        /**@var User $user*/
        $user = $this->security->getUser();

        $queryBuilder = $repository->createQueryBuilder('o');
        $queryBuilder->where(
            'o.createdAt >= :userCreatedAt'
        )->setParameter(
            'userCreatedAt', $user->getCreatedAt()
        );

        $queryNameGenerator = new QueryNameGenerator();

        /** @var ContextAwareQueryCollectionExtensionInterface $extension */
        foreach ($this->collectionExtensions as $extension) {
            $extension->applyToCollection($queryBuilder, $queryNameGenerator, $resourceClass, $operationName, $context);
            if ($extension instanceof QueryResultCollectionExtensionInterface
                && $extension->supportsResult($resourceClass, $operationName)
            ) {
                return $extension->getResult($queryBuilder);
            }
        }

        return $queryBuilder->getQuery()->getOneOrNullResult();
    }
}