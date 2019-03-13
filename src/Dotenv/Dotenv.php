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
class Dotenv extends AbstrastDotenv
{

}
