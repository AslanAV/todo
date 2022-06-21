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
        error_log(json_encode($message));

        $tasks[] = new TaskDTO('TODO1', TaskDTO::STATUS_TODO);
        $tasks[] = new TaskDTO('TODO2', TaskDTO::STATUS_TODO);
        $tasks[] = new TaskDTO('TODO3', TaskDTO::STATUS_TODO);
        $tasks[] = new TaskDTO('TODO4', TaskDTO::STATUS_DONE);
        $tasks[] = new TaskDTO('TODO5', TaskDTO::STATUS_DONE);
        $tasks[] = new TaskDTO('TODO6', TaskDTO::STATUS_DONE);

        $this->sendToDoList($tasks, $chatId);
    }
    /**
     * @param array <TaskDTO> $tasks
     * @param string $chatId
     * @return void
     */
    public function sendToDoList(array $tasks, string $chatId):void
    {
        $formatedTasks = array_reduce($tasks, function (string $acc, TaskDTO $task) {
            $acc .= $task->getText() . static::STATUS_MAP[$task->getStatus()] . "\n";
            return $acc;
        });
        $this->transport->sendAnswer('sendMessage', [
            'chat_id' => $chatId,
            'text' => $formatedTasks
        ]);
    }
}