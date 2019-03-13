<?php
declare(strict_types=1);
/**
 * @file
 * Contains \EhokProject\Composer\Preflight file.
 */

namespace EhokProject\Composer;

use Composer\Script\Event as ComposerEvent;
use EhokProject\Composer\AbstractPreflight;
use EhokProject\Composer\ScriptHandler;


class Preflight extends AbstractPreflight {

    public static function run(?ComposerEvent $composerEvent): void
    {
        ScriptHandler::checkComposerVersion($composerEvent);

        return;
    }

}
