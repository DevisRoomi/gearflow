<section class="brutal-box p-4 sm:p-6" aria-labelledby="catalog-heading">
    <!-- Header & Filter Bar -->
    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4 pb-5 border-b-2 border-black/15">
        <div>
            <h2 id="catalog-heading" class="text-xl sm:text-2xl font-display font-black text-zinc-950">
                Daftar Inventaris Rak Studio
            </h2>
            <p class="text-xs sm:text-sm text-zinc-600 font-semibold mt-0.5">
                Pilih alat berlabel HIJAU untuk diajukan ke formulir peminjaman.
            </p>
        </div>

        <!-- Filter & Search Form -->
        <form action="{{ route('gearflow.index') }}" method="GET" class="flex flex-wrap items-center gap-2">
            @if($selectedCategory)
                <input type="hidden" name="category" value="{{ $selectedCategory }}">
            @endif
            <div class="relative">
                <input type="text" 
                       name="search" 
                       value="{{ $search }}" 
                       placeholder="Cari kode / nama alat..." 
                       class="brutal-input text-xs sm:text-sm py-2 px-3 w-52 sm:w-64 bg-white"
                       aria-label="Pencarian alat">
            </div>
            <button type="submit" class="brutal-button bg-[#FACC15] text-zinc-950 text-xs sm:text-sm px-3.5 py-2">
                Cari
            </button>
            @if($search || $selectedCategory)
                <a href="{{ route('gearflow.index') }}" class="brutal-button bg-zinc-200 text-zinc-800 text-xs sm:text-sm px-3 py-2">
                    Reset
                </a>
            @endif
        </form>
    </div>

    <!-- Category Tabs -->
    <div class="flex items-center gap-2 overflow-x-auto py-4 scrollbar-none">
        <a href="{{ route('gearflow.index', array_filter(['search' => $search])) }}"
           class="brutal-pill text-xs px-3.5 py-1.5 transition shrink-0 {{ !$selectedCategory ? 'bg-zinc-950 text-white' : 'bg-white hover:bg-zinc-100 text-zinc-900' }}">
            Semua ({{ $stats['total_gears'] }})
        </a>
        @foreach($categories as $cat)
            <a href="{{ route('gearflow.index', array_filter(['category' => $cat->slug, 'search' => $search])) }}"
               class="brutal-pill text-xs px-3 py-1.5 transition shrink-0 text-zinc-900"
               style="background-color: {{ $selectedCategory === $cat->slug ? $cat->badge_color : '#FFFFFF' }};">
                {{ $cat->name }} ({{ $cat->gears_count }})
            </a>
        @endforeach
    </div>

    <!-- Gear Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-5 mt-2">
        @forelse($gears as $gear)
            <article class="brutal-interactive bg-white p-4 sm:p-5 flex flex-col justify-between" aria-label="{{ $gear->name }}">
                <div>
                    <!-- Top Bar: Asset Code & Status -->
                    <div class="flex items-center justify-between gap-2 mb-3">
                        <span class="font-mono-tag font-bold text-xs bg-zinc-100 px-2 py-0.5 border border-black rounded">
                            {{ $gear->code }}
                        </span>

                        @if($gear->status === 'available')
                            <span class="brutal-pill text-[11px] px-2.5 py-0.5 bg-[#86EFAC] text-zinc-950">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-800"></span> READY
                            </span>
                        @elseif($gear->status === 'borrowed')
                            <span class="brutal-pill text-[11px] px-2.5 py-0.5 bg-[#FDA4AF] text-zinc-950">
                                <span class="w-1.5 h-1.5 rounded-full bg-rose-800"></span> DIPINJAM
                            </span>
                        @else
                            <span class="brutal-pill text-[11px] px-2.5 py-0.5 bg-[#FDE047] text-zinc-950">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-800"></span> SERVIS
                            </span>
                        @endif
                    </div>

                    <!-- Title & Brand -->
                    <h3 class="font-display font-black text-lg text-zinc-950 leading-tight">
                        {{ $gear->name }}
                    </h3>
                    <p class="text-xs font-semibold text-zinc-500 mt-1">
                        Pabrikan: <span class="text-zinc-800 font-bold">{{ $gear->brand ?? 'Generic Studio' }}</span>
                    </p>

                    <!-- Spec & Location Sheet -->
                    <div class="mt-4 bg-[#FAF6EE] p-3 rounded-md border-2 border-black/80 space-y-1.5 text-xs">
                        <div class="flex justify-between">
                            <span class="text-zinc-600 font-medium">Kategori</span>
                            <span class="font-bold text-zinc-900">{{ $gear->category->name }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-zinc-600 font-medium">Lokasi Rak</span>
                            <span class="font-mono-tag font-bold text-zinc-900">{{ $gear->location }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-zinc-600 font-medium">Kondisi Fisik</span>
                            <span class="font-bold uppercase text-zinc-900">
                                {{ $gear->condition === 'good' ? 'Prima / Normal' : ($gear->condition === 'fair' ? 'Ada Lecet Pakai' : 'Perlu Cek Lab') }}
                            </span>
                        </div>
                    </div>

                    <!-- Notes / Accessories Included -->
                    @if($gear->notes)
                        <div class="mt-2.5 p-2 bg-[#FFFBEB] border border-amber-300 rounded text-xs text-amber-950 leading-relaxed">
                            <span class="font-bold">Paket Alat:</span> {{ $gear->notes }}
                        </div>
                    @endif
                </div>

                <!-- Footer Action -->
                <div class="mt-5 pt-3.5 border-t-2 border-black/10 flex items-center justify-between">
                    <span class="text-[11px] font-mono-tag text-zinc-500">TAG #{{ str_pad($gear->id, 3, '0', STR_PAD_LEFT) }}</span>

                    @if($gear->status === 'available')
                        <button type="button" 
                                onclick="pickGearForLoan({{ $gear->id }})" 
                                class="brutal-button bg-[#FACC15] text-zinc-950 text-xs px-3 py-1.5">
                            Pilih Alat Ini ➔
                        </button>
                    @else
                        <span class="text-xs font-bold text-zinc-400">Unit Tidak di Loker</span>
                    @endif
                </div>
            </article>
        @empty
            <div class="col-span-full py-12 text-center">
                <div class="inline-block p-6 brutal-box bg-[#FEF08A] max-w-md">
                    <h4 class="font-display font-black text-lg text-zinc-950">Tidak ada alat yang cocok</h4>
                    <p class="text-xs text-zinc-700 font-semibold mt-1">
                        Coba kata kunci lain atau pilih kategori "Semua" untuk melihat katalog rak.
                    </p>
                    <a href="{{ route('gearflow.index') }}" class="brutal-button bg-white text-xs px-4 py-1.5 mt-3">
                        Tampilkan Semua Alat
                    </a>
                </div>
            </div>
        @endforelse
    </div>
</section>
