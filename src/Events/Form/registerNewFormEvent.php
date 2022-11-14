<?php

namespace Yeganehha\DynamicForm\Events\Form;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Yeganehha\DynamicForm\Models\Form;

class registerNewFormEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private static $form ;
    private static $model ;

    /**
     * Create a new event instance.
     *
     * @param Form $form
     * @param string|object $model
     */
    public function __construct(Form $form , $model)
    {
        self::$form = $form;
        self::$model = $model;
    }

    /**
     * @return Form
     */
    public static function getForm(): Form
    {
        return self::$form;
    }

    /**
     * @param Form $form
     */
    public static function setForm(Form $form): void
    {
        self::$form = $form;
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
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
