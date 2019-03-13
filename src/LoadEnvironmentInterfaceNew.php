<?php
declare(strict_types=1);
/**
 * @file
 * Contains \EhokProject\Composer\ScriptHandlerInterface file.
 */

namespace EhokProject\Composer;

use Composer\Script\Event as ComposerEvent;
use DrupalFinder\DrupalFinder;
use Symfony\Component\Filesystem\Filesystem;
use Webmozart\PathUtil\Path;
use EhokProject\Composer\Dotenv\Dotenv;

interface LoadEnvironmentNew {

  public static $composerEvent;

  public static $dotenvObj;

  public static $dotenvPath;

  public static $filesystem;

  public static $projectRootPath;

  public static function loadEnvironment(ComposerEvent $composerEvent);
  public static function getComposerEvent(): string;
  public static function getDotenv(): Dotenv;
  public static function getDotenvPath(): string;
  public static function getFilesystem(): string;
  public static function getProjectRootPath(): string;


}
