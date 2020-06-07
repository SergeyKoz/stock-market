<?php

namespace App\Tests\Entities;

use App\Entity\HistoryRequestForm;
use App\Exception\FormErrorException;
use PHPUnit\Framework\TestCase;

class HistoryRequestFormTest extends TestCase
{
    function testFormExceptions_SymbolIsEmpty()
    {
        $this->expectException(FormErrorException::class);
        $this->expectExceptionMessage('Field \'symbol\' cannot be empty.');
        new HistoryRequestForm('', '2010-01-01', '2010-05-01', 'email@email.com');
    }

    function testFormExceptions_DateFromIsEmpty()
    {
        $this->expectException(FormErrorException::class);
        $this->expectExceptionMessage('Field \'from\' cannot be empty.');
        new HistoryRequestForm('ALL', '', '2010-05-01', 'email@email.com');
    }

    function testFormExceptions_DateToIsEmpty()
    {
        $this->expectException(FormErrorException::class);
        $this->expectExceptionMessage('Field \'to\' cannot be empty.');
        new HistoryRequestForm('ALL', '2010-01-01', '', 'email@email.com');
    }

    function testFormExceptions_EmailIsEmpty()
    {
        $this->expectException(FormErrorException::class);
        $this->expectExceptionMessage('Field \'email\' cannot be empty.');
        new HistoryRequestForm('ALL', '2010-01-01', '2010-05-01', '');
    }

    function testFormExceptions_EmailWrongFormat()
    {
        $this->expectException(FormErrorException::class);
        $this->expectExceptionMessage('Invalid email format.');
        new HistoryRequestForm('ALL', '2010-01-01', '2010-05-01', 'email@');
    }

    function testFormExceptions_FromGreaterThenTo()
    {
        $this->expectException(FormErrorException::class);
        $this->expectExceptionMessage('Date \'from\' can not be greater then \'to\'.');
        new HistoryRequestForm('ALL', '2010-06-01', '2010-05-01', 'email@email.com');
    }

    function testFormExceptions_DatesAreEqual()
    {
        $this->expectException(FormErrorException::class);
        $this->expectExceptionMessage('Date \'from\' can not be equal \'to\'.');
        new HistoryRequestForm('ALL', '2010-05-01', '2010-05-01', 'email@email.com');
    }

    function testForm_AllDataValid()
    {
        $form = new HistoryRequestForm('ALL', '2010-01-01', '2010-05-01', 'email@email.com');

        $this->assertEquals('ALL', $form->getSymbol());
        $this->assertEquals(\DateTime::createFromFormat('Y-m-d', '2010-01-01', ), $form->getFrom());
        $this->assertEquals(\DateTime::createFromFormat('Y-m-d', '2010-05-01', ), $form->getTo());
        $this->assertEquals('email@email.com', $form->getEmail());
    }
}