<?php

namespace Logger\Handlers;

class SysLogHandler implements LogHandler
{
    public array $levels;
    private bool $is_enabled;

    public function __construct(array $settings)
    {
        $this->is_enabled = $settings['is_enabled'];
        $this->levels = $settings['levels'];
    }

    /**
     * Массив с приоритетами для указания при записи в syslog
     *
     * @var array
     */
    private array $prioritiesByLevel = [
        'ERROR' => LOG_ERR,
        'INFO' => LOG_INFO,
        'DEBUG' => LOG_DEBUG,
        'NOTICE' => LOG_NOTICE,
    ];

    /**
     * Ф-я записи в Syslog
     *
     * @param $level
     * @param $message
     * @return void
     */
    public function log($level, $message) {
        if (!$this->is_enabled) {
            return;
        }

        $priority = $this->prioritiesByLevel[$level];
        syslog($priority, $message);
    }
}
