<?php

namespace App\Entity;

use App\Repository\CompanyRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CompanyRepository::class)
 */
class Company
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=6)
     */
    private $symbol;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $security_name;

    /**
     * @ORM\Column(type="string", length=1)
     */
    private $financial_status;

    /**
     * @ORM\Column(type="string", length=1)
     */
    private $market_category;

    /**
     * @ORM\Column(type="float")
     */
    private $round_lot_size;

    /**
     * @ORM\Column(type="string", length=1)
     */
    private $test_issue;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSymbol(): ?string
    {
        return $this->symbol;
    }

    public function setSymbol(string $symbol): self
    {
        $this->symbol = $symbol;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSecurityName(): ?string
    {
        return $this->security_name;
    }

    public function setSecurityName(string $security_name): self
    {
        $this->security_name = $security_name;

        return $this;
    }

    public function getFinancialStatus(): ?string
    {
        return $this->financial_status;
    }

    public function setFinancialStatus(string $financial_status): self
    {
        $this->financial_status = $financial_status;

        return $this;
    }

    public function getMarketCategory(): ?string
    {
        return $this->market_category;
    }

    public function setMarketCategory(string $market_category): self
    {
        $this->market_category = $market_category;

        return $this;
    }

    public function getRoundLotSize(): ?float
    {
        return $this->round_lot_size;
    }

    public function setRoundLotSize(float $round_lot_size): self
    {
        $this->round_lot_size = $round_lot_size;

        return $this;
    }

    public function getTestIssue(): ?string
    {
        return $this->test_issue;
    }

    public function setTestIssue(string $test_issue): self
    {
        $this->test_issue = $test_issue;

        return $this;
    }
}
