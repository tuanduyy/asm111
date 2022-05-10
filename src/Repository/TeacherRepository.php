<?php

namespace App\Repository;

use App\Entity\Teacher;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Teacher|null find($id, $lockMode = null, $lockVersion = null)
 * @method Teacher|null findOneBy(array $criteria, array $orderBy = null)
 * @method Teacher[]    findAll()
 * @method Teacher[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TeacherRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Teacher::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Teacher $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Teacher $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
      * @return Teacher[]  
      */
    public function sortTeacherAsc()
    {
        return $this->createQueryBuilder('teacher')
            ->orderBy('teacher.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @return Teacher[]  
     */
    public function sortTeacherDesc()
    {
        return $this->createQueryBuilder('teacher')
              ->orderBy('teacher.id', 'DESC')
              ->getQuery()
              ->getResult()
          ;
    }

    /**
      * @return Teacher[]  
    */
    public function search ($keyword)
    {
        return $this->createQueryBuilder('teacher')
            ->andWhere('teacher.name LIKE :key')
            ->setParameter('key', '%' . $keyword . '%')
            ->orderBy('teacher.name', 'ASC')
            ->setMaxResults(5)
            ->getQuery()
            ->getResult()
        ;
    }

}
