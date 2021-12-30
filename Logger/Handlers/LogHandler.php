<?php

namespace Logger\Handlers;

interface LogHandler
{
    public function log(string $level, string $message);
}
