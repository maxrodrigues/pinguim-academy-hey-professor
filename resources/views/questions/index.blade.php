<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My Questions') }}
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
        <hr class="border-gray-500 my-4"/>
        <div>
            <h1 class="text-3xl text-center dark:text-white">My Questions</h1>

            <div class="my-5">
                <span class="text-gray-400 font-semibold text-xl">
                    Draft Questions
                </span>
                <x-table>
                    <x-table.thead>
                        <tr>
                            <x-table.th>Question</x-table.th>
                            <x-table.th>Actions</x-table.th>
                        </tr>
                    </x-table.thead>
                    <tbody>
                    @foreach($questions->where('is_draft', true) as $question)
                        <x-table.tr>
                            <x-table.td>
                                {{ $question->question }}
                            </x-table.td>
                            <x-table.td>
                                {{--                                    deletar--}}
                                <x-form :action="route('questions.publish', $question)" put>
                                    <button type="submit">
                                        Publicar
                                    </button>
                                </x-form>
                            </x-table.td>
                        </x-table.tr>
                    @endforeach
                    </tbody>
                </x-table>
            </div>

            <div class="my-5">
                <span class="text-gray-400 font-semibold text-xl">
                    Published Questions
                </span>
                <x-table>
                    <x-table.thead>
                        <tr>
                            <x-table.th>Question</x-table.th>
                            <x-table.th>Actions</x-table.th>
                        </tr>
                    </x-table.thead>
                    <tbody>
                        @foreach($questions->where('is_draft', false) as $question)
                            <x-table.tr>
                                <x-table.td>
                                    {{ $question->question }}
                                </x-table.td>
                                <x-table.td>
                                    <x-form :action="route('questions.delete', $question)" delete>
                                        <button type="submit">
                                            Deletar
                                        </button>
                                    </x-form>
                                    <x-form :action="route('questions.publish', $question)" put>
                                        <button type="submit">
                                            Publicar
                                        </button>
                                    </x-form>
                                </x-table.td>
                            </x-table.tr>
                        @endforeach
                    </tbody>
                </x-table>
            </div>

        </div>
    </x-container>
</x-app-layout>
