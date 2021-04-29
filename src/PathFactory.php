<?php

declare(strict_types=1);

/**
 * Path Factory
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

namespace Kito\Path;

/**
 * Path Class.
 */
class PathFactory implements PathFactoryInterface
{
    /**
     * Create Path object from path string and directory separator char.
     *
     * @param string $stringPath         path string
     * @param string $directorySeparator directory char separator
     *
     * @return PathInterface
     */
    public static function createPathFromString(string $stringPath = DIRECTORY_SEPARATOR, string $directorySeparator = DIRECTORY_SEPARATOR): PathInterface
    {
        $items = explode(
            $directorySeparator,
            str_replace(
                '/',
                $directorySeparator,
                str_replace('\\', $directorySeparator, $stringPath)
            )
        );

        $tmp = [];

        if (is_array($items)) {
            foreach ($items as $name) {
                if ($name === '') {
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
        }

        return new Path($tmp, $directorySeparator);
    }

    /**
     * Create root Path object with separator char.
     *
     * @param string $directorySeparator directory char separator
     *
     * @return PathInterface
     */
    public static function createRootPath(string $directorySeparator = DIRECTORY_SEPARATOR): PathInterface
    {
        return new Path([], $directorySeparator);
    }
}
