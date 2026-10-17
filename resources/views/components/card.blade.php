@props(['title', 'url', 'badge' => null])

<article {{ $attributes->merge(['class' => 'card']) }}>
    <h3><a href="{{ $url }}">{{ $title }}</a></h3>
    @if ($badge)
        <x-badge>{{ $badge }}</x-badge>
    @endif
    <div class="card-body">
        {{ $slot }}
    </div>
</article>