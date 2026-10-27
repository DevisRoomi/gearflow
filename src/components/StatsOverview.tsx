'use client';

interface StatsProps {
  totalGears: number;
  availableGears: number;
  activeLoans: number;
  pendingLoans: number;
}

export default function StatsOverview({
  totalGears,
  availableGears,
  activeLoans,
  pendingLoans,
}: StatsProps) {
  return (
    <section className="grid grid-cols-2 md:grid-cols-4 gap-4">
      <div className="brutal-card bg-[#FED7AA] p-5">
        <p className="text-xs font-black uppercase tracking-wider text-zinc-800">Total Alat Tercatat</p>
        <h3 className="text-4xl font-black mt-2 font-display">{totalGears}</h3>
        <span className="text-xs font-bold mt-2 inline-block text-zinc-700">Tercatat di katalog rak</span>
      </div>

      <div className="brutal-card bg-[#BBF7D0] p-5">
        <p className="text-xs font-black uppercase tracking-wider text-zinc-800">Siap Dipinjam</p>
        <h3 className="text-4xl font-black mt-2 font-display">{availableGears}</h3>
        <span className="text-xs font-bold mt-2 inline-block text-emerald-900">Ready di drybox/loker</span>
      </div>

      <div className="brutal-card bg-[#BAE6FD] p-5">
        <p className="text-xs font-black uppercase tracking-wider text-zinc-800">Sedang Dipinjam</p>
        <h3 className="text-4xl font-black mt-2 font-display">{activeLoans}</h3>
        <span className="text-xs font-bold mt-2 inline-block text-blue-900">Surat jalan aktif</span>
      </div>

      <div className="brutal-card bg-[#FDE047] p-5">
        <p className="text-xs font-black uppercase tracking-wider text-zinc-800">Menunggu Review</p>
        <h3 className="text-4xl font-black mt-2 font-display">{pendingLoans}</h3>
        <span className="text-xs font-bold mt-2 inline-block text-amber-950">Perlu cek fisik staf</span>
      </div>
    </section>
  );
}
