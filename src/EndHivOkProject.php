<?php
/**
 * @file
 * Contains \EhokProject\Interface\ProjectControllerInterface
 */

namespace EhokProject;

use Composer\Script\Event as ComposerEvent;
use Composer\Semver\Comparator;
use DrupalFinder\DrupalFinder;
use Symfony\Component\Filesystem\Filesystem;
use Webmozart\PathUtil\Path;

interface ProjectControllerInterface {

  /**
   * Composer \ComposerEvent object
   * @var ComposerEvent
   */
  $composerEvent = ComposerEvent;

  public static setupFilesystem() {

  }
}
