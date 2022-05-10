<?php

namespace App\Repository;

use App\Entity\Student;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Student|null find($id, $lockMode = null, $lockVersion = null)
 * @method Student|null findOneBy(array $criteria, array $orderBy = null)
 * @method Student[]    findAll()
 * @method Student[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StudentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Student::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Student $entity, bool $flush = true): void
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
    public function remove(Student $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
      * @return Student[]  
      */
    public function sortStudentAsc()
    {
        return $this->createQueryBuilder('student')
            ->orderBy('student.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @return Student[]  
     */
    public function sortStudentDesc()
    {
        return $this->createQueryBuilder('student')
              ->orderBy('student.id', 'DESC')
              ->getQuery()
              ->getResult()
          ;
    }

    /**
      * @return Student[]  
    */
    public function search ($keyword)
    {
        return $this->createQueryBuilder('student')
            ->andWhere('student.name LIKE :key')
            ->setParameter('key', '%' . $keyword . '%')
            ->orderBy('student.name', 'ASC')
            ->setMaxResults(5)
            ->getQuery()
            ->getResult()
        ;
    }

}
