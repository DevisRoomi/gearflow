'use client';

import { Loan, User, Gear, LoanStatus } from '../types';

interface LoanLogSectionProps {
  loans: Loan[];
  users: User[];
  gears: Gear[];
  onUpdateStatus: (loanId: number, nextStatus: LoanStatus) => void;
}

export default function LoanLogSection({
  loans,
  users,
  gears,
  onUpdateStatus,
}: LoanLogSectionProps) {
  const getUser = (userId: number) => users.find((u) => u.id === userId);

  return (
    <section className="brutal-box p-6 bg-white">
      <div className="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
        <div>
          <h2 className="text-2xl font-black tracking-tight font-display">
            📋 Buku Log Serah Terima & Surat Jalan
          </h2>
          <p className="text-xs sm:text-sm text-zinc-600 font-semibold mt-0.5">
            Monitoring fisik alat yang keluar, verifikasi tanda tangan peminjam, dan batas pengembalian.
          </p>
        </div>
      </div>

      <div className="overflow-x-auto">
        <table className="w-full text-left text-sm border-collapse">
          <thead>
            <tr className="border-b-4 border-black bg-[#FAF6EF]">
              <th className="p-3 font-black font-display text-xs sm:text-sm">NO. SURAT</th>
              <th className="p-3 font-black font-display text-xs sm:text-sm">PEMINJAM</th>
              <th className="p-3 font-black font-display text-xs sm:text-sm">ALAT DIPINJAM</th>
              <th className="p-3 font-black font-display text-xs sm:text-sm">JADWAL</th>
              <th className="p-3 font-black font-display text-xs sm:text-sm">STATUS</th>
              <th className="p-3 font-black font-display text-xs sm:text-sm text-right">AKSI VERIFIKASI</th>
            </tr>
          </thead>
          <tbody className="divide-y-2 divide-black/20 font-medium">
            {loans.length === 0 ? (
              <tr>
                <td colSpan={6} className="p-8 text-center text-zinc-500 font-bold">
                  Belum ada catatan surat jalan aktif.
                </td>
              </tr>
            ) : (
              loans.map((loan) => {
                const user = getUser(loan.userId);
                const borrowedGears = gears.filter((g) => loan.itemIds.includes(g.id));

                return (
                  <tr key={loan.id} className="hover:bg-amber-50/50 transition">
                    <td className="p-3 font-mono-code font-bold text-xs">
                      {loan.loanCode}
                    </td>

                    <td className="p-3">
                      <div className="font-bold text-zinc-900">{user?.name ?? 'Anonim'}</div>
                      <div className="text-xs text-zinc-500">{user?.department}</div>
                    </td>

                    <td className="p-3">
                      <div className="flex flex-wrap gap-1.5">
                        {borrowedGears.map((g) => (
                          <span
                            key={g.id}
                            className="brutal-badge bg-white px-2 py-0.5 text-xs font-mono-code"
                          >
                            <strong>{g.code}</strong>: {g.name}
                          </span>
                        ))}
                      </div>
                      <div className="text-xs italic text-zinc-600 mt-1">
                        &quot;{loan.purpose}&quot;
                      </div>
                    </td>

                    <td className="p-3 text-xs">
                      <div>
                        Pinjam:{' '}
                        <strong className="font-mono-code font-bold">{loan.borrowDate}</strong>
                      </div>
                      <div>
                        Kembali:{' '}
                        <strong className="font-mono-code font-bold text-rose-600">
                          {loan.dueDate}
                        </strong>
                      </div>
                    </td>

                    <td className="p-3">
                      {loan.status === 'pending' && (
                        <span className="brutal-badge bg-[#FDE047] text-zinc-900 text-xs px-2.5 py-1">
                          PENDING
                        </span>
                      )}
                      {loan.status === 'approved' && (
                        <span className="brutal-badge bg-[#BAE6FD] text-zinc-900 text-xs px-2.5 py-1">
                          APPROVED
                        </span>
                      )}
                      {loan.status === 'active' && (
                        <span className="brutal-badge bg-[#86EFAC] text-zinc-900 text-xs px-2.5 py-1">
                          ACTIVE HANDOVER
                        </span>
                      )}
                      {loan.status === 'returned' && (
                        <span className="brutal-badge bg-zinc-200 text-zinc-700 text-xs px-2.5 py-1">
                          RETURNED
                        </span>
                      )}
                      {loan.status === 'rejected' && (
                        <span className="brutal-badge bg-[#FDA4AF] text-zinc-900 text-xs px-2.5 py-1">
                          REJECTED
                        </span>
                      )}
                    </td>

                    <td className="p-3 text-right">
                      <div className="flex items-center justify-end gap-1.5">
                        {loan.status === 'pending' && (
                          <>
                            <button
                              onClick={() => onUpdateStatus(loan.id, 'active')}
                              className="brutal-btn bg-[#BBF7D0] text-xs px-2.5 py-1 font-bold"
                            >
                              Setujui & Serahkan
                            </button>
                            <button
                              onClick={() => onUpdateStatus(loan.id, 'rejected')}
                              className="brutal-btn bg-[#FDA4AF] text-xs px-2 py-1 font-bold"
                            >
                              Tolak
                            </button>
                          </>
                        )}
                        {loan.status === 'active' && (
                          <button
                            onClick={() => onUpdateStatus(loan.id, 'returned')}
                            className="brutal-btn bg-[#FEF08A] text-xs px-2.5 py-1 font-bold"
                          >
                            Konfirmasi Kembali (Cek Fisik)
                          </button>
                        )}
                        {(loan.status === 'returned' || loan.status === 'rejected') && (
                          <span className="text-xs text-zinc-400 font-bold">Arsip Selesai</span>
                        )}
                      </div>
                    </td>
                  </tr>
                );
              })
            )}
          </tbody>
        </table>
      </div>
    </section>
  );
}
