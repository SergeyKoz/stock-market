<?php

namespace App\Entity;

use App\Exception\FormErrorException;
use DateTime;
use Symfony\Component\HttpFoundation\Response;

class HistoryRequestForm
{
    private string $symbol;
    private \DateTime $from;
    private \DateTime $to;
    private string $email;

    public function __construct(string $symbol, string $from, string $to, string $email){
        if ($symbol == "") {
            throw new FormErrorException(Response::HTTP_BAD_REQUEST, "Field 'symbol' cannot be empty.", ['symbol']);
        }
        if ($from == "") {
            throw new FormErrorException(Response::HTTP_BAD_REQUEST, "Field 'from' cannot be empty.", ['from']);
        }
        if ($to == "") {
            throw new FormErrorException(Response::HTTP_BAD_REQUEST, "Field 'to' cannot be empty.", ['to']);
        }
        if ($email == "") {
            throw new FormErrorException(Response::HTTP_BAD_REQUEST, "Field 'email' cannot be empty.", ['email']);
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new FormErrorException(Response::HTTP_BAD_REQUEST, "Invalid email format.", ['email']);
        }

        $format = 'Y-m-d';
        $this->from = DateTime::createFromFormat( $format,$from);
        $this->to = DateTime::createFromFormat( $format, $to);
        if ($this->from > $this->to) {
            throw new FormErrorException(Response::HTTP_BAD_REQUEST, "Date 'from' can not be greater then 'to'.", ['from', 'to']);
        }

        if ($this->from == $this->to) {
            throw new FormErrorException(Response::HTTP_BAD_REQUEST, "Date 'from' can not be equal 'to'.", ['from', 'to']);
        }
        $this->symbol = $symbol;
        $this->email = $email;
    }

    public function getSymbol(): string
    {
        return $this->symbol;
    }

    public function getFrom(): DateTime
    {
        return $this->from;
    }

    public function getTo(): DateTime
    {
        return $this->to;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
}