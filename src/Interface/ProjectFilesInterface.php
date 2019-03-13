<?php
declare(strict_types=1);
/**
 * @file
 * Contains \EhokProject\Environment\ProjectFilesInterface.
 */

namespace EhokProject\Interface;

use Composer\Script\Event;
use Composer\Semver\Comparator;
use DrupalFinder\DrupalFinder;
use Symfony\Component\Filesystem\Filesystem;
use Webmozart\PathUtil\Path;

interface ScriptHandler {

  /**
   * Composer Event object
   * @var \Composer\Script\Event
   */
  public $composerEvent;

  /**
  * Drupal root folder
  * @var \DrupalFinder\DrupalFinder
  */
  public $drupalRoot;

  /**
   * Composer version string
   * @var string
   */
  public $composerVersion;

  /**
   * Symfony Filesystem object
   * @var \Symfony\Component\Filesystem\Filesystem
   */
  public $filesystemObject;

  public static function getComposerVersion(): string

  public static function createRequiredFiles(Event $event): bool;

  /**
   * Checks if the installed version of Composer is compatible.
   *
   * Composer 1.0.0 and higher consider a `composer install` without having a
   * lock file present as equal to `composer update`. We do not ship with a lock
   * file to avoid merge conflicts downstream, meaning that if a project is
   * installed with an older version of Composer the scaffolding of Drupal will
   * not be triggered. We check this here instead of in drupal-scaffold to be
   * able to give immediate feedback to the end user, rather than failing the
   * installation after going through the lengthy process of compiling and
   * downloading the Composer dependencies.
   *
   * @see https://github.com/composer/composer/pull/5035
   */
  public static function checkComposerVersion(ComposerEvent $event);

  public function errorHandler();

  public function errorWriter();

  public function createFileList();

  public function updateFileList(): iterable;

  public function getFileList(): iterable;

  public static function setupFiles(): bool;

  public static function cleanFiles(): bool;

  public static function checkFiles(): bool;
}
