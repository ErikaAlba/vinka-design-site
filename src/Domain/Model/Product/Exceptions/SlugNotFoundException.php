<?php

namespace App\Domain\Model\Product\Exceptions;

class SlugNotFoundException extends \Exception
{
    public function __construct(string $slug)
    {
        parent::__construct('slug ' .$slug. ' not found');
    }
}