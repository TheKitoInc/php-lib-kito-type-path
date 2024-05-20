<?php

declare(strict_types=1);

use Kito\Type\Path\Path;
use Kito\Type\Path\PathFactory;
use Kito\Type\Path\PathInterface;
use PHPUnit\Framework\TestCase;

class PathFactoryTest extends TestCase
{
    const customDirectorySeparator = '-';

    public function testFactoryRootPath(): void
    {
        $instance = $this->getTestInstance();

        $this->assertTrue($instance->isRoot());
        $this->assertSame(0, $instance->getDeep());
    }

    public function testFactoryRootPathWithCustomPathSeparator(): void
    {
        $instance = $instance = $this->getTestInstance([], self::customDirectorySeparator);

        $this->assertTrue($instance->isRoot());
        $this->assertSame(0, $instance->getDeep());
    }

    public function testFactoryExamplePath(): void
    {
        $instance = $instance = $this->getTestInstance(['mypath']);

        $this->assertFalse($instance->isRoot());
        $this->assertSame(1, $instance->getDeep());
        $this->assertSame('mypath', $instance->getName());
    }

    public function testFactoryExamplePathWithCustomPathSeparator(): void
    {
        $instance = $instance = $this->getTestInstance(['mypath'], self::customDirectorySeparator);

        $this->assertFalse($instance->isRoot());
        $this->assertSame(1, $instance->getDeep());
        $this->assertSame('mypath', $instance->getName());
    }

    private function getRandomPathElements(): array
    {
        $numberPathElements = random_int(1, 100);

        $arrayPathElements = [];
        for ($i = 0; $i <= $numberPathElements; $i++) {
            $arrayPathElements[] = bin2hex(random_bytes(random_int(1, 100)));
        }

        return $arrayPathElements;
    }

    private function getRandomSameElement(string $element): array
    {
        return array_fill(0, random_int(1, 100), $element);
    }

    private function getTestInstance(array $arrayPath = [], string $directorySeparator = DIRECTORY_SEPARATOR): PathInterface
    {
        $stringPath = implode($directorySeparator, $arrayPath);
        $instance = PathFactory::createPathFromString($stringPath, $directorySeparator);
        $this->assertInstanceOf(Path::class, $instance);
        $this->assertInstanceOf(PathInterface::class, $instance);
        $this->assertSame($directorySeparator, $instance->getDirectorySeparator());
        $this->assertLessThanOrEqual(count($arrayPath), $instance->getDeep());

        return $instance;
    }

    private function mergeANDshuffle(array $a, array $b): array
    {
        $c = array_merge($a, $b);
        shuffle($c);

        return $c;
    }

    public function testRandomPathGenerator()
    {
        $arrayPathElements = $this->getRandomPathElements();
        $arrayPathDotElements = $this->getRandomSameElement('.');
        $arrayPathBackElements = $this->getRandomSameElement('..');

        $this->assertSame(count($arrayPathElements), $this->getTestInstance($arrayPathElements, self::customDirectorySeparator)->getDeep());
        $this->assertSame(0, $this->getTestInstance($arrayPathDotElements, self::customDirectorySeparator)->getDeep());
        $this->assertSame(0, $this->getTestInstance($arrayPathBackElements, self::customDirectorySeparator)->getDeep());

        $this->assertSame(count($arrayPathElements), $this->getTestInstance($this->mergeANDshuffle($arrayPathElements, $arrayPathDotElements), self::customDirectorySeparator)->getDeep());
        $this->assertSame(0, $this->getTestInstance($this->mergeANDshuffle($arrayPathBackElements, $arrayPathDotElements), self::customDirectorySeparator)->getDeep());

        for ($i = 0; $i < 100; $i++) {
            $arrayPathElements = array_merge($arrayPathElements, $arrayPathDotElements, $arrayPathBackElements);
            shuffle($arrayPathElements);
            $instance = $this->getTestInstance($arrayPathElements, self::customDirectorySeparator);
            $this->assertLessThanOrEqual(count($arrayPathElements), $instance->getDeep());
        }
    }
}
