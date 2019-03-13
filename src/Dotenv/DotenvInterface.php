<?php
declare(strict_types=1);

namespace EhokProject\Dotenv;

use Dotenv\Dotenv;
use Dotenv\Exception\InvalidPathException;

/**
 *
 */
interface DotenvInterface
{

  /**
   * Create a new dotenv instance.
   *
   * @param string $path
   * @param string $file
   *
   * @return void
   */
  public function __construct(string $path, string $file);

  /**
   * Load environment file in given directory.
   *
   * @throws \Dotenv\Exception\InvalidPathException|\Dotenv\Exception\InvalidFileException
   *
   * @return array
   */
  public function load(): array;

  /**
   * Load environment file in given directory, suppress InvalidPathException.
   *
   * @throws \Dotenv\Exception\InvalidFileException
   *
   * @return array
   */
  public function safeLoad(): array;

  /**
   * Load environment file in given directory.
   *
   * @throws \Dotenv\Exception\InvalidPathException|\Dotenv\Exception\InvalidFileException
   *
   * @return array
   */
  public function overload(): array;

  /**
   * Required ensures that the specified variables exist, and returns a new validator object.
   *
   * @param string|string[] $variable
   *
   * @return \Dotenv\Validator
   */
  public function required($variable): Validator;

  /**
   * Get the list of environment variables declared inside the 'env' file.
   *
   * @return array
   */
  public function getEnvironmentVariableNames(): array;

}


?>
