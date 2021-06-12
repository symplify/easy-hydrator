<?php

declare(strict_types=1);

namespace Symplify\EasyHydrator\Tests;

use Symplify\EasyHydrator\ArrayToValueObjectHydrator;
use Symplify\EasyHydrator\Exception\MissingConstructorException;
use Symplify\EasyHydrator\Tests\Fixture\NoConstructor;
use Symplify\EasyHydrator\Tests\HttpKernel\EasyHydratorTestKernel;
use Symplify\PackageBuilder\Testing\AbstractKernelTestCase;

final class MissingConstructorTest extends AbstractKernelTestCase
{
    private ArrayToValueObjectHydrator $arrayToValueObjectHydrator;

    protected function setUp(): void
    {
        $this->bootKernel(EasyHydratorTestKernel::class);

        $this->arrayToValueObjectHydrator = $this->getService(ArrayToValueObjectHydrator::class);
    }

    public function test(): void
    {
        $this->expectException(MissingConstructorException::class);

        $this->arrayToValueObjectHydrator->hydrateArray([
            'key' => 'whatever',
        ], NoConstructor::class);
    }
}
