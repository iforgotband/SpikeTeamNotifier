<?php

namespace SpikeTeam\ButtonBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * SpikerGroupRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ButtonPushRepository extends EntityRepository
{
    /**
     * Returns most recent Button Push
     */
    public function findMostRecent($currentId = null)
    {
        $qb = $this->createQueryBuilder('p');
        if ($currentId != null) {
            $qb->where('p.id < :id')
                ->setParameter('id', $currentId);
        }
        $qb->orderBy('p.pushTime', 'DESC')
            ->setMaxResults(1);

        try {
            return $qb->getQuery()->getSingleResult();
        }  catch(\Doctrine\ORM\NoResultException $e) {
            return false;
        }
    }

}
