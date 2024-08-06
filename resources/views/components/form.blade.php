@props([
    'action',
    'post' => null,
    'delete' => null,
    'put' => null,
])

<form class="mx-auto" action="{{ $action }}" method="post">
    @csrf
    @if($put)
        @method('PUT')
    @endif
    @if($delete)
        @method('DELETE')
    @endif

    {{ $slot }}
</form>
