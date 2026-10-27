<div id="loanModal" 
     class="fixed inset-0 z-50 bg-black/60 backdrop-blur-none hidden flex items-center justify-center p-3 sm:p-6 overflow-y-auto"
     role="dialog"
     aria-modal="true"
     aria-labelledby="modal-title">

    <div class="brutal-box bg-[#FDFCFA] w-full max-w-2xl p-5 sm:p-7 relative my-8" onclick="event.stopPropagation()">
        <!-- Header -->
        <div class="flex items-start justify-between pb-4 border-b-2 border-black/15">
            <div>
                <span class="font-mono-tag text-xs font-bold bg-[#FEF08A] px-2 py-0.5 border border-black rounded">
                    FORMULIR SERAH TERIMA FISIK
                </span>
                <h3 id="modal-title" class="text-xl sm:text-2xl font-display font-black text-zinc-950 mt-1">
                    Buat Surat Jalan Pinjam
                </h3>
                <p class="text-xs text-zinc-600 font-semibold mt-0.5">
                    Isi identitas peminjam dan pilih unit alat yang akan diambil dari loker studio.
                </p>
            </div>
            <button type="button" 
                    onclick="closeLoanModal()" 
                    class="brutal-button bg-white text-zinc-900 w-8 h-8 text-base font-black hover:bg-zinc-100"
                    aria-label="Tutup Formulir">
                ✕
            </button>
        </div>

        <!-- Form Body -->
        <form action="{{ route('gearflow.loans.store') }}" method="POST" class="mt-4 space-y-4">
            @csrf

            <!-- User Selector -->
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-zinc-800 mb-1">
                    Nama Peminjam Terdaftar *
                </label>
                <select name="user_id" required class="brutal-input w-full p-2.5 text-xs sm:text-sm bg-white font-medium">
                    <option value="" disabled selected>Pilih nama mahasiswa / staf produksi...</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">
                            {{ $user->name }} ({{ $user->department ?? 'Umum' }} - {{ $user->phone ?? 'No WA' }})
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Gear Checklist Multi-select -->
            <div>
                <div class="flex items-center justify-between mb-1.5">
                    <label class="block text-xs font-bold uppercase tracking-wider text-zinc-800">
                        Pilih Unit Alat yang Tersedia di Loker *
                    </label>
                    <span id="selectedCount" class="text-xs font-mono-tag font-bold text-zinc-600">0 unit dipilih</span>
                </div>

                @if($availableGears->isEmpty())
                    <div class="p-3 bg-rose-50 border border-rose-300 rounded text-xs font-semibold text-rose-800">
                        Tidak ada alat yang berstatus READY di loker saat ini. Semua unit sedang dipinjam atau dalam perbaikan.
                    </div>
                @else
                    <div class="max-h-44 overflow-y-auto border-2 border-black rounded-lg p-2.5 bg-white space-y-1.5 divide-y divide-zinc-100">
                        @foreach($availableGears as $gear)
                            <label class="flex items-center justify-between gap-2 p-1.5 rounded hover:bg-amber-50 cursor-pointer text-xs">
                                <div class="flex items-center gap-2.5">
                                    <input type="checkbox" 
                                           name="gear_ids[]" 
                                           value="{{ $gear->id }}" 
                                           id="gear_check_{{ $gear->id }}"
                                           onchange="updateSelectedCount()"
                                           class="w-4 h-4 rounded border-2 border-black accent-zinc-900 cursor-pointer">
                                    <div>
                                        <span class="font-mono-tag font-bold text-zinc-900">[{{ $gear->code }}]</span>
                                        <span class="font-bold text-zinc-800">{{ $gear->name }}</span>
                                    </div>
                                </div>
                                <span class="font-mono-tag text-[11px] text-zinc-500 bg-zinc-100 px-1.5 py-0.5 rounded border border-zinc-300">
                                    {{ $gear->location }}
                                </span>
                            </label>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Date Ranges -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-zinc-800 mb-1">
                        Tanggal Pengambilan *
                    </label>
                    <input type="date" 
                           name="borrow_date" 
                           value="{{ date('Y-m-d') }}" 
                           required 
                           class="brutal-input w-full p-2.5 text-xs sm:text-sm bg-white font-mono-tag">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-zinc-800 mb-1">
                        Batas Wajib Kembali *
                    </label>
                    <input type="date" 
                           name="due_date" 
                           value="{{ date('Y-m-d', strtotime('+2 days')) }}" 
                           required 
                           class="brutal-input w-full p-2.5 text-xs sm:text-sm bg-white font-mono-tag">
                </div>
            </div>

            <!-- Purpose -->
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-zinc-800 mb-1">
                    Tujuan Penggunaan & Lokasi Syuting/Event *
                </label>
                <textarea name="purpose" 
                          rows="2" 
                          required 
                          placeholder="Misal: Liputan acara wisuda di Aula Utama Gedung C..."
                          class="brutal-input w-full p-2.5 text-xs sm:text-sm bg-white font-medium"></textarea>
            </div>

            <!-- Footer Buttons -->
            <div class="pt-3 border-t-2 border-black/15 flex items-center justify-end gap-2.5">
                <button type="button" 
                        onclick="closeLoanModal()" 
                        class="brutal-button bg-zinc-200 text-zinc-800 text-xs sm:text-sm px-4 py-2">
                    Batal
                </button>
                <button type="submit" 
                        class="brutal-button bg-[#E11D48] text-white text-xs sm:text-sm px-5 py-2 hover:bg-[#BE123C]">
                    Terbitkan Surat Jalan ➔
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function openLoanModal() {
        const modal = document.getElementById('loanModal');
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeLoanModal() {
        const modal = document.getElementById('loanModal');
        modal.classList.add('hidden');
        document.body.style.overflow = '';
    }

    function pickGearForLoan(gearId) {
        openLoanModal();
        const checkbox = document.getElementById('gear_check_' + gearId);
        if (checkbox) {
            checkbox.checked = true;
            updateSelectedCount();
            checkbox.closest('label')?.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        }
    }

    function updateSelectedCount() {
        const checked = document.querySelectorAll('input[name="gear_ids[]"]:checked').length;
        const el = document.getElementById('selectedCount');
        if (el) {
            el.textContent = checked + ' unit dipilih';
        }
    }

    // Close on ESC key or backdrop click
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeLoanModal();
    });

    document.getElementById('loanModal')?.addEventListener('click', function(e) {
        if (e.target === this) closeLoanModal();
    });
</script>
