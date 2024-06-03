<?php

declare(strict_types=1);

/**
 * Path Factory Interface
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

namespace Kito\Type;

/**
 * Path Class.
 */
interface PathFactoryInterface
{
    /**
     * Create Path object from path string and directory separator char.
     *
     * @param string $stringPath         path string
     * @param string $directorySeparator directory char separator
     *
     * @return PathInterface
     */
    public static function createPathFromString(string $stringPath = DIRECTORY_SEPARATOR, string $directorySeparator = DIRECTORY_SEPARATOR): PathInterface;

    /**
     * Create root Path object with separator char.
     *
     * @param string $directorySeparator directory char separator
     *
     * @return PathInterface
     */
    public static function createRootPath(string $directorySeparator = DIRECTORY_SEPARATOR): PathInterface;
}
