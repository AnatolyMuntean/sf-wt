<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Engine;
use AppBundle\Entity\Gun;
use Doctrine\ORM\Query\Expr\Join;

/**
 * TankRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TankRepository extends \Doctrine\ORM\EntityRepository
{
    public function findAllWithSameGun(Gun $gun)
    {
        $tanks = $this->createQueryBuilder('t')
            ->join('t.guns', 'tg')
            ->where('tg.id = :gun_id')
            ->setParameter('gun_id', $gun)
            ->getQuery()
            ->getResult();

        return $tanks;
    }

    public function findAllWithSameEngine(Engine $engine)
    {
        $tanks = $this->createQueryBuilder('t')
            ->join('t.engine', 'te')
            ->where('te.id = :engine_id')
            ->setParameter('engine_id', $engine->getId())
            ->getQuery()
            ->getResult();

        return $tanks;
    }
}
