<?php
declare(strict_types=1)
/**
 * @file
 * Initializes a .env file in the project root.
 * 
 * @todo turn this function into a Composer plugin
 */

use EndHivOkProject\Composer\LoadEnvironment;

try {
  LoadEnvironment::loadEnv;
}
catch (\Exception $e) {
  echo 'Error (Code): ' . $e->getMessage() . ' (' . $e->getCode() . ')';
  exit();
}



?>
