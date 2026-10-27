@if(session('success'))
    <div class="brutal-box bg-[#BBF7D0] p-4 text-xs sm:text-sm font-bold flex items-center justify-between gap-3" role="alert">
        <div class="flex items-center gap-2">
            <span class="text-base">✓</span>
            <span>{{ session('success') }}</span>
        </div>
        <button type="button" 
                onclick="this.closest('[role=alert]').remove()" 
                class="brutal-pill bg-white px-2.5 py-0.5 text-xs hover:bg-zinc-100">
            Tutup
        </button>
    </div>
@endif

@if($errors->any())
    <div class="brutal-box bg-[#FECDD3] p-4 text-xs sm:text-sm font-bold space-y-1.5" role="alert">
        <div class="flex items-center gap-2 text-rose-900">
            <span class="text-base">✕</span>
            <span>Periksa kembali input formulir:</span>
        </div>
        <ul class="list-disc pl-5 space-y-0.5 text-xs font-semibold text-rose-950">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
