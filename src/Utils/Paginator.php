<?php

namespace App\Utils;

use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator as OrmPaginator;

class Paginator
{
    /**
     * @var integer
     */
    private int $total;

    /**
     * @var integer
     */
    private int $lastPage;

    private mixed $items;

    /**
     * @param Query $query
     * @param int $page
     * @param int $limit
     * @return Paginator
     */
    public function paginate(Query $query, int $page = 1, int $limit = 3): Paginator
    {
        $paginator = new OrmPaginator($query);

        $paginator
            ->getQuery()
            ->setFirstResult($limit * ($page - 1))
            ->setMaxResults($limit);

        $this->total = $paginator->count();
        $this->lastPage = (int) ceil($paginator->count() / $paginator->getQuery()->getMaxResults());
        $this->items = $paginator;

        return $this;
    }

    /**
     * @return int
     */
    public function getTotal(): int
    {
        return $this->total;
    }

    /**
     * @return int
     */
    public function getLastPage(): int
    {
        return $this->lastPage;
    }

    /**
     * @return mixed
     */
    public function getItems()
    {
        return $this->items;
    }
}