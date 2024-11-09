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
    <div class="grid grid-cols-2 gap-4 sm:grid-cols-2 md:grid-cols-2">
        <div class="p-6 bg-white rounded-lg shadow-lg dark:bg-gray-800">
            <div class="flex items-center">
                <div>
                    <p class="text-lg font-medium leading-6 text-white-900 dark:text-white-100">Notes Sent</p>
                </div>
            </div>
            <div class="mt-6">
                <p class="text-3xl font-bold leading-9 text-gray-900 dark:text-white-100">{{ $notesSentCount }}</p>
            </div>
        </div>
        <div class="p-6 bg-white rounded-lg shadow-lg dark:bg-green-800">
            <div class="flex items-center">
                <div>
                    <p class="text-lg font-medium leading-6 text-white-100 ">Notes Liked</p>
                </div>
            </div>
            <div class="mt-6">
                <p class="text-3xl font-bold leading-9 text-white-900 dark:text-gray-300">{{ $notesLovedCount }}</p>
            </div>
        </div>
    </div>
</div>
