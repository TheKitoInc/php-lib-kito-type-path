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
 * 
 * @deprecated replaced by \Kito\Type\Path 
 */
class Path extends \Kito\Type\Path implements PathInterface
{
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
     * @deprecated replaced by withSuffixPath
     */
    public function withPath(PathInterface $subPath): PathInterface
    {
        return $this->withSuffixPath($subPath);
    }

    /**
     * Set directory separator.
     *
     * @param string $directorySeparator directory char separator
     *
     * @return PathInterface
     *
     * @deprecated replaced by withDirectorySeparator
     */
    public function setDirectorySeparator(string $directorySeparator): PathInterface
    {
        $this->directorySeparator = $directorySeparator;

        return $this;
    }
}
