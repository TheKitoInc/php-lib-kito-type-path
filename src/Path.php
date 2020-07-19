<?php
/**
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Lesser General Public License for more details.
 *
 */
namespace Kito\Type;

/**
 *
 * @author TheKito <blankitoracing@gmail.com>
 */
class Path
{

    public static function getRoot(string $directorySeparator = DIRECTORY_SEPARATOR): Path
    {
        return new Path(array(), $directorySeparator);
    }

    private static function parsePath(string $stringPath, string $directorySeparator = DIRECTORY_SEPARATOR): array
    {
        $tmp = array();
        foreach (explode($directorySeparator, str_replace("/", $directorySeparator, str_replace("\\", $directorySeparator, $stringPath))) as $name) {
            if (empty($name)) {
                continue;
            }

            if ($name == '.') {
                continue;
            }

            if ($name == '..' && count($tmp) > 0) {
                array_pop($tmp);
                continue;
            }

            $tmp[] = $name;
        }
        return $tmp;
    }

    public static function getFromString(string $stringPath, string $directorySeparator = DIRECTORY_SEPARATOR): Path
    {
        return new Path(self::parsePath($stringPath, $directorySeparator), $directorySeparator);
    }

    private $directorySeparator;
    protected $pathElements;

    public function __construct(array $pathElements = array(), string $directorySeparator = DIRECTORY_SEPARATOR)
    {
        $this->directorySeparator = $directorySeparator;
        $this->pathElements = $pathElements;
    }

    /**
     * Return if path it is empty
     *     
     * @return bool
     */
    public function isRoot(): bool
    {
        return $this->getDeep() == 0;
    }

    /**
     * Get number of components of path
     *     
     * @return int
     */
    public function getDeep(): int
    {
        return count($this->pathElements);
    }

    /**
     * Get name from last path element know as filename
     *
     * @return string
     */
    public function getName(): string
    {
        return end($this->pathElements);
    }

    /**
     * Set name from last path element know as filename
     *
     * @param string $name
     * @return Path
     */
    public function setName(string $name): Path
    {
        array_pop($this->pathElements);
        $this->pathElements[] = $name;
        return $this;
    }

    /**
     * Get new path object with child element     
     * 
     * @param  string $name          
     * @return Path
     */
    public function getChild(string $name): Path
    {
        return new Path(
                array_merge($this->pathElements, array($name)),
                $this->directorySeparator
        );
    }

    /**
     * Get parent path object
     *     
     * @return Path
     */
    public function getParent(): ?Path
    {
        if ($this->isRoot()) {
            return null;
        }
        return new Path(array_slice($this->pathElements, 0, count($this->pathElements) - 1, true), $this->directorySeparator);
    }

    /**
     * return path as string using directory separator
     *     
     * @return string
     */
    public function __toString(): string
    {
        return implode($this->directorySeparator, $this->pathElements);
    }

    /**
     * return new path with current path combined to new sub path
     *     
     * @deprecated
     * @param Path $subPath
     * @return Path
     */
    public function combine(Path $subPath): Path
    {
        return $this->withPath($subPath);
    }

    /**
     * return new path with current path combined to new sub path
     *     
     * @param Path $subPath
     * @return Path
     */
    public function withPath(Path $subPath): Path
    {
        return new Path(
                array_merge($this->pathElements, $subPath->pathElements),
                $this->directorySeparator
        );
    }

    /**
     * get current directory separator
     *     
     * @return string
     */
    public function getDirectorySeparator(): string
    {
        return $this->directorySeparator;
    }

    /**
     * get elements of path
     *     
     * @return array
     */
    public function getElements(): array
    {
        return $this->pathElements;
    }

    /**
     * Get path element
     *     
     * @param  int $index
     * @return string
     */
    public function getElement(int $index): string
    {
        return isset($this->pathElements[$index]) ? $this->pathElements[$index] : null;
    }

    /**
     * Set hash path string
     *     
     * @param  string $hashFunction
     * @return string
     */
    public function getUID(string $hashFunction = 'sha1'): string
    {
        return hash($hashFunction, implode(chr(0), $this->pathElements));
    }

    /**
     * Set directory separator
     *     
     * @return Path
     */
    public function setDirectorySeparator(string $directorySeparator): Path
    {
        $this->directorySeparator = $directorySeparator;
        return $this;
    }

}
