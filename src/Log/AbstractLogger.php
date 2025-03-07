<?php
declare(strict_types=1);

/**
 * Contains \EhokProject\Log\AbstractLogger file.
 */

namespace EhokProject\Log;

use EhokProject\Log\LoggerInterface;
use Psr\Log\AbstractLogger as PsrAbstractLogger;

/**
 * This is a simple Logger implementation that other Loggers can inherit from.
 *
 * It simply delegates all log-level-specific methods to the `log` method to
 * reduce boilerplate code that a simple Logger that does the same thing with
 * messages regardless of the error level has to implement.
 */
abstract class AbstractLogger implements LoggerInterface, PsrAbstractLogger
{
    /**
     * System is unusable.
     *
     * @param string $message
     * @param array  $context
     *
     * @return void
     */
    public function emergency($message, array $context = array()): void
    {
        $this->log(LogLevel::EMERGENCY, $message, $context);
        return;
    }

    /**
     * Action must be taken immediately.
     *
     * Example: Entire website down, database unavailable, etc. This should
     * trigger the SMS alerts and wake you up.
     *
     * @param string $message
     * @param array  $context
     *
     * @return void
     */
    public function alert(string $message, array $context = array()): void
    {
        $this->log(LogLevel::ALERT, $message, $context);
        return;
    }

    /**
     * Critical conditions.
     *
     * Example: Application component unavailable, unexpected exception.
     *
     * @param string $message
     * @param array  $context
     *
     * @return void
     */
    public function critical(string $message, array $context = array()): void
    {
        $this->log(LogLevel::CRITICAL, $message, $context);
        return;
    }

    /**
     * Runtime errors that do not require immediate action but should typically
     * be logged and monitored.
     *
     * @param string $message
     * @param array  $context
     *
     * @return void
     */
    public function error(string $message, array $context = array()): void
    {
        $this->log(LogLevel::ERROR, $message, $context);
        return;
    }

    /**
     * Exceptional occurrences that are not errors.
     *
     * Example: Use of deprecated APIs, poor use of an API, undesirable things
     * that are not necessarily wrong.
     *
     * @param string $message
     * @param array  $context
     *
     * @return void
     */
    public function warning(string $message, array $context = array()): void
    {
        $this->log(LogLevel::WARNING, $message, $context);
        return;
    }

    /**
     * Normal but significant events.
     *
     * @param string $message
     * @param array  $context
     *
     * @return void
     */
    public function notice(string $message, array $context = array()): void
    {
        $this->log(LogLevel::NOTICE, $message, $context);
        return;
    }

    /**
     * Interesting events.
     *
     * Example: User logs in, SQL logs.
     *
     * @param string $message
     * @param array  $context
     *
     * @return void
     */
    public function info(string $message, array $context = array()): void
    {
        $this->log(LogLevel::INFO, $message, $context);
        return;
    }

    /**
     * Detailed debug information.
     *
     * @param string $message
     * @param array  $context
     *
     * @return void
     */
    public function debug(string $message, array $context = array()): void
    {
        $this->log(LogLevel::DEBUG, $message, $context);
        return;
    }
}
