export type GearCondition = 'good' | 'fair' | 'maintenance';
export type GearStatus = 'available' | 'borrowed' | 'maintenance';

export interface Category {
  id: number;
  name: string;
  slug: string;
  description: string;
  badgeColor: string;
}

export interface Gear {
  id: number;
  categoryId: number;
  code: string;
  name: string;
  brand: string;
  condition: GearCondition;
  status: GearStatus;
  location: string;
  notes?: string;
}

export interface User {
  id: number;
  name: string;
  email: string;
  phone: string;
  department: string;
  role: 'admin' | 'borrower';
}

export type LoanStatus = 'pending' | 'approved' | 'active' | 'returned' | 'rejected';

export interface LoanItem {
  id: number;
  gearId: number;
  conditionBefore: GearCondition;
  conditionAfter?: GearCondition;
}

export interface Loan {
  id: number;
  loanCode: string;
  userId: number;
  borrowDate: string;
  dueDate: string;
  returnedAt?: string | null;
  purpose: string;
  status: LoanStatus;
  adminNotes?: string | null;
  itemIds: number[];
}
