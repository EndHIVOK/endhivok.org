<?php
declare(strict_types=1);
/**
 * @file
 * Contains \EndHivOkProject\Composer\ScriptHandlerInterface file.
 */

namespace EndHivOkProject\Composer;

use Composer\Script\Event as ComposerEvent;
use Composer\Semver\Comparator;
use DrupalFinder\DrupalFinder;
use Symfony\Component\Filesystem\Filesystem;
use Webmozart\PathUtil\Path;

interface ScriptHandlerInterface {

  public function __construct(ComposerEvent $composerEvent);

  public static function createInstance(ComposerEvent $composerEvent): ScriptHandlerInterface;

  /**
   * Create require files and folders for Drupal 8 installation.
   *
   * @param ComposerEvent $event \Composer\Script\Event object.
   *
   * @return void
   */
  public static function createRequiredFiles(ComposerEvent $composerEvent): void;

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
   *
   * @param ComposerEvent $event \Composer\Script\Event object.
   *
   * @return void
   **/
  public static function checkComposerVersion(ComposerEvent $composerEvent): void;

  /*public static function findDrupalRoot(DrupalFinder $drupalFinder);*/

}
