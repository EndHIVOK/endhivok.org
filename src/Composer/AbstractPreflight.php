<?php
declare(strict_types=1);
/**
 * @file
 * Contains \EhokProject\Composer\AbstractPreflight file.
 */

namespace EhokProject\Composer;

use Composer\Script\Event as ComposerEvent;
use EhokProject\Composer\PreflightInterface;

abstract class AbstractPreflight implements PreflightInterface {

  abstract public static function run(?ComposerEvent $composerEvent): void;

}
