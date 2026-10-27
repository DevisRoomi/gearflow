<section class="brutal-box p-4 sm:p-6" aria-labelledby="loans-heading">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 pb-4 border-b-2 border-black/15">
        <div>
            <h2 id="loans-heading" class="text-xl sm:text-2xl font-display font-black text-zinc-950">
                Log Sirkulasi & Serah Terima Surat Jalan
            </h2>
            <p class="text-xs sm:text-sm text-zinc-600 font-semibold mt-0.5">
                Monitoring alat yang sedang dipinjam mahasiswa, batas kembali, dan riwayat pengembalian.
            </p>
        </div>
    </div>

    <div class="overflow-x-auto mt-4">
        <table class="w-full text-left text-xs sm:text-sm border-collapse min-w-[700px]">
            <thead>
                <tr class="border-b-3 border-black bg-[#FAF6EE] text-zinc-900 font-display font-black">
                    <th class="py-3 px-3">NO. SURAT JALAN</th>
                    <th class="py-3 px-3">PEMINJAM</th>
                    <th class="py-3 px-3">DAFTAR ALAT</th>
                    <th class="py-3 px-3">JADWAL KEMBALI</th>
                    <th class="py-3 px-3">STATUS</th>
                    <th class="py-3 px-3 text-right">AKSI VERIFIKASI</th>
                </tr>
            </thead>
            <tbody class="divide-y-2 divide-black/15">
                @forelse($loans as $loan)
                    <tr class="hover:bg-amber-50/60 transition">
                        <!-- Surat Jalan Code -->
                        <td class="p-3 font-mono-tag font-bold text-xs text-zinc-900 align-top">
                            {{ $loan->loan_code }}
                        </td>

                        <!-- Peminjam Info -->
                        <td class="p-3 align-top">
                            <div class="font-bold text-zinc-900">{{ $loan->user->name }}</div>
                            <div class="text-[11px] text-zinc-600 font-semibold mt-0.5">
                                {{ $loan->user->department ?? 'Umum' }} • {{ $loan->user->phone ?? '-' }}
                            </div>
                        </td>

                        <!-- Items List -->
                        <td class="p-3 align-top">
                            <div class="flex flex-wrap gap-1.5">
                                @foreach($loan->items as $item)
                                    <span class="brutal-pill bg-white px-2 py-0.5 text-[11px] text-zinc-900">
                                        <strong class="font-mono-tag">{{ $item->gear->code }}</strong>
                                        <span class="text-zinc-600 truncate max-w-[120px]">{{ $item->gear->name }}</span>
                                    </span>
                                @endforeach
                            </div>
                            <div class="text-xs text-zinc-700 font-medium mt-1.5 italic">
                                “{{ $loan->purpose }}”
                            </div>
                        </td>

                        <!-- Schedule Dates -->
                        <td class="p-3 align-top text-xs font-medium">
                            <div>Pinjam: <strong class="font-mono-tag">{{ $loan->borrow_date->format('d M Y') }}</strong></div>
                            <div class="mt-0.5">
                                Tenggat: 
                                <strong class="font-mono-tag {{ $loan->due_date->isPast() && $loan->status === 'active' ? 'text-rose-700 bg-rose-100 px-1 rounded' : 'text-zinc-900' }}">
                                    {{ $loan->due_date->format('d M Y') }}
                                </strong>
                            </div>
                        </td>

                        <!-- Status Badge -->
                        <td class="p-3 align-top">
                            @if($loan->status === 'pending')
                                <span class="brutal-pill bg-[#FEF08A] text-zinc-900 text-[11px] px-2.5 py-0.5">MENUNGGU ACC</span>
                            @elseif($loan->status === 'approved')
                                <span class="brutal-pill bg-[#BAE6FD] text-zinc-900 text-[11px] px-2.5 py-0.5">DISETUJUI</span>
                            @elseif($loan->status === 'active')
                                <span class="brutal-pill bg-[#86EFAC] text-zinc-900 text-[11px] px-2.5 py-0.5">DI LAPANGAN</span>
                            @elseif($loan->status === 'returned')
                                <span class="brutal-pill bg-zinc-200 text-zinc-700 text-[11px] px-2.5 py-0.5">KEMBALI</span>
                            @elseif($loan->status === 'rejected')
                                <span class="brutal-pill bg-[#FDA4AF] text-zinc-900 text-[11px] px-2.5 py-0.5">DITOLAK</span>
                            @endif
                        </td>

                        <!-- Actions -->
                        <td class="p-3 align-top text-right">
                            <div class="flex items-center justify-end gap-1.5 flex-wrap">
                                @if($loan->status === 'pending')
                                    <form action="{{ route('gearflow.loans.status', $loan) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="status" value="active">
                                        <button type="submit" 
                                                class="brutal-button bg-[#BBF7D0] text-zinc-950 text-xs px-2.5 py-1">
                                            Serahkan Alat
                                        </button>
                                    </form>
                                    <form action="{{ route('gearflow.loans.status', $loan) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="status" value="rejected">
                                        <button type="submit" 
                                                class="brutal-button bg-[#FDA4AF] text-zinc-950 text-xs px-2 py-1">
                                            Tolak
                                        </button>
                                    </form>
                                @elseif($loan->status === 'active')
                                    <form action="{{ route('gearflow.loans.status', $loan) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="status" value="returned">
                                        <button type="submit" 
                                                class="brutal-button bg-[#FEF08A] text-zinc-950 text-xs px-2.5 py-1">
                                            Konfirmasi Kembali
                                        </button>
                                    </form>
                                @else
                                    <span class="text-xs font-mono-tag font-bold text-zinc-400">ARSIP</span>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="p-8 text-center text-zinc-600 font-bold">
                            Belum ada riwayat surat jalan peminjaman alat di sistem.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</section>
