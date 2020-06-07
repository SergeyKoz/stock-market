<?php

namespace App\Service;

use App\Entity\HistoryRequestForm;
use Swift_Mailer;
use Swift_Message;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class EmailService
{
    private Swift_Mailer $mailer;
    private Environment $templating;
    private CompanyService $companyService;

    /**
     * EmailService constructor.
     * @param Swift_Mailer $mailer
     * @param Environment $templating
     * @param CompanyService $companyService
     */
    public function __construct(
        Swift_Mailer $mailer, Environment $templating, CompanyService $companyService){
        $this->mailer = $mailer;
        $this->templating = $templating;
        $this->companyService = $companyService;
    }

    /**
     * @param HistoryRequestForm $form
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function sendOnHistoricalData(HistoryRequestForm $form)
    {
        $body = $this->templating->render('emails/onHistoricalData.html.twig', [
            'from' => $form->getFrom()->format('Y-m-d'),
            'to' => $form->getTo()->format('Y-m-d')
        ]);
        $company = $this->companyService->getCompanyBySymbol($form->getSymbol());
        $message = (new Swift_Message($company->getName()))
            ->setFrom('send@example.com')
            ->setTo($form->getEmail())
            ->setBody($body, 'text/html');
        $this->mailer->send($message);
    }
}