<?php
declare(strict_types=1)

namespace EhokProject\Environment;

use Composer\Composer;
use Composer\IO\IOInterface as ComposerIo;
use Composer\Script\Event as ComposerEvent;
use DrupalFinder\DrupalFinder;
use Symfony\Component\Filesystem\Filesystem;
use Webmozart\PathUtil\Path;

abstract class AbstractDrupalRoot implements DrupalRootInterface
{

    private $composer;

    private $composerEvent;

    private $composerIo;

    private $drupalFinder;

    private $drupalRoot;

    private $filesystem;

    public function __construct()
    {

    }

    public function getComposer(): Composer
    {
      return $this->composer;
    }

    public function getComposerEvent(): ComposerEvent
    {
      return $this->composerEvent;
    }

    public function getComposerIo(): ComposerIo
    {
      return $this->composerIo;
    }

    public function getDrupalFinder(): DrupalFinder
    {
        return $this->drupalFinder;
    }

    public function getDrupalRoot(): string
    {
        return $this->drupalRoot;
    }

    public function getFilesystem(): Filesystem
    {
        return $this->filesystem;
    }

    private function setComposer(Composer $composer): Composer
    {
        $this->composer = $composer;
        return $this->getComposer();
    }

    private function setComposerEvent(ComposerEvent $composerEvent): ComposerEvent
    {
        $this->composerEvent = $composerEvent;
        return $this->getComposerEvent();
    }

    private function setComposerIo(ComposerIo $composerIo): ComposerIo
    {
        $this->composerIo = $composerIo;
        return $this->getComposerIo();
    }

    private function setDrupalFinder(DrupalFinder $drupalFinder): DrupalFinder
    {
        $this->drupalFinder = $drupalFinder;
        return $this->getDrupalFinder();
    }

    private function setDrupalRoot(string $drupalRoot): string
    {
        $this->drupalRoot = $drupalRoot;
        return this->getDrupalRoot();
    }

    private function setFilesystem(Filesystem $filesystem): Filesystem
    {
        $this->filesystem = $filesystem;
        return getFilesystem();
    }

}

?>
