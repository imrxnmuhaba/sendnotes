@php use Illuminate\Support\Facades\Auth; @endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __(' Create a note') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8 space-y-4">

                <livewire:notes.create-note />

            <x-button href="{{route('notes.index')}}" class="mt-6" label=" Back to Notes" icon="arrow-left" outline hover="warning" focus:solid.gray />
        </div>
    </div>
</x-app-layout>
