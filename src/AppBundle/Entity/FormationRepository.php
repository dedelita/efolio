<?php

namespace AppBundle\Entity;

/**
 * FormationRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class FormationRepository extends \Doctrine\ORM\EntityRepository
{
    public function getFormations() {
        $query = $this->_em->createQuery('SELECT f.name, f.years, f.institute FROM AppBundle:Formation f');
        return $query->getResult();
    }
}
