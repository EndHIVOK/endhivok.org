<?php
declare(strict_types=1);
/**
 * @file
 * Contains \EhokProject\Composer\ScriptHandler file.
 */

namespace EhokProject\Composer;

use Composer\Script\Event as ComposerEvent;
use Composer\Semver\Comparator as SemverComparator;
use DrupalFinder\DrupalFinder;
use Symfony\Component\Filesystem\Filesystem;
use Webmozart\PathUtil\Path;

class ScriptHandler implements ScriptHandlerInterface {

  /**
   * @inheritdoc
   */
  public static function createRequiredFiles(ComposerEvent $composerEvent): void
  {
    $filesystem = new Filesystem();
    $drupalFinder = new DrupalFinder();
    $drupalFinder->locateRoot(getcwd());
    $drupalRoot = $drupalFinder->getDrupalRoot();

    $composer = $composerEvent->getComposer();

    $composerIO = $composerEvent->getIO();

    $dirs = [
      'modules',
      'profiles',
      'themes',
    ];

    // Required for unit testing
    foreach ($dirs as $dir) {
      if (!$fs->exists($drupalRoot . '/'. $dir)) {
        $fs->mkdir($drupalRoot . '/'. $dir);
        $fs->touch($drupalRoot . '/'. $dir . '/.gitkeep');
      }
    }

    // Prepare the settings file for installation
    if (!$fs->exists($drupalRoot . '/sites/default/settings.php') and $fs->exists($drupalRoot . '/sites/default/default.settings.php')) {
      $fs->copy($drupalRoot . '/sites/default/default.settings.php', $drupalRoot . '/sites/default/settings.php');
      require_once $drupalRoot . '/core/includes/bootstrap.inc';
      require_once $drupalRoot . '/core/includes/install.inc';
      $settings['config_directories'] = [
        CONFIG_SYNC_DIRECTORY => (object) [
          'value' => Path::makeRelative($drupalFinder->getComposerRoot() . '/config/sync', $drupalRoot),
          'required' => TRUE,
        ],
      ];
      drupal_rewrite_settings($settings, $drupalRoot . '/sites/default/settings.php');
      $fs->chmod($drupalRoot . '/sites/default/settings.php', 0666);
      $composerEvent->getIO()->write("Create a sites/default/settings.php file with chmod 0666");
    }

    // Create the files directory with chmod 0777
    if (!$fs->exists($drupalRoot . '/sites/default/files')) {
      $oldmask = umask(0);
      $fs->mkdir($drupalRoot . '/sites/default/files', 0777);
      umask($oldmask);
      $composerEvent->getIO()->write("Create a sites/default/files directory with chmod 0777");
    }
  }

  public static function checkComposerVersion(?ComposerEvent $composerEvent): void
  {
    if($composerEvent) {
      $composer = $composerEvent->getComposer();
      $composerIO = $composerEvent->getIO();
      $composerVersion = $composer::VERSION;

      $composerIO->writeError('Composer version: <info>'. $composerVersion .'</info>', true, $composerIO::DEBUG);


      // The dev-channel of composer uses the git revision as version number,
      // try to the branch alias instead.
      if (preg_match('/^[0-9a-f]{40}$/i', $composerVersion)) {
        $composerVersion = $composer::BRANCH_ALIAS_VERSION;
      }

      // If Composer is installed through git we have no easy way to determine if
      // it is new enough, just display a warning.
      if ($composerVersion === '@package_version@' || $composerVersion === '@package_branch_alias_version@') {
        if($composerEvent) {
          $composerIO->writeError('<warning>You are running a development version of Composer. If you experience problems, please update Composer to the latest stable version.</warning>');
        }
      }
      elseif (SemverComparator::lessThan($composerVersion, '1.0.0')) {
        if($composerEvent) {
          $composerIO->writeError('<error>Drupal-project requires Composer version 1.0.0 or higher. Please update your Composer before continuing</error>.');
          exit(1);
        }
      }
    }

    return;
  }

}
