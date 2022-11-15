<?php

namespace Buildix\Timex\Calendar;

use Buildix\Timex\Pages\Timex;
use Illuminate\Support\Collection;
use Livewire\Component;

class Day extends Component
{
    public $day;
    public $timestamp;
    public $first;
    public $last;
    public $events;

    public function mount()
    {
        $this->day = $this->day;
        $this->timestamp = $this->timestamp;
        $this->first = $this->first;
        $this->last = $this->last;
        $this->events = $this->getEvents($this->timestamp);
    }


    public function getEvents($timespamp): Collection
    {
        $events = Timex::getEvents();
        return collect($events)->filter(function ($events) use ($timespamp){
            return $this->eventInDay($events->start,$timespamp);

        });
    }

    public function render()
    {
        return view('timex::calendar.day');
    }

    protected function eventInDay($event,$timespamp)
    {
        return $event == $timespamp;
    }
}