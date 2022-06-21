<?php

namespace App;

class App
{
    public const STATUS_MAP = [
        TaskDTO::STATUS_DONE => "✅",
        TaskDTO::STATUS_TODO => "⌛"
    ];
    private Transport $transport;

    public function __construct(Transport $transport)
    {
        $this->transport = $transport;
    }

    public function index(array $message, string $chatId): void
    {
        $tasksArr =  $this->transport->getToDoList();
        error_log($tasksArr);
        $tasks = array_map(function ($item) {
            return new TaskDTO($item['description'], $item['status']);
        },$tasksArr);
        $this->sendToDoList($tasks, $chatId);
    }
    /**
     * @param array <TaskDTO> $tasks
     * @param string $chatId
     * @return void
     */
    public function sendToDoList(array $tasks, string $chatId):void
    {
        $formattedTasks = array_reduce($tasks, function (string $acc, TaskDTO $task) {
            $acc .= $task->getText() . static::STATUS_MAP[$task->getStatus()] . "\n";
            return $acc;
        }, '');
        $this->transport->sendAnswer('sendMessage', [
            'chat_id' => $chatId,
            'text' => $formattedTasks
        ]);
    }
}