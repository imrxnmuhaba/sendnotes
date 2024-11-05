<?php

use Livewire\Volt\Component;

new class extends Component {
    public $noteTitle;
    public $noteBody;
    public $noteRecipient;
    public $noteSendDate;

    public function submit()
    {
        $validate = $this->validate([
            'noteTitle' => ['required' , 'string' , 'min:3'],
            'noteBody' => ['required' , 'string' , 'min:3'],
            'noteRecipient' => ['required' , 'email'],
            'noteSendDate' => ['required' , 'date'],
            ]);

        auth()->user()->notes()->create([
            'title' => $this->noteTitle,
            'body' => $this->noteBody,
            'recipient' => $this->noteRecipient,
            'send_date' => $this->noteSendDate,
            'is_published' => false,
        ]);

        redirect(route('notes.index'));
    }
};
?>

<div>
    <form wire:submit='submit' class="space-y-6">
        <x-input wire:model="noteTitle" label="Title" placeholder="Good Day to Die"/>
        <x-textarea wire:model="noteBody" label="Your Note" placeholder="Share your thoughts"/>
        <x-input icon="user" wire:model="noteRecipient" label="Recipient" placeholder="your email" type="email"/>
        <x-input icon="calendar" wire:model="noteSendDate" type="date" label="SendDate"/>

        <div class="pt-4 ">
            <x-primary-button wire:click="submit" spinner icon="calendar">Schedule Note</x-primary-button>
        </div>
        <x-errors/>
    </form>
</div>
