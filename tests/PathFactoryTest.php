<?php

declare(strict_types=1);

use Kito\Path\Path;
use Kito\Path\PathFactory;
use PHPUnit\Framework\TestCase;

class PathFactoryTest extends TestCase
{
    public function testFactoryRootPath(): void
    {
        $this->assertInstanceOf(Path::class, PathFactory::createRootPath());
    }

    public function testFactoryRootPathWithCustomPathSeparator(): void
    {
        $this->assertInstanceOf(Path::class, PathFactory::createRootPath('-'));
    }

    public function testFactoryExamplePath(): void
    {
        $this->assertInstanceOf(Path::class, PathFactory::createPathFromString('mypath'));
    }

    public function testFactoryExamplePathWithCustomPathSeparator(): void
    {
        $this->assertInstanceOf(Path::class, PathFactory::createPathFromString('mypath', '-'));
    }
}
