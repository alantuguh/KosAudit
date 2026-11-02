@props(['id', 'title'])

<div id="{{ $id }}" class="hidden fixed inset-0 z-50 bg-inverse-surface/50 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-surface-container-lowest rounded-2xl shadow-xl w-full max-w-lg overflow-hidden">
        <div class="px-space-lg py-space-md bg-surface-container-low flex items-center justify-between">
            <h3 class="font-headline-sm text-headline-sm text-on-surface font-bold">{{ $title }}</h3>
            <button type="button"
                    onclick="document.getElementById('{{ $id }}').classList.add('hidden')"
                    class="w-8 h-8 rounded-lg text-outline hover:text-on-surface hover:bg-surface-container flex items-center justify-center transition-colors">
                <span class="material-symbols-outlined text-[20px]">close</span>
            </button>
        </div>
        <div class="p-space-lg">
            {{ $slot }}
        </div>
    </div>
</div>