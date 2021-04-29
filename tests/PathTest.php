<?php

declare(strict_types=1);

use Kito\Path\Path;
use PHPUnit\Framework\TestCase;

class PathTest extends TestCase
{
    public function testPathClassConstructor()
    {
        $object = new Path();
        $this->assertInstanceOf(Path::class, $object);
    }
}
