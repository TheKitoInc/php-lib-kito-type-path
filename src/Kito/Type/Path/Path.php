<?php

declare(strict_types=1);

/**
 * Path
 * Path string parser and handler
 * php version 7.4.
 *
 * @category Strings
 *
 * @author   TheKito <TheKito@blktech.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU GPL
 *
 * @link     https://github.com/TheKito/type-path
 */

namespace Kito\Type\Path;

/**
 * Path Class.
 */
class Path implements PathInterface
{
    private string $directorySeparator;
    protected array $pathElements;

    /**
     * Class construct.
     *
     * @param array  $pathElements       path components
     * @param string $directorySeparator directory char separator
     *
     * @return Path
     */
    public function __construct(
        array $pathElements = [],
        string $directorySeparator = DIRECTORY_SEPARATOR
    ) {
        $this->directorySeparator = $directorySeparator;
        $this->pathElements = $pathElements;
    }

    /**
     * Return if path it is empty.
     *
     * @return bool
     */
    public function isRoot(): bool
    {
        return $this->getDeep() == 0;
    }

    /**
     * Get number of components of path.
     *
     * @return int
     */
    public function getDeep(): int
    {
        return count($this->pathElements);
    }

    /**
     * Get name from last path element know as filename.
     *
     * @return string
     */
    public function getName(): string
    {
        return end($this->pathElements);
    }

    /**
     * Set name from last path element know as filename.
     *
     * @param string $name element name
     *
     * @return PathInterface
     */
    public function setName(string $name): PathInterface
    {
        array_pop($this->pathElements);
        $this->pathElements[] = $name;

        return $this;
    }

    /**
     * Get new path object with child element.
     *
     * @param string $name element name
     *
     * @return PathInterface
     */
    public function getChild(string $name): PathInterface
    {
        return new Path(
            array_merge($this->pathElements, [$name]),
            $this->directorySeparator
        );
    }

    /**
     * Get parent path object.
     *
     * @return PathInterface
     */
    public function getParent(): ?PathInterface
    {
        if ($this->isRoot()) {
            return null;
        }
        $parentArray = array_slice($this->pathElements, 0, -1, true);

        return new Path($parentArray, $this->directorySeparator);
    }

    /**
     * Return path as string using directory separator.
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->directorySeparator.implode($this->directorySeparator, $this->pathElements);
    }

    /**
     * Return new path with current path combined to new sub path.
     *
     * @deprecated replaced by withPath
     *
     * @param PathInterface $subPath path to be merged
     *
     * @return PathInterface
     */
    public function combine(PathInterface $subPath): PathInterface
    {
        return $this->withPath($subPath);
    }

    /**
     * Return new path with current path combined to new sub path.
     *
     * @param PathInterface $subPath path to be merged
     *
     * @return PathInterface
     *
     * @deprecated
     */
    public function withPath(PathInterface $subPath): PathInterface
    {
        return $this->withSuffixPath($subPath);
    }

    /**
     * Return new path with prefix path combined to current path.
     *
     * @param PathInterface $path path to be merged before current path
     *
     * @return PathInterface
     */
    public function withPrefixPath(PathInterface $path): PathInterface
    {
        return new Path(
            array_merge($path->getElements(), $this->getElements()),
            $this->directorySeparator
        );
    }

    /**
     * Return new path with current path combined to new path.
     *
     * @param PathInterface $path path to be merged after current path
     *
     * @return PathInterface
     */
    public function withSuffixPath(PathInterface $path): PathInterface
    {
        return new Path(
            array_merge($this->getElements(), $path->getElements()),
            $this->directorySeparator
        );
    }

    /**
     * Return new path prefix with new element from current path.
     *
     * @param string $prefix element to be merged before current path
     *
     * @return PathInterface
     */
    public function withPrefix(string $prefix): PathInterface
    {
        if (in_array($prefix, ['.', '..', '', '/', '\\', $this->directorySeparator])) {
            return $this;
        }

        return new Path(
            array_merge([$prefix], $this->getElements()),
            $this->directorySeparator
        );
    }

    /**
     * Return new path with current path combined to new element.
     *
     * @param string $suffix element to be merged after current path
     *
     * @return PathInterface
     */
    public function withSuffix(string $suffix): PathInterface
    {
        if (in_array($suffix, ['.', '..', '', '/', '\\', $this->directorySeparator])) {
            return $this;
        }

        return new Path(
            array_merge($this->getElements(), [$suffix]),
            $this->directorySeparator
        );
    }

    /**
     * Get current directory separator.
     *
     * @return string
     */
    public function getDirectorySeparator(): string
    {
        return $this->directorySeparator;
    }

    /**
     * Return path with new directory separator from current path.
     *
     * @param string $directorySeparator DirectorySeparator to be merged before current path
     *
     * @return PathInterface
     */
    public function withDirectorySeparator(string $directorySeparator): PathInterface
    {
        if (in_array($directorySeparator, ['.', '..', ''])) {
            return $this;
        }

        return new Path(
            $this->getElements(),
            $directorySeparator
        );
    }

    /**
     * Get elements of path.
     *
     * @return array
     */
    public function getElements(): array
    {
        return $this->pathElements;
    }

    /**
     * Get path element.
     *
     * @param int $index path element position
     *
     * @return string
     */
    public function getElement(int $index): ?string
    {
        if (isset($this->pathElements[$index])) {
            return $this->pathElements[$index];
        }

        return null;
    }

    /**
     * Set hash path string.
     *
     * @param string $hashFunction hash function name
     *
     * @return string
     */
    public function getUID(string $hashFunction = 'sha1'): string
    {
        return hash($hashFunction, implode(chr(0), $this->pathElements));
    }

    /**
     * Set directory separator.
     *
     * @param string $directorySeparator directory char separator
     *
     * @return PathInterface
     *
     * @deprecated
     */
    public function setDirectorySeparator(string $directorySeparator): PathInterface
    {
        $this->directorySeparator = $directorySeparator;

        return $this;
    }
}
