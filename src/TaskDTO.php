<?php

namespace App;

class Task
{
    public const STATUS_DONE = 'done';
    public const STATUS_TODO = 'todo';

    private string $text;
    private string $status;

    public function getStatus(): string
    {
        return $this->status;
    }
}
