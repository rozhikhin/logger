<?php

namespace Logger\Handlers;

class FakeHandler implements LogHandler
{
    public array $levels = [];
    public function log($level = '', $message = '') {

    }
}
