<?php

namespace Logger\Handlers;


use Logger\Formatters\LineFormatter;
use Logger\LogLevel;

class FileHandler implements LogHandler
{
    /**
     * @var boolean
     */
    protected bool $is_enabled;
    /**
     * @var string
     */
    protected string $filename;
    /**
     * @var LineFormatter
     */
    protected LineFormatter $formatter;
    /**
     * @var array
     */
    public array $levels = [];

    /**
     * @param array $settings
     */
    public function __construct(Array $settings)
    {
        $this->is_enabled = $settings['is_enabled'];
        $this->filename = $settings['filename'];
        $this->formatter = $settings['formatter'];
        if (isset($settings['levels'])) {
            $this->levels = $settings['levels'];
        }
    }

    /**
     * Ф-я подготавливает сообщение для записи в лог
     *
     * @param $level
     * @param $message
     * @return string
     */
    protected function  createLogEntry($level, $message): string
    {
        $message = $message . "\n";
        return $this->formatter->formatMessage($level, $message);
    }

    /**
     * Ф-я записывает сообщение в файл
     *
     * @param $level
     * @param $message
     * @return void
     */
    public function log($level, $message)
    {
        if (!$this->is_enabled) {
            return;
        }

        $logEntry = $this->createLogEntry($level, $message);

        file_put_contents($this->filename, $logEntry, FILE_APPEND | LOCK_EX);
    }

    public function info(string $message) {
        $this->log(LogLevel::LEVEL_INFO, $message);
    }

    public function error(string $message) {
        $this->log(LogLevel::LEVEL_ERROR, $message);
    }

    public function notice(string $message) {
        $this->log(LogLevel::LEVEL_NOTICE, $message);
    }

    public function debug(string $message) {
        $this->log(LogLevel::LEVEL_DEBUG, $message);
    }

    public function setIsEnabled(bool $is_enabled)
    {
        $this->is_enabled = $is_enabled;
    }

}
