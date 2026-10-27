<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GearFlow // Modern Soft Brutalism Studio Lending</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;700;800&family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #FAF6EF;
            color: #121316;
        }
        h1, h2, h3, .brutal-font {
            font-family: 'Space Grotesk', sans-serif;
        }
        .brutal-card {
            border: 3px solid #18181B;
            box-shadow: 5px 5px 0px #18181B;
            border-radius: 14px;
            transition: all 0.15s ease-in-out;
        }
        .brutal-card:hover {
            box-shadow: 7px 7px 0px #18181B;
            transform: translate(-2px, -2px);
        }
        .brutal-static {
            border: 3px solid #18181B;
            box-shadow: 5px 5px 0px #18181B;
            border-radius: 14px;
        }
        .brutal-btn {
            border: 3px solid #18181B;
            box-shadow: 4px 4px 0px #18181B;
            border-radius: 10px;
            font-weight: 700;
            transition: all 0.1s ease-in-out;
        }
        .brutal-btn:hover {
            transform: translate(-2px, -2px);
            box-shadow: 6px 6px 0px #18181B;
        }
        .brutal-btn:active {
            transform: translate(2px, 2px);
            box-shadow: 1px 1px 0px #18181B;
        }
        .brutal-badge {
            border: 2px solid #18181B;
            box-shadow: 2px 2px 0px #18181B;
            border-radius: 9999px;
            font-weight: 700;
        }
        .brutal-input {
            border: 3px solid #18181B;
            box-shadow: 3px 3px 0px #18181B;
            border-radius: 10px;
            background-color: #FFFFFF;
            outline: none;
        }
        .brutal-input:focus {
            box-shadow: 5px 5px 0px #18181B;
            background-color: #FFFDF8;
        }
    </style>
</head>
<body class="min-h-screen p-4 sm:p-8">

    <!-- Top Navigation Bar -->
    <header class="max-w-7xl mx-auto mb-8">
        <div class="brutal-static bg-white p-4 sm:p-6 flex flex-wrap items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 bg-[#FDE047] brutal-btn flex items-center justify-center text-2xl font-black">
                    ⚡
                </div>
                <div>
                    <div class="flex items-center gap-2">
                        <span class="text-2xl sm:text-3xl font-black tracking-tight brutal-font">GearFlow</span>
                        <span class="brutal-badge text-xs px-2.5 py-0.5 bg-[#BBF7D0]">v1.0 BETA</span>
                    </div>
                    <p class="text-xs sm:text-sm font-semibold text-zinc-600">Sistem Peminjaman & Tracking Alat Multimedia / Lab</p>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <div class="brutal-badge bg-[#E0E7FF] px-3 py-1.5 text-xs flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 border border-black animate-pulse"></span>
                    <span class="font-bold">FlyEnv MySQL Online</span>
                </div>
                <a href="#loan-modal" onclick="document.getElementById('loan-modal').classList.remove('hidden')" class="brutal-btn bg-[#F43F5E] text-white px-4 py-2 text-sm">
                    + Pinjam Gear
                </a>
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto space-y-8">
        <!-- Flash Alert -->
        @if(session('success'))
            <div class="brutal-static bg-[#86EFAC] p-4 font-bold flex items-center justify-between">
                <span>🎉 {{ session('success') }}</span>
                <button onclick="this.parentElement.remove()" class="brutal-badge bg-white px-2 py-0.5 text-xs">✕ Tutup</button>
            </div>
        @endif

        @if($errors->any())
            <div class="brutal-static bg-[#FCA5A5] p-4 font-bold">
                <p>⚠️ Terjadi kesalahan validasi:</p>
                <ul class="list-disc pl-5 text-sm font-medium mt-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Stats Overview Cards -->
        <section class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="brutal-card bg-[#FED7AA] p-5">
                <p class="text-xs font-black uppercase tracking-wider text-zinc-700">Total Gear Unit</p>
                <h3 class="text-4xl font-black mt-2 brutal-font">{{ $stats['total_gears'] }}</h3>
                <span class="text-xs font-bold mt-2 inline-block text-zinc-600">Tercatat di katalog</span>
            </div>

            <div class="brutal-card bg-[#BBF7D0] p-5">
                <p class="text-xs font-black uppercase tracking-wider text-zinc-700">Siap Dipinjam</p>
                <h3 class="text-4xl font-black mt-2 brutal-font">{{ $stats['available_gears'] }}</h3>
                <span class="text-xs font-bold mt-2 inline-block text-emerald-800">Ready di locker</span>
            </div>

            <div class="brutal-card bg-[#BAE6FD] p-5">
                <p class="text-xs font-black uppercase tracking-wider text-zinc-700">Sedang Dipinjam</p>
                <h3 class="text-4xl font-black mt-2 brutal-font">{{ $stats['active_loans'] }}</h3>
                <span class="text-xs font-bold mt-2 inline-block text-blue-900">Active handover</span>
            </div>

            <div class="brutal-card bg-[#FDE047] p-5">
                <p class="text-xs font-black uppercase tracking-wider text-zinc-700">Menunggu Approval</p>
                <h3 class="text-4xl font-black mt-2 brutal-font">{{ $stats['pending_loans'] }}</h3>
                <span class="text-xs font-bold mt-2 inline-block text-amber-900">Perlu review staf</span>
            </div>
        </section>

        <!-- Catalog Header & Filters -->
        <section class="brutal-static bg-white p-6">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
                <div>
                    <h2 class="text-2xl font-black tracking-tight brutal-font">📦 Katalog Alat & Inventaris</h2>
                    <p class="text-sm text-zinc-600 font-medium">Periksa status ketersediaan alat sebelum mengajukan form peminjaman.</p>
                </div>

                <!-- Search & Filter Form -->
                <form action="{{ route('gearflow.index') }}" method="GET" class="flex flex-wrap items-center gap-2">
                    <input type="text" name="search" value="{{ $search }}" placeholder="Cari nama, kode, brand..." class="brutal-input px-3 py-2 text-sm w-56">
                    @if($selectedCategory)
                        <input type="hidden" name="category" value="{{ $selectedCategory }}">
                    @endif
                    <button type="submit" class="brutal-btn bg-[#FDE047] px-4 py-2 text-sm">Cari</button>
                    @if($search || $selectedCategory)
                        <a href="{{ route('gearflow.index') }}" class="brutal-btn bg-zinc-200 px-3 py-2 text-sm">Reset</a>
                    @endif
                </form>
            </div>

            <!-- Category Pills -->
            <div class="flex flex-wrap gap-2 mb-6">
                <a href="{{ route('gearflow.index', array_filter(['search' => $search])) }}" 
                   class="brutal-badge px-3 py-1.5 text-xs transition {{ !$selectedCategory ? 'bg-[#18181B] text-white' : 'bg-white hover:bg-zinc-100' }}">
                   Semua Kategori ({{ $stats['total_gears'] }})
                </a>
                @foreach($categories as $cat)
                    <a href="{{ route('gearflow.index', array_filter(['category' => $cat->slug, 'search' => $search])) }}"
                       class="brutal-badge px-3 py-1.5 text-xs transition"
                       style="background-color: {{ $selectedCategory === $cat->slug ? $cat->badge_color : '#FFFFFF' }};">
                       {{ $cat->name }} ({{ $cat->gears_count }})
                    </a>
                @endforeach
            </div>

            <!-- Gear Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                @forelse($gears as $gear)
                    <div class="brutal-card bg-white p-5 flex flex-col justify-between">
                        <div>
                            <div class="flex items-start justify-between gap-2 mb-3">
                                <span class="brutal-badge text-xs px-2.5 py-1 font-mono uppercase bg-zinc-100">
                                    {{ $gear->code }}
                                </span>
                                @if($gear->status === 'available')
                                    <span class="brutal-badge text-xs px-2.5 py-1 bg-[#86EFAC] text-zinc-900">READY</span>
                                @elseif($gear->status === 'borrowed')
                                    <span class="brutal-badge text-xs px-2.5 py-1 bg-[#FDA4AF] text-zinc-900">DIPINJAM</span>
                                @else
                                    <span class="brutal-badge text-xs px-2.5 py-1 bg-[#FDE047] text-zinc-900">MAINTENANCE</span>
                                @endif
                            </div>

                            <h3 class="text-lg font-black tracking-tight leading-snug">{{ $gear->name }}</h3>
                            <p class="text-xs font-bold text-zinc-500 mt-0.5">Brand: {{ $gear->brand ?? '-' }}</p>

                            <div class="mt-4 space-y-1.5 text-xs font-medium text-zinc-700 bg-[#FAF6EF] p-3 rounded-lg border-2 border-black">
                                <div class="flex justify-between">
                                    <span class="text-zinc-500">Kategori:</span>
                                    <span class="font-bold">{{ $gear->category->name }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-zinc-500">Lokasi Rak:</span>
                                    <span class="font-bold font-mono">{{ $gear->location }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-zinc-500">Kondisi:</span>
                                    <span class="font-bold uppercase">{{ $gear->condition }}</span>
                                </div>
                            </div>

                            @if($gear->notes)
                                <p class="text-xs italic text-zinc-600 mt-2 bg-amber-50 p-2 border border-black/30 rounded">
                                    📌 {{ $gear->notes }}
                                </p>
                            @endif
                        </div>

                        <div class="mt-5 pt-3 border-t-2 border-black/10 flex items-center justify-between">
                            <span class="text-xs font-mono font-bold text-zinc-500">ID #{{ $gear->id }}</span>
                            @if($gear->status === 'available')
                                <button onclick="quickPinjam({{ $gear->id }}, '{{ addslashes($gear->name) }}')" class="brutal-btn bg-[#FDE047] text-xs px-3 py-1.5">
                                    Pilih Alat Ini ➔
                                </button>
                            @else
                                <span class="text-xs font-bold text-zinc-400">Tidak Tersedia</span>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-12 text-center">
                        <div class="inline-block p-4 brutal-static bg-[#FEF08A] text-lg font-black">
                            🔍 Tidak ada alat yang cocok dengan pencarian / filter ini.
                        </div>
                    </div>
                @endforelse
            </div>
        </section>

        <!-- Loan Log & Management -->
        <section class="brutal-static bg-white p-6">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
                <div>
                    <h2 class="text-2xl font-black tracking-tight brutal-font">📋 Log Transaksi Peminjaman</h2>
                    <p class="text-sm text-zinc-600 font-medium">Monitoring approval staf, masa tenggat kembali, dan serah terima alat.</p>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm border-collapse">
                    <thead>
                        <tr class="border-b-4 border-black bg-[#FAF6EF]">
                            <th class="p-3 font-black brutal-font">KODE</th>
                            <th class="p-3 font-black brutal-font">PEMINJAM</th>
                            <th class="p-3 font-black brutal-font">ALAT DIPINJAM</th>
                            <th class="p-3 font-black brutal-font">PERIODE</th>
                            <th class="p-3 font-black brutal-font">STATUS</th>
                            <th class="p-3 font-black brutal-font text-right">AKSI CEPAT</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y-2 divide-black/20 font-medium">
                        @forelse($loans as $loan)
                            <tr class="hover:bg-amber-50/50 transition">
                                <td class="p-3 font-mono font-bold text-xs">{{ $loan->loan_code }}</td>
                                <td class="p-3">
                                    <div class="font-bold">{{ $loan->user->name }}</div>
                                    <div class="text-xs text-zinc-500">{{ $loan->user->department ?? 'Umum' }}</div>
                                </td>
                                <td class="p-3">
                                    <div class="space-y-1">
                                        @foreach($loan->items as $item)
                                            <div class="inline-block brutal-badge bg-white px-2 py-0.5 text-xs mr-1">
                                                <span class="font-mono font-bold">{{ $item->gear->code }}</span> - {{ $item->gear->name }}
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="text-xs italic text-zinc-600 mt-1">"{{ $loan->purpose }}"</div>
                                </td>
                                <td class="p-3 text-xs">
                                    <div>Pinjam: <strong class="font-mono">{{ $loan->borrow_date->format('d M Y') }}</strong></div>
                                    <div>Kembali: <strong class="font-mono text-rose-600">{{ $loan->due_date->format('d M Y') }}</strong></div>
                                </td>
                                <td class="p-3">
                                    @if($loan->status === 'pending')
                                        <span class="brutal-badge bg-[#FDE047] text-zinc-900 text-xs px-2.5 py-1">PENDING</span>
                                    @elseif($loan->status === 'approved')
                                        <span class="brutal-badge bg-[#BAE6FD] text-zinc-900 text-xs px-2.5 py-1">APPROVED</span>
                                    @elseif($loan->status === 'active')
                                        <span class="brutal-badge bg-[#86EFAC] text-zinc-900 text-xs px-2.5 py-1">ACTIVE</span>
                                    @elseif($loan->status === 'returned')
                                        <span class="brutal-badge bg-zinc-200 text-zinc-700 text-xs px-2.5 py-1">RETURNED</span>
                                    @elseif($loan->status === 'rejected')
                                        <span class="brutal-badge bg-[#FDA4AF] text-zinc-900 text-xs px-2.5 py-1">REJECTED</span>
                                    @endif
                                </td>
                                <td class="p-3 text-right">
                                    <div class="flex items-center justify-end gap-1.5">
                                        @if($loan->status === 'pending')
                                            <form action="{{ route('gearflow.loans.status', $loan) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="status" value="active">
                                                <button type="submit" class="brutal-btn bg-[#BBF7D0] text-xs px-2.5 py-1">Setujui & Serahkan</button>
                                            </form>
                                            <form action="{{ route('gearflow.loans.status', $loan) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="status" value="rejected">
                                                <button type="submit" class="brutal-btn bg-[#FDA4AF] text-xs px-2 py-1">Tolak</button>
                                            </form>
                                        @elseif($loan->status === 'active')
                                            <form action="{{ route('gearflow.loans.status', $loan) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="status" value="returned">
                                                <button type="submit" class="brutal-btn bg-[#FEF08A] text-xs px-2.5 py-1">Konfirmasi Kembali</button>
                                            </form>
                                        @else
                                            <span class="text-xs text-zinc-400 font-bold">Selesai</span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="p-6 text-center text-zinc-500 font-bold">Belum ada transaksi peminjaman.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </main>

    <!-- Modal Form Pinjam Gear -->
    <div id="loan-modal" class="fixed inset-0 bg-black/60 backdrop-blur-xs flex items-center justify-center p-4 z-50 hidden">
        <div class="brutal-static bg-[#FFFDF8] max-w-lg w-full p-6 sm:p-8 max-h-[90vh] overflow-y-auto">
            <div class="flex items-center justify-between pb-4 border-b-3 border-black mb-6">
                <div>
                    <h3 class="text-2xl font-black brutal-font">📝 Form Pengajuan Peminjaman</h3>
                    <p class="text-xs text-zinc-600 font-semibold">Pilih peminjam, alat yang dibutuhkan, dan jadwal durasi.</p>
                </div>
                <button onclick="document.getElementById('loan-modal').classList.add('hidden')" class="brutal-btn bg-white px-2.5 py-1 text-sm">✕</button>
            </div>

            <form action="{{ route('gearflow.loans.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-black uppercase text-zinc-700 mb-1">Nama Peminjam</label>
                    <select name="user_id" required class="brutal-input w-full p-2.5 text-sm font-semibold">
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->department ?? $user->role }})</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-black uppercase text-zinc-700 mb-1">Pilih Alat (Bisa Multi-Pilih)</label>
                    <div class="border-3 border-black rounded-lg p-3 max-h-40 overflow-y-auto space-y-2 bg-white">
                        @forelse($availableGears as $item)
                            <label class="flex items-center gap-2 text-xs font-bold cursor-pointer hover:bg-zinc-50 p-1 rounded">
                                <input type="checkbox" name="gear_ids[]" value="{{ $item->id }}" class="w-4 h-4 accent-black gear-checkbox" id="gear-chk-{{ $item->id }}">
                                <span><strong class="font-mono">{{ $item->code }}</strong> — {{ $item->name }} ({{ $item->category->name }})</span>
                            </label>
                        @empty
                            <p class="text-xs font-bold text-rose-500">Tidak ada alat yang saat ini berstatus 'available'.</p>
                        @endforelse
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-black uppercase text-zinc-700 mb-1">Tgl Mulai Pinjam</label>
                        <input type="date" name="borrow_date" value="{{ date('Y-m-d') }}" required class="brutal-input w-full p-2 text-xs font-semibold">
                    </div>
                    <div>
                        <label class="block text-xs font-black uppercase text-zinc-700 mb-1">Tgl Kembali</label>
                        <input type="date" name="due_date" value="{{ date('Y-m-d', strtotime('+3 days')) }}" required class="brutal-input w-full p-2 text-xs font-semibold">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-black uppercase text-zinc-700 mb-1">Tujuan / Keperluan Pinjam</label>
                    <textarea name="purpose" rows="2" required placeholder="Contoh: Produksi video profil kampus & fotografi studio" class="brutal-input w-full p-2.5 text-sm"></textarea>
                </div>

                <div class="pt-4 flex items-center justify-end gap-3 border-t-2 border-black/10">
                    <button type="button" onclick="document.getElementById('loan-modal').classList.add('hidden')" class="brutal-btn bg-white px-4 py-2 text-sm">Batal</button>
                    <button type="submit" class="brutal-btn bg-[#BBF7D0] px-5 py-2 text-sm text-zinc-900 font-black">Kirim Pengajuan ➔</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <footer class="max-w-7xl mx-auto mt-12 text-center text-xs font-bold text-zinc-500 pb-8">
        <p>GearFlow — Crafted in Modern Soft Brutalism for Laravel Herd & FlyEnv MySQL.</p>
    </footer>

    <script>
        function quickPinjam(gearId, gearName) {
            const modal = document.getElementById('loan-modal');
            modal.classList.remove('hidden');
            const chk = document.getElementById('gear-chk-' + gearId);
            if (chk) {
                chk.checked = true;
            }
        }
    </script>
</body>
</html>
