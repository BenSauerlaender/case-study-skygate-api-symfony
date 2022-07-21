<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\InputBag;

/**
 * @extends ServiceEntityRepository<User>
 *
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function add(User $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(User $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @return User[] Returns an array of User objects
     */
    public function findByQuery(InputBag $query): array
    {
        $q = $this->createQueryBuilder('u');

        $q->andWhere('u.verified = true');

        $q->setMaxResults($query->get('page'))
            ->setFirstResult($query->get('index') * $query->get('page'));

        foreach (['name', 'email', 'city', 'postcode', 'phone'] as $attr) {
            if ($query->get($attr)) {
                $q->andWhere('u.' . $attr . ' LIKE :val' . $attr)
                    ->setParameter('val' . $attr, '%' . $query->get($attr) . '%');
            }
        }

        if (in_array($query->get('sortby'), ['name', 'email', 'city', 'postcode', 'phone'])) {
            $direction = ($query->get('order') == 'DESC') ? 'DESC' : 'ASC';
            $q->orderBy('u.' . $query->get('sortby'), $direction);
        }

        return $q->getQuery()
            ->getResult();
    }

    public function findLengthByQuery(InputBag $query): int
    {
        $q = $this->createQueryBuilder('u')
            ->select('count(u.id)')
            ->andWhere('u.verified = true');

        foreach (['name', 'email', 'city', 'postcode', 'phone'] as $attr) {
            if ($query->get($attr)) {
                $q->andWhere('u.' . $attr . ' LIKE :val' . $attr)
                    ->setParameter('val' . $attr, '%' . $query->get($attr) . '%');
            }
        }

        return $q->getQuery()
            ->getSingleScalarResult();
    }

    //    public function findOneBySomeField($value): ?User
    //    {
    //        return $this->createQueryBuilder('u')
    //            ->andWhere('u.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
