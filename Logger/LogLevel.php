<?php

namespace Logger;

class LogLevel
{
    const LEVEL_ERROR  = 'ERROR';
    const LEVEL_INFO = 'INFO';
    const LEVEL_DEBUG = 'DEBUG';
    const LEVEL_NOTICE = 'NOTICE';

    /**
     * @param string $levelCode
     * @return string
     */
    public static function getLevelCode(string $levelCode): string
    {
        $levelNames = [
            'ERROR' => '001',
            'INFO' => '002',
            'DEBUG' => '003',
            'NOTICE' => '004',
        ];

        return $levelNames[$levelCode];
    }
}
