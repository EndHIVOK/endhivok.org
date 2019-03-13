<?php
/**
 * Loads the environment variables from `.env`
 *
 * This file is included very early. See autoload.files in composer.json and
 * https://getcomposer.org/doc/04-schema.md#files
 *
 * TODO: Refactor the code below, which was copied directly from `load.environment.php`
 */

use Dotenv\Dotenv;
use Dotenv\Exception\InvalidPathException;

/**
 * Load environment variables from `.env`
 *
 * An example of this file can be seen in `.env.dist`
 */
$projectRoot = __DIR__ . '/../';
$dotenv = new Dotenv($projectRoot);
try {
  $dotenv->load();
}
catch (InvalidPathException $e) {
// TODO: Add proper exception handling.
}
