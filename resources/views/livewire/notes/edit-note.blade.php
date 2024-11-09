<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use App\Models\Note;


new #[Layout('layouts.app')] class extends Component {

    public $noteTitle;
    public $noteBody;
    public $noteRecipient;
    public $noteSendDate;
    public $noteIsPublished;

    public Note $note;

    public function mount(Note $note)
    {
        $this->authorize('update', $note);
        $this->fill($note);
        $this->noteTitle = $note->title;
        $this->noteBody = $note->body;
        $this->noteRecipient = $note->recipient;
        $this->noteSendDate = $note->send_date;
        $this->noteIsPublished = $note->is_published;


    }

    public function saveNote()
    {
        $validate = $this->validate([
            'noteTitle' => ['required' , 'string' , 'min:3'],
            'noteBody' => ['required' , 'string' , 'min:3'],
            'noteRecipient' => ['required' , 'email'],
            'noteSendDate' => ['required' , 'date'],
        ]);

        $this->note->update([
            'title' => $this->noteTitle,
            'body'  => $this->noteBody,
            'recipient'  => $this->noteRecipient,
            'send_date'  => $this->noteSendDate,
            'is_published'  => $this->noteIsPublished,

            ]);

        $this->dispatch('note-saved');
    }
}


?>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Note') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8 space-y-4">
            <form class="space-y-4" wire:saveNote="saveNote">
                <x-input wire:model="noteTitle" label="Title" placeholder="Good Day to Die"/>
                <x-textarea wire:model="noteBody" label="Your Note" placeholder="Share your thoughts"/>
                <x-input icon="user" wire:model="noteRecipient" label="Recipient" placeholder="your email" type="email"/>
                <x-input icon="calendar" wire:model="noteSendDate" type="date" label="SendDate"/>
                <x-checkbox  class="mt-3" wire:model="noteIsPublished" label="Note is Published"/>
                <div class="flex justify-between pt-4  ">
                    <x-secondary-button  type="submit" spinner="saveNote">Save Note</x-secondary-button>
                    <x-button href="{{route('notes.index')}}" flat navigate>Back to Notes</x-button>
                </div>
                <x-action-message on="note-saved"/>
                <x-errors/>
            </form>
        </div>

        </div>
    </div>


















