<?php
declare(strict_types=1);

namespace EhokProject\Dotenv;

use Dotenv\Dotenv;
use Dotenv\Exception\InvalidPathException;
use EhokProject\Composer\Dotenv\DotenvInterface;

/**
 * This is the dotenv class.
 *
 * It's responsible for loading a `.env` file in the given directory and
 * setting the environment vars.
 */
abstract class AbstractDotenv extends Dotenv implements DotenvInterface
{
    /**
     * The file path.
     *
     * @var string
     */
    protected $filePath;

    /**
     * The loader instance.
     *
     * @var \Dotenv\Loader|null
     */
    protected $loader;

    /**
     * Create a new dotenv instance.
     *
     * @param string $path
     * @param string $file
     *
     * @return void
     */
    public function __construct(string $path, string $file = '.env')
    {
        //$this->filePath = $this->getFilePath($path, $file);
        //$this->loader = new Loader($this->filePath, true);
        return parent::__construct($path, $file);
    }

    /**
     * Load environment file in given directory.
     *
     * @throws \Dotenv\Exception\InvalidPathException|\Dotenv\Exception\InvalidFileException
     *
     * @return array
     */
    public function load(): array
    {
        return parent::load();
    }

    /**
     * Load environment file in given directory, suppress InvalidPathException.
     *
     * @throws \Dotenv\Exception\InvalidFileException
     *
     * @return array
     */
    public function safeLoad(): array
    {
        return parent::safeLoad();
    }

    /**
     * Load environment file in given directory.
     *
     * @throws \Dotenv\Exception\InvalidPathException|\Dotenv\Exception\InvalidFileException
     *
     * @return array
     */
    public function overload(): array
    {
        return parent::overload();
    }

    /**
     * Returns the full path to the file.
     *
     * @param string $path
     * @param string $file
     *
     * @return string
     */
    protected function getFilePath(string $path, string $file): string
    {
        return parent::getFilePath($path, $file);
    }

    /**
     * Actually load the data.
     *
     * @param bool $overload
     *
     * @throws \Dotenv\Exception\InvalidPathException|\Dotenv\Exception\InvalidFileException
     *
     * @return array
     */
    protected function loadData(bool $overload = false): array
    {
        return parent::loadData($overload);
    }

    /**
     * Required ensures that the specified variables exist, and returns a new validator object.
     *
     * @param string|string[] $variable
     *
     * @return \Dotenv\Validator
     */
    public function required($variable): Validator
    {
        return parent::required($variable);
    }

    /**
     * Get the list of environment variables declared inside the 'env' file.
     *
     * @return array
     */
    public function getEnvironmentVariableNames(): array
    {
        return parent::getEnvironmentVariableNames();
    }
}
