<?php

namespace Logger;

use Logger\Handlers\LogHandler;

class Logger
{
    private array $handlers = [];

    public function addHandler(LogHandler $handler)
    {
        $this->handlers[] = $handler;
    }

    /**
     * Ф-я определяет, на какие уровни логирования подписаны обработчики
     * и для соответствующих уровней вызывает ф-ю log() обработчика.
     * Если уровни логирования не указаны, пишутся все сообщения
     *
     * @param string $level
     * @param string $message
     * @return void
     */
    public function log(string $level, string $message)
    {
        foreach ($this->handlers as $handler) {
            if (in_array($level, $handler->levels) ) {
                $handler->log($level, $message);
            }

            if (!$handler->levels) {
                $handler->log($level, $message);
            }
        }
    }

    public function error(string $message)
    {
        $this->log(LogLevel::LEVEL_ERROR, $message);
    }

    public function info(string $message) {
        $this->log(LogLevel::LEVEL_INFO, $message);
    }

    public function notice(string $message) {
        $this->log(LogLevel::LEVEL_NOTICE, $message);
    }

    public function debug(string $message) {
        $this->log(LogLevel::LEVEL_DEBUG, $message);
    }

}
