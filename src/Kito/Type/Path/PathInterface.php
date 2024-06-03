<?php

declare(strict_types=1);

/**
 * Path
 * Path string parser and handler
 * php version 7.1.
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
 * Path Interface.
 */
interface PathInterface extends \Kito\Type\PathInterface
{
   

    /**
     * Set directory separator.
     *
     * @param string $directorySeparator directory char separator
     *
     * @return Path
     *
     * @deprecated replaced by withDirectorySeparator
     */
    public function setDirectorySeparator(string $directorySeparator): PathInterface;

 
    /**
     * Return new path with current path combined to new sub path.
     *
     * @param Path $subPath path to be merged
     *
     * @return Path
     *
     * @deprecated replaced by withSuffixPath
     */
    public function withPath(PathInterface $subPath): PathInterface;

 
}
