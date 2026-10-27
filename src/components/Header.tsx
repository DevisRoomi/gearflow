'use client';

interface HeaderProps {
  onOpenModal: () => void;
  availableCount: number;
}

export default function Header({ onOpenModal, availableCount }: HeaderProps) {
  return (
    <header className="max-w-7xl mx-auto mb-8">
      <div className="brutal-box p-4 sm:p-6 flex flex-wrap items-center justify-between gap-4">
        <div className="flex items-center gap-3.5">
          <div className="w-12 h-12 bg-[#FDE047] brutal-btn text-2xl flex items-center justify-center font-black">
            ⚡
          </div>
          <div>
            <div className="flex items-center gap-2">
              <span className="text-2xl sm:text-3xl font-black tracking-tight font-display">GearFlow</span>
              <span className="brutal-badge text-xs px-2.5 py-0.5 bg-[#BBF7D0]">Next.js 16 App Router</span>
            </div>
            <p className="text-xs sm:text-sm font-semibold text-zinc-600 mt-0.5">
              Buku Log Sirkulasi & Serah Terima Inventaris Fisik // Lab Multimedia Gedung B Lt. 2
            </p>
          </div>
        </div>

        <div className="flex items-center gap-3">
          <div className="brutal-badge bg-white px-3 py-1.5 text-xs flex items-center gap-2">
            <span className="w-2.5 h-2.5 rounded-full bg-emerald-500 border border-black animate-pulse"></span>
            <span className="font-mono-code font-bold text-zinc-800">{availableCount} Unit Ready Loker</span>
          </div>
          <button
            onClick={onOpenModal}
            className="brutal-btn bg-[#FDA4AF] text-zinc-900 px-4 py-2 text-sm font-black"
          >
            + Buat Surat Jalan
          </button>
        </div>
      </div>
    </header>
  );
}
