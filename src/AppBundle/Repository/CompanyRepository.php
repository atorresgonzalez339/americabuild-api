<?php

namespace AppBundle\Repository;

use AppBundle\Libs\Normalizer\ResultDecorator;

/**
 * CompanyRepository
 */
class CompanyRepository extends \AppBundle\Libs\Repository\BaseRepository {

    public function getBaseQuery($baseEntity, $start = 0, $limit = 30, $filters = array(), $columnsAlias = array(), $decorator = ResultDecorator::DEFAULT_DECORATOR) {

    }
}