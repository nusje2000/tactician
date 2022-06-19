<?php

declare(strict_types=1);

namespace League\Tactician\Handler\Mapping\MapByNamingConvention\MethodName;

use function strpos;
use function strrpos;
use function strtolower;
use function substr;

/**
 * Assumes the method is only the last portion of the class name.
 *
 * Examples:
 *  - \MyGlobalCommand    => $handler->myGlobalCommand()
 *  - \My\App\CreateUser  => $handler->createUser()
 */
final class LastPartOfClassName implements MethodNameInflector
{
    public function getMethodName(string $commandClassNameName): string
    {
        $lastNamespaceSeparatorPosition = strrpos($commandClassNameName, '\\');

        // If class name has a namespace separator, only take last portion
        if ($lastNamespaceSeparatorPosition !== false) {
            $commandClassNameName = substr($commandClassNameName, $lastNamespaceSeparatorPosition + 1);
        }

        return strtolower($commandClassNameName[0]) . substr($commandClassNameName, 1);
    }
}
