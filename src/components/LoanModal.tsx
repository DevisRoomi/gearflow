'use client';

import { useState, useEffect } from 'react';
import { User, Gear } from '../types';

interface LoanModalProps {
  isOpen: boolean;
  onClose: () => void;
  users: User[];
  availableGears: Gear[];
  selectedGearId?: number | null;
  onSubmitLoan: (data: {
    userId: number;
    gearIds: number[];
    borrowDate: string;
    dueDate: string;
    purpose: string;
  }) => void;
}

export default function LoanModal({
  isOpen,
  onClose,
  users,
  availableGears,
  selectedGearId,
  onSubmitLoan,
}: LoanModalProps) {
  const [selectedUserId, setSelectedUserId] = useState<number>(users[0]?.id || 1);
  const [selectedGears, setSelectedGears] = useState<number[]>([]);
  const [borrowDate, setBorrowDate] = useState<string>('');
  const [dueDate, setDueDate] = useState<string>('');
  const [purpose, setPurpose] = useState<string>('');
  const [errorMsg, setErrorMsg] = useState<string>('');

  useEffect(() => {
    const today = new Date();
    const yyyy = today.getFullYear();
    const mm = String(today.getMonth() + 1).padStart(2, '0');
    const dd = String(today.getDate()).padStart(2, '0');
    setBorrowDate(`${yyyy}-${mm}-${dd}`);

    const next3Days = new Date(today);
    next3Days.setDate(today.getDate() + 3);
    const nYyyy = next3Days.getFullYear();
    const nMm = String(next3Days.getMonth() + 1).padStart(2, '0');
    const nDd = String(next3Days.getDate()).padStart(2, '0');
    setDueDate(`${nYyyy}-${nMm}-${nDd}`);
  }, []);

  useEffect(() => {
    if (selectedGearId) {
      setSelectedGears((prev) => (prev.includes(selectedGearId) ? prev : [...prev, selectedGearId]));
    }
  }, [selectedGearId]);

  useEffect(() => {
    const handleKeyDown = (e: KeyboardEvent) => {
      if (e.key === 'Escape') {
        onClose();
      }
    };
    if (isOpen) {
      window.addEventListener('keydown', handleKeyDown);
    }
    return () => window.removeEventListener('keydown', handleKeyDown);
  }, [isOpen, onClose]);

  if (!isOpen) return null;

  const toggleGear = (gearId: number) => {
    setSelectedGears((prev) =>
      prev.includes(gearId) ? prev.filter((id) => id !== gearId) : [...prev, gearId]
    );
  };

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    setErrorMsg('');

    if (selectedGears.length === 0) {
      setErrorMsg('Pilih minimal satu unit alat dari loker.');
      return;
    }

    if (!purpose.trim()) {
      setErrorMsg('Tuliskan tujuan peminjaman secara jelas.');
      return;
    }

    if (new Date(dueDate) < new Date(borrowDate)) {
      setErrorMsg('Tanggal pengembalian tidak boleh mendahului tanggal peminjaman.');
      return;
    }

    onSubmitLoan({
      userId: Number(selectedUserId),
      gearIds: selectedGears,
      borrowDate,
      dueDate,
      purpose,
    });

    setSelectedGears([]);
    setPurpose('');
    onClose();
  };

  return (
    <div
      role="dialog"
      aria-modal="true"
      className="fixed inset-0 bg-black/60 backdrop-blur-xs flex items-center justify-center p-4 z-50"
      onClick={onClose}
    >
      <div
        className="brutal-box max-w-lg w-full p-6 sm:p-8 max-h-[90vh] overflow-y-auto bg-[#FFFDF8]"
        onClick={(e) => e.stopPropagation()}
      >
        <div className="flex items-center justify-between pb-4 border-b-3 border-black mb-6">
          <div>
            <h3 className="text-2xl font-black font-display">
              📝 Formulir Surat Jalan Peminjaman
            </h3>
            <p className="text-xs font-semibold text-zinc-600 mt-0.5">
              Pencatatan serah terima fisik aset lab multimedia Gedung B Lt. 2.
            </p>
          </div>
          <button
            onClick={onClose}
            aria-label="Tutup formulir"
            className="brutal-btn bg-white px-2.5 py-1 text-sm font-bold"
          >
            ✕
          </button>
        </div>

        {errorMsg && (
          <div className="brutal-box bg-[#FDA4AF] p-3 text-xs font-bold text-zinc-900 mb-4">
            ⚠️ {errorMsg}
          </div>
        )}

        <form onSubmit={handleSubmit} className="space-y-4">
          <div>
            <label className="block text-xs font-black uppercase tracking-wider text-zinc-800 mb-1">
              Nama Peminjam / Kru
            </label>
            <select
              value={selectedUserId}
              onChange={(e) => setSelectedUserId(Number(e.target.value))}
              required
              className="brutal-input w-full p-2.5 text-sm font-semibold text-zinc-900"
            >
              {users.map((u) => (
                <option key={u.id} value={u.id}>
                  {u.name} — ({u.department})
                </option>
              ))}
            </select>
          </div>

          <div>
            <label className="block text-xs font-black uppercase tracking-wider text-zinc-800 mb-1">
              Pilih Unit Alat (Bisa Multi-Pilih)
            </label>
            <div className="border-3 border-black rounded-lg p-3 max-h-40 overflow-y-auto space-y-2 bg-white">
              {availableGears.length === 0 ? (
                <p className="text-xs font-bold text-rose-600">
                  Semua unit saat ini sedang keluar dipinjam atau di-maintenance.
                </p>
              ) : (
                availableGears.map((item) => (
                  <label
                    key={item.id}
                    className="flex items-center gap-2.5 text-xs font-bold cursor-pointer hover:bg-zinc-50 p-1 rounded"
                  >
                    <input
                      type="checkbox"
                      checked={selectedGears.includes(item.id)}
                      onChange={() => toggleGear(item.id)}
                      className="w-4 h-4 accent-black"
                    />
                    <span>
                      <strong className="font-mono-code">{item.code}</strong> — {item.name}{' '}
                      <span className="text-zinc-500 font-normal">({item.location})</span>
                    </span>
                  </label>
                ))
              )}
            </div>
          </div>

          <div className="grid grid-cols-2 gap-3">
            <div>
              <label className="block text-xs font-black uppercase tracking-wider text-zinc-800 mb-1">
                Tgl Mulai Pinjam
              </label>
              <input
                type="date"
                value={borrowDate}
                onChange={(e) => setBorrowDate(e.target.value)}
                required
                className="brutal-input w-full p-2 text-xs font-semibold"
              />
            </div>
            <div>
              <label className="block text-xs font-black uppercase tracking-wider text-zinc-800 mb-1">
                Tgl Kembali
              </label>
              <input
                type="date"
                value={dueDate}
                onChange={(e) => setDueDate(e.target.value)}
                required
                className="brutal-input w-full p-2 text-xs font-semibold"
              />
            </div>
          </div>

          <div>
            <label className="block text-xs font-black uppercase tracking-wider text-zinc-800 mb-1">
              Tujuan / Lokasi Liputan
            </label>
            <textarea
              rows={2}
              value={purpose}
              onChange={(e) => setPurpose(e.target.value)}
              placeholder="Contoh: Produksi video profil kampus & fotografi studio podcast"
              required
              className="brutal-input w-full p-2.5 text-sm font-semibold"
            ></textarea>
          </div>

          <div className="pt-4 flex items-center justify-end gap-3 border-t-2 border-black/10">
            <button
              type="button"
              onClick={onClose}
              className="brutal-btn bg-white px-4 py-2 text-sm font-bold"
            >
              Batal
            </button>
            <button
              type="submit"
              disabled={availableGears.length === 0}
              className="brutal-btn bg-[#BBF7D0] px-5 py-2 text-sm text-zinc-900 font-black disabled:opacity-50"
            >
              Terbitkan Surat Jalan ➔
            </button>
          </div>
        </form>
      </div>
    </div>
  );
}
