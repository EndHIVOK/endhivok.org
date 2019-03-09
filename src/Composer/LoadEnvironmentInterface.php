<?php
declare(strict_types=1);

/**
 * @file
 * Contains \EndHivOkProject\Composer\LoadEnvironment class.
 *
 * This file is autoloaded.
 */

namespace EndHivOkProject\Composer;

use Composer\Script\Event as ComposerEvent;

/**
 * Interface for loading environment settings into a project.
 *
 * @todo Break out complex functions into smaller helper functions or classes.
 * @todo Switch to `use`ing the project's `Dotenv` implementation.
 * @todo Use `symfony/finder` to find the root directory. DrupalFinder is a
 *       quick and dirty, but it doesn't make the script very modular.
 * @todo Read the `composer.json` file for other `.env` file to load.
 */
interface LoadEnvironmentInterface {

  /**
   * Loads environment settings from `.env` in project root.
   *
   * @param ComposerEvent $composerEvent
   */
  public static function loadDotenv(ComposerEvent $composerEvent): void;

}
