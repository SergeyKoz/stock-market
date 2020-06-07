<?php

namespace App\Tests\Common;

use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class InstallTest extends TestCase
{
    function testDebug()
    {
        Assert::assertFalse(false);
        Assert::assertFalse(true);
        return;
    }
}