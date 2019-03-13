<?php
declare(strict_types=1);
/**
 * @file
 * Contains the `src/Env/AbstractLoadEnvironment.php` file.
 */

namespace EhokProject\Env;

use Composer\Script\Event as ComposerEvent;
use Dotenv\Dotenv;
use Dotenv\Exception\InvalidPathException;
use DrupalFinder\DrupalFinder as PathFinder;
use Symfony\Component\Filesystem\Filesystem;
use Webmozart\PathUtil\Path;

/**
 * Loads file-based environment settings into a project.
 *
 * @todo Break out complex functions into smaller helper functions or classes.
 * @todo Switch to `use`ing the project's `Dotenv` implementation.
 * @todo Use `symfony/finder` to find the root directory. DrupalFinder is a
 *       quick and dirty, but it doesn't make the script very modular.
 * @todo Read the `composer.json` file for other `.env` file to load.
 */
abstract class AbstractLoadEnvironment implements LoadEnvironmentInterface {

  /**
   * @var \Composer\Script\Event
   */
  protected $composerEvent;

  /**
   * @var \Symfony\Component\Filesystem\Filesystem
   */
  protected $filesystem;


  protected $rootFolder;

  /**
   * Loads environment settings from `.env` in project root.
   *
   * @param ComposerEvent $composerEvent
   */
  abstract public static function loadDotenv(ComposerEvent $composerEvent = null): void;

}
