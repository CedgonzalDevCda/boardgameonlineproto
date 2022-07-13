<?php

namespace App\Repository;

use App\Entity\PlayerHasGameroom;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PlayerHasGameroom>
 *
 * @method PlayerHasGameroom|null find($id, $lockMode = null, $lockVersion = null)
 * @method PlayerHasGameroom|null findOneBy(array $criteria, array $orderBy = null)
 * @method PlayerHasGameroom[]    findAll()
 * @method PlayerHasGameroom[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlayerHasGameroomRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PlayerHasGameroom::class);
    }

    public function add(PlayerHasGameroom $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(PlayerHasGameroom $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return PlayerHasGameroom[] Returns an array of PlayerHasGameroom objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?PlayerHasGameroom
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
