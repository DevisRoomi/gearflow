'use client';

import { useState } from 'react';
import Header from '../components/Header';
import StatsOverview from '../components/StatsOverview';
import CatalogSection from '../components/CatalogSection';
import LoanLogSection from '../components/LoanLogSection';
import LoanModal from '../components/LoanModal';
import Footer from '../components/Footer';
import {
  INITIAL_CATEGORIES,
  INITIAL_GEARS,
  INITIAL_USERS,
  INITIAL_LOANS,
} from '../data/initialData';
import { Gear, Loan, LoanStatus } from '../types';

export default function GearFlowPage() {
  const [categories] = useState(INITIAL_CATEGORIES);
  const [users] = useState(INITIAL_USERS);
  const [gears, setGears] = useState<Gear[]>(INITIAL_GEARS);
  const [loans, setLoans] = useState<Loan[]>(INITIAL_LOANS);

  const [isModalOpen, setIsModalOpen] = useState(false);
  const [preselectedGearId, setPreselectedGearId] = useState<number | null>(null);
  const [flashMessage, setFlashMessage] = useState<string | null>(null);

  const availableGears = gears.filter((g) => g.status === 'available');

  const handleSelectGear = (gearId: number) => {
    setPreselectedGearId(gearId);
    setIsModalOpen(true);
  };

  const handleCreateLoan = ({
    userId,
    gearIds,
    borrowDate,
    dueDate,
    purpose,
  }: {
    userId: number;
    gearIds: number[];
    borrowDate: string;
    dueDate: string;
    purpose: string;
  }) => {
    const nextId = loans.length > 0 ? Math.max(...loans.map((l) => l.id)) + 1 : 1;
    const loanCode = `SURAT-2026-${String(nextId).padStart(3, '0')}`;

    const newLoan: Loan = {
      id: nextId,
      loanCode,
      userId,
      borrowDate,
      dueDate,
      returnedAt: null,
      purpose,
      status: 'pending',
      adminNotes: 'Pengajuan baru via formulir logbook digital. Menunggu serah terima fisik.',
      itemIds: gearIds,
    };

    setLoans((prev) => [newLoan, ...prev]);

    // Update gear status to borrowed
    setGears((prev) =>
      prev.map((g) => (gearIds.includes(g.id) ? { ...g, status: 'borrowed' } : g))
    );

    setFlashMessage(`Surat jalan ${loanCode} berhasil diterbitkan dan masuk antrean verifikasi.`);
    setTimeout(() => setFlashMessage(null), 5000);
  };

  const handleUpdateStatus = (loanId: number, nextStatus: LoanStatus) => {
    const targetLoan = loans.find((l) => l.id === loanId);
    if (!targetLoan) return;

    setLoans((prev) =>
      prev.map((l) =>
        l.id === loanId
          ? {
              ...l,
              status: nextStatus,
              returnedAt: nextStatus === 'returned' ? new Date().toISOString().slice(0, 10) : l.returnedAt,
            }
          : l
      )
    );

    // If returned or rejected, restore gear status to available
    if (nextStatus === 'returned' || nextStatus === 'rejected') {
      setGears((prev) =>
        prev.map((g) =>
          targetLoan.itemIds.includes(g.id) ? { ...g, status: 'available' } : g
        )
      );
    }

    const label =
      nextStatus === 'active'
        ? 'disetujui & serah terima fisik tercatat'
        : nextStatus === 'returned'
        ? 'selesai (alat kembali ke loker)'
        : 'ditolak';

    setFlashMessage(`Surat jalan ${targetLoan.loanCode} telah ${label}.`);
    setTimeout(() => setFlashMessage(null), 5000);
  };

  return (
    <div className="max-w-7xl mx-auto space-y-6">
      <Header
        onOpenModal={() => {
          setPreselectedGearId(null);
          setIsModalOpen(true);
        }}
        availableCount={availableGears.length}
      />

      {/* Flash Alert */}
      {flashMessage && (
        <div className="brutal-box bg-[#BBF7D0] p-4 font-bold flex items-center justify-between text-zinc-900 animate-in fade-in">
          <div className="flex items-center gap-2">
            <span>🎉</span>
            <span className="text-xs sm:text-sm">{flashMessage}</span>
          </div>
          <button
            onClick={() => setFlashMessage(null)}
            className="brutal-badge bg-white px-2 py-0.5 text-xs font-bold"
          >
            ✕
          </button>
        </div>
      )}

      {/* Stats Overview */}
      <StatsOverview
        totalGears={gears.length}
        availableGears={availableGears.length}
        activeLoans={loans.filter((l) => l.status === 'active').length}
        pendingLoans={loans.filter((l) => l.status === 'pending').length}
      />

      {/* Catalog & Lockers */}
      <CatalogSection
        gears={gears}
        categories={categories}
        onSelectGear={handleSelectGear}
      />

      {/* Physical Handover & Loan Log */}
      <LoanLogSection
        loans={loans}
        users={users}
        gears={gears}
        onUpdateStatus={handleUpdateStatus}
      />

      {/* Loan Slip Modal */}
      <LoanModal
        isOpen={isModalOpen}
        onClose={() => {
          setIsModalOpen(false);
          setPreselectedGearId(null);
        }}
        users={users}
        availableGears={availableGears}
        selectedGearId={preselectedGearId}
        onSubmitLoan={handleCreateLoan}
      />

      <Footer />
    </div>
  );
}
