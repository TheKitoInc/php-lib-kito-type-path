<?php
/**
 * Path
 * Path string parser and handler
 * php version 7.1
 *
 * @category Strings
 * @package  Kito
 * @author   TheKito <TheKito@blktech.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU GPL
 * @link     https://github.com/TheKito/type-path
 */
namespace Kito;

/**
 *
 * Path Interface
 */
interface PathInterface
{
    public static function getRoot(
        string $directorySeparator = DIRECTORY_SEPARATOR
    ): PathInterface;

    /**
     * Get current directory separator
     *
     * @return string
     */
    public function getDirectorySeparator(): string;

    /**
     * Set directory separator
     *
     * @param string $directorySeparator directory char separator
     *
     * @return Path
     */
    public function setDirectorySeparator(string $directorySeparator): PathInterface;

    /**
     * Get elements of path
     *
     * @return array
     */
    public function getElements(): array;

    /**
     * Get path element
     *
     * @param int $index path element position
     *
     * @return string
     */
    public function getElement(int $index): string;

    /**
     * Get number of components of path
     *
     * @return int
     */
    public function getDeep(): int;

    /**
     * Return if path it is empty
     *
     * @return bool
     */
    public function isRoot(): bool;

    /**
     * Get name from last path element know as filename
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Set name from last path element know as filename
     *
     * @param string $name element name
     *
     * @return Path
     */
    public function setName(string $name): PathInterface;

    /**
     * Get new path object with child element
     *
     * @param string $name element name
     *
     * @return Path
     */
    public function getChild(string $name): PathInterface;

    /**
     * Get parent path object
     *
     * @return Path
     */
    public function getParent(): ?PathInterface;

    /**
     * Return path as string using directory separator
     *
     * @return string
     */
    public function __toString(): string;

    /**
     * Return new path with current path combined to new sub path
     *
     * @param Path $subPath path to be merged
     *
     * @return Path
     */
    public function withPath(PathInterface $subPath): PathInterface;
}
