<?php

namespace App\View\Components;

use App\Models\Remender;
use Illuminate\View\Component;

class Notification extends Component
{
    public $remenders;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $today = now()->format('m-d');
        $tomorrow = now()->addDay()->format('m-d');

        $this->remenders = Remender::whereRaw("DATE_FORMAT(STR_TO_DATE(date, '%m/%d/%Y %H:%i'), '%m-%d') = ?", [$today])
            ->orWhereRaw("DATE_FORMAT(STR_TO_DATE(date, '%m/%d/%Y %H:%i'), '%m-%d') = ?", [$tomorrow])
            ->get();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.notification');
    }
}
