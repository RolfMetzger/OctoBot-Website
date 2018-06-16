<?php

namespace App\Repository;

use App\Entity\Package;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Package|null find($id, $lockMode = null, $lockVersion = null)
 * @method Package|null findOneBy(array $criteria, array $orderBy = null)
 * @method Package[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PackageRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Package::class);
    }

    public function findAll(bool $isSuperAdmin=false, int $ownerId=null)
    {
        $builder = $this->createQueryBuilder('p');
        if (!$isSuperAdmin) {
            $builder->andWhere('p.public = true');
            if ($ownerId > 0) {
                $builder->orWhere('p.owner = :owner');
                $builder->setParameter('owner', $ownerId);
            }
        }
        $builder->orderBy('p.public', 'ASC');
        $builder->addOrderBy('p.category', 'ASC');
        $builder->addOrderBy('p.name', 'ASC');
        return $builder->getQuery()->getResult();
    }

//    /**
//     * @return Package[] Returns an array of Package objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Package
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
