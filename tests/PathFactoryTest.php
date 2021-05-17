<?php

declare(strict_types=1);

use Kito\Path\Path;
use Kito\Path\PathFactory;
use PHPUnit\Framework\TestCase;

class PathFactoryTest extends TestCase
{
    const customDirectorySeparator = '-';

    public function testFactoryRootPath(): void
    {
        $instance = PathFactory::createRootPath();

        $this->assertInstanceOf(Path::class, $instance);
        $this->assertSame(DIRECTORY_SEPARATOR, $instance->getDirectorySeparator());
        $this->assertTrue($instance->isRoot());
        $this->assertSame(0, $instance->getDeep());
    }

    public function testFactoryRootPathWithCustomPathSeparator(): void
    {
        $instance = PathFactory::createRootPath(self::customDirectorySeparator);

        $this->assertInstanceOf(Path::class, $instance);
        $this->assertSame(self::customDirectorySeparator, $instance->getDirectorySeparator());
        $this->assertTrue($instance->isRoot());
        $this->assertSame(0, $instance->getDeep());
    }

    public function testFactoryExamplePath(): void
    {
        $instance = PathFactory::createPathFromString('mypath');

        $this->assertInstanceOf(Path::class, $instance);
        $this->assertSame(DIRECTORY_SEPARATOR, $instance->getDirectorySeparator());
        $this->assertFalse($instance->isRoot());
        $this->assertSame(1, $instance->getDeep());
    }

    public function testFactoryExamplePathWithCustomPathSeparator(): void
    {
        $instance = PathFactory::createPathFromString('mypath', self::customDirectorySeparator);

        $this->assertInstanceOf(Path::class, $instance);
        $this->assertSame(self::customDirectorySeparator, $instance->getDirectorySeparator());
        $this->assertFalse($instance->isRoot());
        $this->assertSame(1, $instance->getDeep());
    }
}
