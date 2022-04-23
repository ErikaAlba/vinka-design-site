<?php

namespace App\Application\Product\Query\GetProductBySlug;

class GetProductBySlugQuery
{

    private string $slug;

    public function __construct(string $slug)
    {
        $this->slug = $slug;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }


}