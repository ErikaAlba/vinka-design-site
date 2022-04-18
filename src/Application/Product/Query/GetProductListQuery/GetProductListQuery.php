<?php

namespace App\Application\Product\Query\GetProductListQuery;

class GetProductListQuery
{

    private string $familyName;
    private int $results;

    public function __construct(string $familyName, int $results)
    {
        $this->familyName = $familyName;
        $this->results = $results;
    }

    /**
     * @return string
     */
    public function getFamilyName(): string
    {
        return $this->familyName;
    }

    /**
     * @return int
     */
    public function getResults(): int
    {
        return $this->results;
    }


}