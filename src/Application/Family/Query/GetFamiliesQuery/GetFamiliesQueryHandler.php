<?php

namespace App\Application\Family\Query\GetFamiliesQuery;

use App\Infrastructure\Repository\Family\FamilyRepository;

class GetFamiliesQueryHandler
{
    private FamilyRepository $familyRepository;

    public function __construct(FamilyRepository $familyRepository)
    {
        $this->familyRepository = $familyRepository;
    }

    public function handle(GetFamiliesQuery $query)
    {
        return $this->familyRepository->all();
    }
}