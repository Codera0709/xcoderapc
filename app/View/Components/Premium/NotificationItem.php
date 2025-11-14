<?php

namespace App\View\Components\Premium;

use Illuminate\View\Component;

class NotificationItem extends Component
{
    public $title;
    public $message;
    public $time;
    public $type; // info, success, warning, error
    public $unread;

    /**
     * Create a new component instance.
     */
    public function __construct($title = '', $message = '', $time = '', $type = 'info', $unread = true)
    {
        $this->title = $title;
        $this->message = $message;
        $this->time = $time;
        $this->type = $type;
        $this->unread = $unread;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.premium.notification-item');
    }
}