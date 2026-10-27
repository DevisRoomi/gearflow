import { Category, Gear, User, Loan } from '../types';

export const INITIAL_CATEGORIES: Category[] = [
  { id: 1, name: 'Kamera Cinema & Mirrorless', slug: 'kamera', description: 'Bodi kamera utama produksi dan video lab', badgeColor: '#FED7AA' },
  { id: 2, name: 'Lensa Prime & Zoom', slug: 'lensa', description: 'Lensa mount Sony E dan Canon RF', badgeColor: '#BBF7D0' },
  { id: 3, name: 'Audio & Wireless Mic', slug: 'audio', description: 'Mikrofon shotgun, lavalier wireless, dan field recorder', badgeColor: '#BAE6FD' },
  { id: 4, name: 'Lighting & Modifiers', slug: 'lighting', description: 'Lampu COB, softbox, light stand, dan reflector', badgeColor: '#FDE047' },
  { id: 5, name: 'Grip & Stabilizer', slug: 'grip', description: 'Gimbal motorized, tripod heavy-duty, dan rig', badgeColor: '#DDD6FE' },
];

export const INITIAL_GEARS: Gear[] = [
  { id: 1, categoryId: 1, code: 'CAM-FX3-01', name: 'Sony FX3 Cinema Line', brand: 'Sony', condition: 'good', status: 'available', location: 'Loker A-01 (Kering/Drybox)', notes: 'Sudah termasuk top handle XLR & 2 baterai NP-FZ100' },
  { id: 2, categoryId: 1, code: 'CAM-A74-02', name: 'Sony A7 IV Body', brand: 'Sony', condition: 'good', status: 'borrowed', location: 'Loker A-02', notes: 'Sensor baru dibersihkan teknisi 20 Okt' },
  { id: 3, categoryId: 1, code: 'CAM-C70-03', name: 'Canon EOS C70 4K', brand: 'Canon', condition: 'fair', status: 'available', location: 'Loker A-03 (Drybox)', notes: 'Baterai cadangan BP-A30 slot kiri' },
  { id: 4, categoryId: 2, code: 'LNS-2470-01', name: 'Sony FE 24-70mm f/2.8 GM II', brand: 'Sony', condition: 'good', status: 'borrowed', location: 'Loker B-01', notes: 'Filter UV 82mm terpasang permanen' },
  { id: 5, categoryId: 2, code: 'LNS-85P-02', name: 'Sigma 85mm f/1.4 DG DN Art', brand: 'Sigma', condition: 'good', status: 'available', location: 'Loker B-02', notes: 'Hood lensa & pouch hitam lengkap' },
  { id: 6, categoryId: 2, code: 'LNS-1635-03', name: 'Sony FE 16-35mm f/4 PZ G', brand: 'Sony', condition: 'good', status: 'available', location: 'Loker B-03', notes: 'Lensa ultra wide untuk liputan lapangan' },
  { id: 7, categoryId: 3, code: 'MIC-DJI-01', name: 'DJI Mic 2 TX+RX Kit (Wireless)', brand: 'DJI', condition: 'good', status: 'available', location: 'Loker C-01 (Box Foam)', notes: '2 transmitter + 1 receiver + adaptor lightning/type-C' },
  { id: 8, categoryId: 3, code: 'MIC-RODE-02', name: 'Rode NTG4+ Shotgun Mic', brand: 'Rode', condition: 'fair', status: 'maintenance', location: 'Meja Servis Lab', notes: 'Baterai internal cepat habis, sedang uji charge ulang' },
  { id: 9, categoryId: 4, code: 'LGT-APU-01', name: 'Aputure Amaran 200d S LED', brand: 'Aputure', condition: 'good', status: 'available', location: 'Rak D-01', notes: 'Beserta power cable & standar reflector' },
  { id: 10, categoryId: 4, code: 'LGT-NAN-02', name: 'Nanlite Pavotube II 30X (RGB)', brand: 'Nanlite', condition: 'good', status: 'available', location: 'Rak D-02', notes: 'Tube light beserta mounting clip dan tas kain' },
  { id: 11, categoryId: 5, code: 'GRP-RS3-01', name: 'DJI RS 3 Pro Gimbal Combo', brand: 'DJI', condition: 'good', status: 'borrowed', location: 'Koper Hardcase E-01', notes: 'RavenEye video transmitter & focus motor terpasang' },
  { id: 12, categoryId: 5, code: 'GRP-MNF-02', name: 'Manfrotto 504HD Fluid Head Tripod', brand: 'Manfrotto', condition: 'good', status: 'available', location: 'Sudut E-02', notes: 'Heavy duty, beban maks 12kg' },
];

export const INITIAL_USERS: User[] = [
  { id: 1, name: 'Devis Roomi', email: 'devis@studio.test', phone: '081234567890', department: 'Divisi Kreatif Video', role: 'admin' },
  { id: 2, name: 'Ahmad Fauzi', email: 'fauzi@studio.test', phone: '081298765432', department: 'Unit Dokumentasi & Humas', role: 'borrower' },
  { id: 3, name: 'Rina Kusuma', email: 'rina@studio.test', phone: '081377889900', department: 'Lab Desain Komunikasi Visual', role: 'borrower' },
  { id: 4, name: 'Bima Satria', email: 'bima@studio.test', phone: '081511223344', department: 'Kru Produksi Multimedia', role: 'borrower' },
];

export const INITIAL_LOANS: Loan[] = [
  {
    id: 1,
    loanCode: 'SURAT-2026-001',
    userId: 2,
    borrowDate: '2026-10-25',
    dueDate: '2026-10-28',
    returnedAt: null,
    purpose: 'Dokumentasi Liputan Kunjungan Industri & Seminar Gedung Serbaguna',
    status: 'active',
    adminNotes: 'Surat jalan fisik disetujui staf lab B. Baterai kamera terisi penuh.',
    itemIds: [2, 4],
  },
  {
    id: 2,
    loanCode: 'SURAT-2026-002',
    userId: 3,
    borrowDate: '2026-10-26',
    dueDate: '2026-10-29',
    returnedAt: null,
    purpose: 'Shooting tugas akhir video iklan komersial studio',
    status: 'active',
    adminNotes: 'Wajib kembalikan koper hardcase dalam kondisi bersih.',
    itemIds: [11],
  },
];
