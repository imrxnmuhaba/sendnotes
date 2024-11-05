<?php

use App\Models\Note;
use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;

new class extends Component {

    public function delete($noteId)
    {
        $note = Note::where('id', $noteId)->first();
        $note->delete();
    }

    public function with(): array
    {
        return [
            'notes' => Auth::user()
                ->notes()
                ->orderby('send_date', 'asc')
                ->get(),
        ];
    }
}


?>

<div>
    <div class="space-y-2">
        @if($notes->isEmpty())
            <div class="text-center">
                <p class="text-xl font-bold">No Notes Yet</p>
                <p class="text-sm">Lets create your first Note to send.</p>
                <x-primary-button icon-right="plus" class="mt-6" href="{{route('notes.create')}}" wire:navigate>Create
                    note
                </x-primary-button>

            </div>
        @else
            <x-primary-button icon-right="plus" class="mb-6" href="{{route('notes.create')}}" wire:navigate>Create
                note
            </x-primary-button>
            <div class="grid grid-cols-2 gap-4">
                @foreach($notes as $note)
                    <x-card wire:key='{{ $note-> id }}'>
                        <div class="flex justify-between">
                            <div>
                                <a href="{{route('notes.edit-note', $note)}}" wire:navigate
                                   class="text-xl font-bold hover:underline hover:text-blue-500">
                                    {{$note->title}}
                                </a>
                                <p class="text-xs text-gray-500 mt-2">{{Str::limit($note->body, 30)}}</p>
                            </div>
                            <div class="text-xs text-gray-500">
                                {{\Carbon\Carbon::parse($note->send_date)->format('d-M-Y') }}
                            </div>
                        </div>
                        <div class="flex items-end justify-between mt-4 space-x-1">
                            <p class="text-xs">
                                Recipient: <span class="font-semibold">{{$note->recipient}}</span>
                            </p>
                            <div>

                                <x-button icon="eye"></x-button>
                                <x-button wire:click="delete('{{$note->id}}')" icon="trash"></x-button>

                            </div>
                        </div>
                    </x-card>
                @endforeach
            </div>
        @endif
    </div>

</div>
