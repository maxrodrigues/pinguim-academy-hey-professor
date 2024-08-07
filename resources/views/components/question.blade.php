@props([
    'question'
])

<div class="rounded-lg my-4 p-3 shadow-md flex justify-between items-center bg-white dark:bg-slate-800 dark:text-white dark:shadow-slate-700">
    <div>
        {{ $question->question }}
    </div>
    <div class="flex space-x-4">
        <div class="flex flex-col items-center text-green-600">
            <x-form :action="route('questions.like', $question)">
                <button type="submit">
                    <x-icons.thumbs-up class="w-5 h-5 hover:text-green-900 cursor-pointer" />
                </button>
            </x-form>
            <span>
                {{ $question->likes }}
            </span>
        </div>
        <div class="flex flex-col items-center text-red-600">
            <x-form :action="route('questions.unlike', $question)">
                <button type="submit">
                    <x-icons.thumbs-down class="w-5 h-5 text-red-600 hover:text-red-900 cursor-pointer" />
                </button>
            </x-form>
            <span>
                {{ $question->unlikes }}
            </span>
        </div>
    </div>
</div>
