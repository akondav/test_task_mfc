<?php

 namespace App\Repository;
 
 use App\Entity\QueryMfc;
 use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
 use Doctrine\ORM\QueryBuilder;
 use Doctrine\Persistence\ManagerRegistry;
 
 class QueryRepository extends ServiceEntityRepository
 {
    private const DAYS_BEFORE_CLOSED_REMOVAL = 3;

    public function __construct(ManagerRegistry $registry)
    {
         parent::__construct($registry, QueryMfc::class);
    }
 
    public function countOldClosed(): int
    {
        return $this->getOldClosedQueryBuilder()->select('COUNT(q.id)')->getQuery()->getSingleScalarResult();
    }

    public function deleteOldClosed(): int
    {
        return $this->getOldClosedQueryBuilder()->delete()->getQuery()->execute();
    }

    private function getOldClosedQueryBuilder(): QueryBuilder
    {
        return $this->createQueryBuilder('q')
            ->where('q.status = :state_id')
            ->andWhere('q.dateLastChange < :date')
            ->setParameters([
                'date' => new \DateTime(-self::DAYS_BEFORE_CLOSED_REMOVAL.' days'),
                'state_id' => 3
            ])
        ;
    }
 }