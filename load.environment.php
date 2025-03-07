<?php
/**
 * Loads the environment variables from `.env`
 *
 * This file is included very early. See autoload.files in composer.json
 * and https://getcomposer.org/doc/04-schema.md#files
 *
 * @TODO: This file will be superceded by `src/LoadEnvironmentFile.php`
 */

use Dotenv\Dotenv;
use Dotenv\Exception\InvalidPathException;

/**
 * Load any .env file
 *
 * See file `/.env.dist`
 */
$dotenv = new Dotenv(__DIR__);
try {
  $dotenv->load();
}
catch (InvalidPathException $e) {
  // Do nothing. Production environments rarely use .env files.
}
