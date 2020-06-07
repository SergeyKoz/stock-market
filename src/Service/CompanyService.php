<?php

namespace App\Service;

use App\Entity\Company;
use App\Repository\CompanyRepository;

class CompanyService
{
    private CompanyRepository $companyRepository;

    /**
     * CompanyService constructor.
     * @param CompanyRepository $companyRepository
     */
    public function __construct(CompanyRepository $companyRepository){
        $this->companyRepository = $companyRepository;
    }

    /**
     * @param string $symbol
     * @return bool
     */
    public function checkSymbol(string $symbol): bool
    {
        return $this->companyRepository->count(['symbol' => $symbol]) > 0;
    }

    public function getCompanyBySymbol(string $symbol): Company
    {
        return $this->companyRepository->findOneBy(['symbol' => $symbol]);
    }
}