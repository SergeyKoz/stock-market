<?php

namespace App\Controller;

use App\Entity\HistoryRequestForm;
use App\Exception\FormErrorException;
use App\Service\CompanyService;
use App\Service\EmailService;
use App\Service\StockService;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations\Route;
use FOS\RestBundle\Controller\Annotations as Rest;

/**
 * Class StocksController
 * @package App\Controller
 *
 * @Route("/api/stocks", name="stocks")
 */
class StocksController extends AbstractFOSRestController
{
    private StockService $stockService;
    private CompanyService $companyService;
    private EmailService $emailService;

    /**
     * StocksController constructor.
     * @param StockService $stockService
     * @param CompanyService $companyService
     * @param EmailService $emailService
     */
    public function __construct(
        StockService $stockService, CompanyService $companyService, EmailService $emailService){
        $this->stockService = $stockService;
        $this->companyService = $companyService;
        $this->emailService = $emailService;
    }

    /**
     * @Route("/historical-data", name="historical-data")
     * @param Request $request
     * @return Response
     */
    public function historicalDataAction(Request $request)
    {
        $form = new HistoryRequestForm(
            $request->query->get('symbol', ''),
            $request->query->get('from', ''),
            $request->query->get('to', ''),
            $request->query->get('email', ''),
        );

        if (!$this->companyService->checkSymbol($form->getSymbol())) {
            throw new FormErrorException(Response::HTTP_BAD_REQUEST, "Wrong company symbol.", ['symbol']);
        }

        $stockHistory = $this->stockService->getHistory(
            $form->getSymbol(), $form->getFrom(), $form->getTo());
        $view = $this->view($stockHistory, 200);

        $this->emailService->sendOnHistoricalData($form);

        return $this->handleView($view);
    }
}
