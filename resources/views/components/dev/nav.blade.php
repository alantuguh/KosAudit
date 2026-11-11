@props(['active' => 'glass-lab'])

@php
$tabs = [
'glass-lab' => ['label' => 'Glass Lab', 'icon' => 'tune', 'href' => route('dev.ui-kit')],
'components' => ['label' => 'Component Preview', 'icon' => 'widgets', 'href' => route('dev.components')],
];
@endphp

<style>
    @@view-transition {
        navigation: auto;
    }

    .ui-tabs {
        view-transition-name: dev-tabs;
    }

    @media (prefers-reduced-motion: reduce) {

        ::view-transition-group(*),
        ::view-transition-old(*),
        ::view-transition-new(*) {
            animation: none !important;
        }
    }
</style>

<nav class="ui-tabs" aria-label="UI Playground">
    @foreach ($tabs as $key => $tab)
    <a href="{{ $tab['href'] }}" class="ui-tab" @if ($active===$key) aria-current="page" @endif>
        <span class="material-symbols-outlined" aria-hidden="true">{{ $tab['icon'] }}</span>
        {{ $tab['label'] }}
    </a>
    @endforeach
</nav>