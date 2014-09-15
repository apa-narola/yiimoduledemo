<?php

class FileUtils
{
    /**
    * Creates all parent directories if they do not exist.
    * @param string $directory the directory to be checked
    */
    public static function ensureDirectory($directory)
    {
       if(!is_dir($directory)) {
            self::ensureDirectory(dirname($directory));
            mkdir($directory);
       }
    }
}
