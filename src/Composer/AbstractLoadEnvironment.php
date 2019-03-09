<?php
declare(strict_types=1);
/**
 * @file
 * Contains \EndHivOkProject\Composer\LoadEnvironment class.
 */

namespace EndHivOkProject\Composer;

/**
 * Loads the environment variables from `.env`
 *
 * This file is autoloaded.
 *
 * @see https://getcomposer.org/doc/04-schema.md#files
 */

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
  public static function loadDotenv(ComposerEvent $composerEvent): void
  {
    $composer = $composerEvent->getComposer();
    $ComposerIO = $composerEvent->getIO();
    $ComposerIO->writeError('<info>' . LoadEnvironment::class . '::' . __FUNCTION__ . ' loaded</info>', true, $ComposerIO::DEBUG);

    $filesystem = new Filesystem();
    $pathFinder = new PathFinder();

    /**
     * Try to find the Drupal root directory.
     *
     * @var PathFinder
     *
     * @throws \Error
     *
     * @todo break this out into its own function.
     * @todo Create \EndHivOkProject\Util\FindRootFolder to simplify this procedure.
     */
    try {
      $ComposerIO->writeError('Searching for the project root path', true, $ComposerIO::DEBUG);
      // If the Drupal root directory can't be located, we throw an error.
      if (!$pathFinder->locateRoot(getcwd())) {
        throw new \Error("Cannot locate a Drupal root directory. Exiting.", E_USER_ERROR);
      };
      // Get composer root directory and notify the user
      $projectRoot = $pathFinder->getComposerRoot();
      $ComposerIO->writeError('Project root: <info>' . $projectRoot . '</info>', true, $ComposerIO::VERY_VERBOSE);
    }
    catch (\Error $e) {
      $ComposerIO->writeError('<critical>' . $e->getMessage() . '</critical>');
      exit($e->getCode());
    }

    /**
     * Load any .env file in the project root.
     *
     * See the file `/config/.env.example`.
     *
     * @throws InvalidPathException
     *
     * @todo Expand to allow storage in /config.
     * @todo Consider allowing a heirachy between root and /config.
     * @todo break this out into its own function.
     */
    $dotenv = new Dotenv($projectRoot);
    try {
      $ComposerIO->writeError('Loading <info>' . $projectRoot . '/.env</info>', true, $ComposerIO::VERBOSE);
      $dotenv->load();
    }
    catch (InvalidPathException $e) {
      $ComposerIO->writeError('<warning>' . $e->getMessage() . '</warning>', true, $ComposerIO::VERBOSE);
    }

    return;
  }
}
