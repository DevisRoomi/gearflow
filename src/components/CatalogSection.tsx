'use client';

import { useState, useMemo } from 'react';
import { Gear, Category } from '../types';

interface CatalogSectionProps {
  gears: Gear[];
  categories: Category[];
  onSelectGear: (gearId: number) => void;
}

export default function CatalogSection({
  gears,
  categories,
  onSelectGear,
}: CatalogSectionProps) {
  const [selectedCategory, setSelectedCategory] = useState<number | null>(null);
  const [searchQuery, setSearchQuery] = useState('');

  const filteredGears = useMemo(() => {
    return gears.filter((gear) => {
      const matchCat = selectedCategory === null || gear.categoryId === selectedCategory;
      const q = searchQuery.toLowerCase().trim();
      const matchSearch =
        !q ||
        gear.name.toLowerCase().includes(q) ||
        gear.code.toLowerCase().includes(q) ||
        gear.brand.toLowerCase().includes(q) ||
        gear.location.toLowerCase().includes(q);
      return matchCat && matchSearch;
    });
  }, [gears, selectedCategory, searchQuery]);

  return (
    <section className="brutal-box p-6 bg-white">
      <div className="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
        <div>
          <h2 className="text-2xl font-black tracking-tight font-display">
            📦 Rak & Lemari Inventaris Fisik
          </h2>
          <p className="text-xs sm:text-sm text-zinc-600 font-semibold mt-0.5">
            Periksa ketersediaan unit di loker atau drybox sebelum mengajukan surat jalan.
          </p>
        </div>

        <div className="flex items-center gap-2">
          <input
            type="text"
            value={searchQuery}
            onChange={(e) => setSearchQuery(e.target.value)}
            placeholder="Cari kode seri, nama alat, loker..."
            className="brutal-input px-3.5 py-2 text-sm w-64 font-semibold"
          />
          {searchQuery && (
            <button
              onClick={() => setSearchQuery('')}
              className="brutal-btn bg-zinc-200 px-3 py-2 text-xs"
            >
              Reset
            </button>
          )}
        </div>
      </div>

      {/* Category Pills */}
      <div className="flex flex-wrap gap-2 mb-6">
        <button
          onClick={() => setSelectedCategory(null)}
          className={`brutal-badge px-3.5 py-1.5 text-xs transition cursor-pointer ${
            selectedCategory === null
              ? 'bg-[#141416] text-white shadow-none'
              : 'bg-white hover:bg-zinc-100 text-zinc-800'
          }`}
        >
          Semua Kategori ({gears.length})
        </button>
        {categories.map((cat) => {
          const count = gears.filter((g) => g.categoryId === cat.id).length;
          const isSelected = selectedCategory === cat.id;
          return (
            <button
              key={cat.id}
              onClick={() => setSelectedCategory(isSelected ? null : cat.id)}
              className="brutal-badge px-3.5 py-1.5 text-xs transition cursor-pointer text-zinc-900"
              style={{
                backgroundColor: isSelected ? cat.badgeColor : '#FFFFFF',
                boxShadow: isSelected ? '4px 4px 0px #141416' : '2px 2px 0px #141416',
                transform: isSelected ? 'translate(-1px, -1px)' : 'none',
              }}
            >
              {cat.name} ({count})
            </button>
          );
        })}
      </div>

      {/* Grid */}
      <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
        {filteredGears.length === 0 ? (
          <div className="col-span-full py-12 text-center">
            <div className="inline-block p-4 brutal-box bg-[#FEF08A] text-sm font-black">
              🔍 Tidak ada alat yang cocok dengan filter atau kata kunci pencarian.
            </div>
          </div>
        ) : (
          filteredGears.map((gear) => {
            const category = categories.find((c) => c.id === gear.categoryId);
            const isAvailable = gear.status === 'available';

            return (
              <div key={gear.id} className="brutal-card p-5 flex flex-col justify-between">
                <div>
                  <div className="flex items-start justify-between gap-2 mb-3">
                    <span className="brutal-badge text-xs px-2.5 py-0.5 font-mono-code uppercase bg-zinc-100 text-zinc-900">
                      {gear.code}
                    </span>
                    {gear.status === 'available' ? (
                      <span className="brutal-badge text-xs px-2.5 py-0.5 bg-[#BBF7D0] text-emerald-950">
                        READY LOKER
                      </span>
                    ) : gear.status === 'borrowed' ? (
                      <span className="brutal-badge text-xs px-2.5 py-0.5 bg-[#FDA4AF] text-rose-950">
                        DIPINJAM
                      </span>
                    ) : (
                      <span className="brutal-badge text-xs px-2.5 py-0.5 bg-[#FDE047] text-amber-950">
                        MAINTENANCE
                      </span>
                    )}
                  </div>

                  <h3 className="text-base sm:text-lg font-black tracking-tight leading-snug">
                    {gear.name}
                  </h3>
                  <p className="text-xs font-bold text-zinc-500 mt-0.5">Brand: {gear.brand}</p>

                  <div className="mt-3.5 space-y-1.5 text-xs font-semibold text-zinc-700 bg-[#FAF6EF] p-3 rounded-lg border-2 border-black">
                    <div className="flex justify-between">
                      <span className="text-zinc-500">Kategori:</span>
                      <span className="font-bold">{category?.name ?? 'Umum'}</span>
                    </div>
                    <div className="flex justify-between">
                      <span className="text-zinc-500">Penyimpanan:</span>
                      <span className="font-bold font-mono-code">{gear.location}</span>
                    </div>
                    <div className="flex justify-between">
                      <span className="text-zinc-500">Kondisi:</span>
                      <span className="font-bold uppercase tracking-wider">{gear.condition}</span>
                    </div>
                  </div>

                  {gear.notes && (
                    <p className="text-xs italic text-zinc-700 mt-2 bg-amber-50/90 p-2 border border-black/30 rounded">
                      📌 {gear.notes}
                    </p>
                  )}
                </div>

                <div className="mt-5 pt-3 border-t-2 border-black/10 flex items-center justify-between">
                  <span className="text-xs font-mono-code font-bold text-zinc-500">ID #{gear.id}</span>
                  {isAvailable ? (
                    <button
                      onClick={() => onSelectGear(gear.id)}
                      className="brutal-btn bg-[#FDE047] text-xs px-3 py-1.5 font-bold"
                    >
                      Pilih Alat Ini ➔
                    </button>
                  ) : (
                    <span className="text-xs font-bold text-zinc-400">Tidak Tersedia</span>
                  )}
                </div>
              </div>
            );
          })
        )}
      </div>
    </section>
  );
}
