<?php

use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;

new class extends Component {
    public function with()
    {
        return [
            'notesSentCount' => Auth::user()->notes()
                ->where('send_date' . '<' . now())
                ->where('is_published', true)
                ->count(),

            'notesLovedCount' => Auth::user()->notes->sum('heart_count'),
        ];


    }
}; ?>

<div>

</div>
