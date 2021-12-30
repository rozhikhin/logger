<?php

namespace Logger\Formatters;

use DateTime;
use Logger\LogLevel;

class LineFormatter
{
    /**
     * @var string
     */
    private mixed $dateFormat;
    /**
     * @var string
     */
    private mixed $formatter;

    public function __construct(
        $formatter = '%date%  %level_code%  %level%  %message%',
        $dateFormat = 'Y-m-d H:i:s'
    )
    {
        $this->formatter = $formatter;
        $this->dateFormat = $dateFormat;
    }

    /**
     * Ф-я подготавливает сообщение для записи в лог, в зависимости от свойства $formatter
     *
     * @param $level
     * @param $message
     * @return string
     */
    public function formatMessage($level, $message): string
    {
        $date = (new DateTime())->format($this->dateFormat);
        $levelName = $level;
        $logLevelCode = LogLevel::getLevelCode($levelName);
        return str_replace(
            ['%date%', '%level_code%', '%level%', '%message%'],
            [$date, $logLevelCode, $levelName, $message],
            $this->formatter
        );
    }

}
