<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * PermitUserRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PermitUserRepository extends \AppBundle\Libs\Repository\BaseRepository {

    public function getBaseQuery($baseEntity, $start = 0, $limit = 30, $filters = array(), $columnsAlias = array(), $decorator = ResultDecorator::DEFAULT_DECORATOR) {

    }
}