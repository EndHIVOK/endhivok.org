<?php
declare(strict_types=1);
/**
 * @file
 * Contains \EhokProject\Composer\PreflightInterface file.
 */

namespace EhokProject\Composer;

use Composer\Script\Event as ComposerEvent;

interface PreflightInterface {

  public static function run(?ComposerEvent $composerEvent): void;

}
