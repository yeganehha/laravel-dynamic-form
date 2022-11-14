<?php

namespace Yeganehha\DynamicForm\Events\Form;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class registeringNewFormEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private static $name ;
    private static $model ;
    private static $useExternalTable ;

    /**
     * Create a new event instance.
     *
     * @param string $name
     * @param string|object $model
     * @param bool $useExternalTable
     */
    public function __construct(string $name , $model , bool $useExternalTable)
    {
        self::$name = $name;
        self::$model = $model;
        self::$useExternalTable = $useExternalTable;
    }

    /**
     * @return string
     */
    public static function getName(): string
    {
        return self::$name;
    }

    /**
     * @param string $name
     */
    public static function setName(string $name): void
    {
        self::$name = $name;
    }

    /**
     * @return object|string
     */
    public static function getModel()
    {
        return self::$model;
    }

    /**
     * @param object|string $model
     */
    public static function setModel($model): void
    {
        self::$model = $model;
    }

    /**
     * @return bool
     */
    public static function isUseExternalTable(): bool
    {
        return self::$useExternalTable;
    }

    /**
     * @param bool $useExternalTable
     */
    public static function setUseExternalTable(bool $useExternalTable): void
    {
        self::$useExternalTable = $useExternalTable;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
