<?php

declare(strict_types=1);

namespace Azine\VideoJsBundle\Tests;

use Azine\VideoJsBundle\AzineVideoJsBundle;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpKernel\Bundle\Bundle;

final class AzineVideoJsBundleTest extends TestCase
{
    public function testBundleCanBeInstantiated(): void
    {
        $bundle = new AzineVideoJsBundle();

        self::assertInstanceOf(Bundle::class, $bundle);
    }
}
