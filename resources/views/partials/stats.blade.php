<section class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4" aria-label="Ringkasan Ketersediaan Aset">
    <div class="brutal-interactive bg-[#FED7AA] p-4 flex flex-col justify-between min-h-[110px]">
        <div class="flex items-center justify-between">
            <span class="text-[11px] font-mono-tag font-bold uppercase tracking-wider text-zinc-800">01 // TOTAL ASET</span>
            <span class="text-xs font-mono-tag font-bold text-zinc-600">UNIT</span>
        </div>
        <div class="mt-2 flex items-baseline justify-between">
            <span class="text-3xl sm:text-4xl font-display font-black text-zinc-950">{{ $stats['total_gears'] }}</span>
            <span class="text-[11px] font-bold text-zinc-700">Tercatat di rak</span>
        </div>
    </div>

    <div class="brutal-interactive bg-[#BBF7D0] p-4 flex flex-col justify-between min-h-[110px]">
        <div class="flex items-center justify-between">
            <span class="text-[11px] font-mono-tag font-bold uppercase tracking-wider text-zinc-800">02 // SIAP DIPAKAI</span>
            <span class="text-xs font-mono-tag font-bold text-emerald-800">READY</span>
        </div>
        <div class="mt-2 flex items-baseline justify-between">
            <span class="text-3xl sm:text-4xl font-display font-black text-zinc-950">{{ $stats['available_gears'] }}</span>
            <span class="text-[11px] font-bold text-emerald-900">Di dalam loker</span>
        </div>
    </div>

    <div class="brutal-interactive bg-[#BAE6FD] p-4 flex flex-col justify-between min-h-[110px]">
        <div class="flex items-center justify-between">
            <span class="text-[11px] font-mono-tag font-bold uppercase tracking-wider text-zinc-800">03 // DI LAPANGAN</span>
            <span class="text-xs font-mono-tag font-bold text-blue-900">OUT</span>
        </div>
        <div class="mt-2 flex items-baseline justify-between">
            <span class="text-3xl sm:text-4xl font-display font-black text-zinc-950">{{ $stats['active_loans'] }}</span>
            <span class="text-[11px] font-bold text-blue-950">Sedang dipinjam</span>
        </div>
    </div>

    <div class="brutal-interactive bg-[#FEF08A] p-4 flex flex-col justify-between min-h-[110px]">
        <div class="flex items-center justify-between">
            <span class="text-[11px] font-mono-tag font-bold uppercase tracking-wider text-zinc-800">04 // VERIFIKASI</span>
            <span class="text-xs font-mono-tag font-bold text-amber-900">PENDING</span>
        </div>
        <div class="mt-2 flex items-baseline justify-between">
            <span class="text-3xl sm:text-4xl font-display font-black text-zinc-950">{{ $stats['pending_loans'] }}</span>
            <span class="text-[11px] font-bold text-amber-950">Menunggu review</span>
        </div>
    </div>
</section>
