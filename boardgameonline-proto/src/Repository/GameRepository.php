<?php

namespace App\Repository;

use App\Data\SearchData;
use App\Entity\Game;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @extends ServiceEntityRepository<Game>
 *
 * @method Game|null find($id, $lockMode = null, $lockVersion = null)
 * @method Game|null findOneBy(array $criteria, array $orderBy = null)
 * @method Game[]    findAll()
 * @method Game[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GameRepository extends ServiceEntityRepository
{
    /**
     * @var PaginatorInterface
     */
    private PaginatorInterface $paginator;

    public function __construct(ManagerRegistry $registry, PaginatorInterface $paginator)
    {
        parent::__construct($registry, Game::class);
        $this->paginator = $paginator;
    }

    public function add(Game $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Game $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * Récupère les jeux en lien avec une recherche
//     * @return Game[]
//     */
//    public function findSearch(SearchData $search ): array {
//        return $this->findAll();
//        $query = $this
//            ->createQueryBuilder('p')
//            ->select('c', 'p')
//            ->join('p.category', 'c');
//        return $query->getQuery()->getResult();
//
//
//    }

    /**
     * Récupère les produits en lien avec une recherche
//     * @return PaginationInterface
     */
    public function findSearch(SearchData $search): PaginationInterface
    {
        $query = $this
            ->createQueryBuilder('g')
            ->select('c', 'g')
            ->join('g.category', 'c');

        if (!empty($search->q)) {
            $query = $query
                ->andWhere('g.name LIKE :q')
                ->setParameter('q', "%{$search->q}%");
        }

        if (!empty($search->minPlayer)) {
            $query = $query
                ->andWhere('g.minPlayer >= :minPlayer')
                ->setParameter('minPlayer', $search->minPlayer);
        }

        if (!empty($search->maxPlayer)) {
            $query = $query
                ->andWhere('g.maxPlayer <= :maxPlayer')
                ->setParameter('maxPlayer', $search->maxPlayer);
        }

        if (!empty($search->category)) {
            $query = $query
                ->andWhere('c.id IN (:category)')
                ->setParameter('category', $search->category);
        }

        $query = $query->getQuery();
        return $this->paginator->paginate(
            $query,
            1,
            15
        );

    }



//    /**
//     * @return Game[] Returns an array of Game objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('g.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Game
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
