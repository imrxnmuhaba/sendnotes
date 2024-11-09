<?php

use App\Models\Note;
use Livewire\Volt\Component;

new class extends Component {
    public Note $note;
    public $heartCount;

    public function mount(Note $note)
    {
        $this->note = $note;
        $this->heartCount = $note->heart_count;
    }

    public function increaseHeartCount()
    {
        $this->note-heart_count +1;
        $this->note->save();
        $this->heartCount = $this->note->heart_count;
    }
}; ?>

<div>
    <x-button xs wire:click="increaseHeartCount" rose icon="heart" spinner>{{$heartCount}}</x-button>
</div>
