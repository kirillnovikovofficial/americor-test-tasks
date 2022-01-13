<?php

namespace app\components\export;

use app\components\export\interfaces\ExportInterface;

class AbstractFactory
{
    public static function create(string $format): ExportInterface
    {
        $class = __NAMESPACE__ . '\\' . ucfirst($format);

        if (!class_exists($class)) {
            throw new \InvalidArgumentException(sprintf('Unknown format %s', $format));
        }

        return new $class;
    }

}