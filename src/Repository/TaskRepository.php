<?php

namespace App\Repository;

use App\Entity\Task;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Knp\Component\Paginator\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Knp\Component\Pager\PaginatorInterface as PagerPaginatorInterface;
use Symfony\Component\HttpFoundation\Response;
/*
 * @extends ServiceEntityRepository<Task>
 *
 * @method Task|null find($id, $lockMode = null, $lockVersion = null)
 * @method Task|null findOneBy(array $criteria, array $orderBy = null)
 * @method Task[]    findAll()
 * @method Task[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TaskRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Task::class);
    }
    
    // public function findPaginatedTasks($page, $limit)
    // {
    //     $qb = $this->createQueryBuilder('t')
    //         ->getQuery();

    //     $paginator = new Paginator($qb);
    //     $paginator
    //         ->getQuery()
    //         ->setFirstResult(($page - 1) * $limit)
    //         ->setMaxResults($limit);

    //     return $paginator;
    // }

    
   
    public function save(Task $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);
        if ($flush) 
        {
            $this->getEntityManager()->flush();
        }
    }
    

    //    /
//     * @return Task[] Returns an array of Task objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Task
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}