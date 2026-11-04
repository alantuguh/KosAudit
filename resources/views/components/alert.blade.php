@if (session('success'))
    <div class="mb-space-md p-space-md rounded-xl bg-tertiary-fixed/40 border border-tertiary/20 text-tertiary flex items-center justify-between shadow-xs">
        <div class="flex items-center gap-space-sm">
            <span class="material-symbols-outlined text-[20px]">check_circle</span>
            <span class="font-label-md text-label-md font-semibold">{{ session('success') }}</span>
        </div>
        <button type="button" onclick="this.parentElement.remove()" class="text-tertiary hover:opacity-75">
            <span class="material-symbols-outlined text-[18px]">close</span>
        </button>
    </div>
@endif

@if (session('error'))
    <div class="mb-space-md p-space-md rounded-xl bg-error-container border border-error/20 text-error flex items-center justify-between shadow-xs">
        <div class="flex items-center gap-space-sm">
            <span class="material-symbols-outlined text-[20px]">error</span>
            <span class="font-label-md text-label-md font-semibold">{{ session('error') }}</span>
        </div>
        <button type="button" onclick="this.parentElement.remove()" class="text-error hover:opacity-75">
            <span class="material-symbols-outlined text-[18px]">close</span>
        </button>
    </div>
@endif

@if (session('warning'))
    <div class="mb-space-md p-space-md rounded-xl bg-secondary-fixed/50 border border-secondary/20 text-secondary flex items-center justify-between shadow-xs">
        <div class="flex items-center gap-space-sm">
            <span class="material-symbols-outlined text-[20px]">warning</span>
            <span class="font-label-md text-label-md font-semibold">{{ session('warning') }}</span>
        </div>
        <button type="button" onclick="this.parentElement.remove()" class="text-secondary hover:opacity-75">
            <span class="material-symbols-outlined text-[18px]">close</span>
        </button>
    </div>
@endif

@if ($errors->any())
    <div class="mb-space-md p-space-md rounded-xl bg-error-container/70 border border-error/20 text-error shadow-xs">
        <div class="flex items-center gap-space-sm font-label-md font-semibold mb-1">
            <span class="material-symbols-outlined text-[20px]">warning</span>
            <span>Terdapat kesalahan pada input formulir:</span>
        </div>
        <ul class="list-disc list-inside text-body-sm space-y-0.5 pl-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif