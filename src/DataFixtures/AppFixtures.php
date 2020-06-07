<?php
namespace App\DataFixtures;

use App\Entity\Company;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     * php bin/console doctrine:fixtures:load
     */
    public function load(ObjectManager $manager)
    {
        $companies = file_get_contents(dirname(__FILE__) . '/nasdaq-listed_json.json');
        $companies = json_decode($companies, true);
        foreach ($companies as $item) {
            $company = new Company();
            $company->setName($item['Company Name']);
            $company->setSecurityName($item['Security Name']);
            $company->setFinancialStatus($item['Financial Status']);
            $company->setMarketCategory($item['Market Category']);
            $company->setRoundLotSize($item['Round Lot Size']);
            $company->setSymbol($item['Symbol']);
            $company->setTestIssue($item['Test Issue']);
            $manager->persist($company);
        }
        $manager->flush();
    }
}