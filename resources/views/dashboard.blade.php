<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <x-container>
        <div>
            <x-form post :action="route('questions.store')">
                <div class="mb-4">
                    <x-textarea label="Question" name="question"/>
                </div>
                <x-button.primary type="submit" label="Save" />
                <x-button.second type="reset" label="Cancel" />
            </x-form>
        </div>
    </x-container>
</x-app-layout>
