<?php
declare(strict_types=1);
/**
 * @file
 * Contains the `/src/Env/LoadEnvironment.php` file.
 */

namespace EhokProject\Env;

use Composer\Script\Event as ComposerEvent;
use Dotenv\Dotenv;
use Dotenv\Exception\InvalidPathException;
use DrupalFinder\DrupalFinder as PathFinder;
use Symfony\Component\Filesystem\Filesystem;
use Webmozart\PathUtil\Path;

/**
 * @inheritdoc
 */
class LoadEnvironment extends AbstractLoadEnvironment {

  /**
   * @inheritdoc
   */
  public static function loadDotenv(ComposerEvent $composerEvent = null): void
  {
    if($composerEvent) {
      $composer = $composerEvent->getComposer();
      $io = $composerEvent->getIO();
      $io->writeError('<info>' . LoadEnvironment::class . '::' . __FUNCTION__ . ' loaded</info>', true, $io::DEBUG);
    }

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
     * @todo Create \EhokProject\Util\FindRootFolder to simplify this procedure.
     */
    try {
      if($composerEvent) {
        $io->writeError('Searching for the project root path', true, $io::DEBUG);
      }
      // If the Drupal root directory can't be located, we throw an error.
      if (!$pathFinder->locateRoot(getcwd())) {
        throw new \Error("Cannot locate a Drupal root directory. Exiting.", E_USER_ERROR);
      };
      // Get composer root directory and notify the user
      $projectRoot = $pathFinder->getComposerRoot();
      if($composerEvent) {
        $io->writeError('Project root: <info>' . $projectRoot . '</info>', true, $io::VERY_VERBOSE);
      }
    }
    catch (\Error $e) {
      if($composerEvent) {
        $io->writeError('<critical>' . $e->getMessage() . '</critical>');
      }
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
      if($composerEvent) {
        $io->writeError('Loading <info>' . $projectRoot . '/.env</info>', true, $io::VERBOSE);
      }
      $dotenv->load();
    }
    catch (InvalidPathException $e) {
      if($composerEvent) {
        $io->writeError('<warning>' . $e->getMessage() . '</warning>', true, $io::VERBOSE);
      }
    }

    return;
  }
}
