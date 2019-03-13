<?php
declare(strict_types=1)

namespace EhokProject\Environment;

use Composer\Composer;
use Composer\IO\IOInterface as ComposerIo;
use Composer\Script\Event as ComposerEvent;
use DrupalFinder\DrupalFinder;
use Symfony\Component\Filesystem\Filesystem;
use Webmozart\PathUtil\Path;

interface DrupalRootInterface
{

    public $composer;

    public $composerEvent;

    public $composerIo;

    public $drupalFinder;

    public $drupalRoot;

    public $filesystem;

    public function __construct();

    public function getComposer(): Composer;

    public function getComposerEvent(): ComposerEvent;

    public function getComposerIo(): ComposerIo;

    public function getDrupalFinder(): DrupalFinder;

    public function getDrupalRoot(): string;

    public function getFilesystem(): Filesystem;

}

?>
