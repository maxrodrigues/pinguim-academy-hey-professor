<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Vote for a question') }}
        </h2>
    </x-slot>

    <x-container>
        <div>
            <div class="">
                @foreach($questions as $question)
                    <x-question :question="$question" />
                @endforeach
            </div>
        </div>
    </x-container>
</x-app-layout>
