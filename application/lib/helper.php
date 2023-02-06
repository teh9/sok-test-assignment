<?php

use application\lib\Redirect;

/**
 * Check if isset error messages.
 *
 * @return bool
 */
function isErrors (): bool
{
    if (isset($_SESSION['errors'])) {
        return true;
    }

    return false;
}

/**
 * Show error messages.
 *
 * @return void
 */
function showErrors (): void
{
    $errors = $_SESSION['errors'];

    if (is_array($errors)) {
        foreach ($errors as $error) {
            echo $error;
        }
    } else {
        echo $errors;
    }

    unset($_SESSION['errors']);
}

/**
 * Return full controller path.
 *
 * @param string $pathName
 * @return string
 */
function getControllerPath (string $pathName): string
{
    return 'application\controllers\\'.ucfirst($pathName).'Controller';
}

/**
 * Return full middleware path.
 *
 * @param string $pathName
 * @return string
 */
function getMiddleWarePath (string $pathName): string
{
    return 'application\middlewares\\'.$pathName;
}

/**
 * Return the redirect instance to have opportunity redirect.
 *
 * @param $path
 * @return Redirect
 */
function redirect ($path = null): Redirect
{
    return new Redirect($path);
}

/**
 * Checking is method exist.
 *
 * @param $pathToClass
 * @param $methodName
 * @return void
 */
function isMethodExist ($pathToClass, $methodName): void
{
    if (!method_exists($pathToClass, $methodName ))
    {
        throw new RuntimeException(
            "Method '{$methodName}' not found in controller '{$pathToClass}'"
        );
    }
}

/**
 * Checking is class exist.
 *
 * @param $pathToController
 * @return void
 */
function isClassExist ($pathToController): void
{
    if (!class_exists($pathToController))
    {
        throw new RuntimeException("Controller '{$pathToController}' not found");
    }
}
