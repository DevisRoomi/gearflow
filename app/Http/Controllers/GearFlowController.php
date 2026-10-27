<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLoanRequest;
use App\Http\Requests\UpdateLoanStatusRequest;
use App\Models\Category;
use App\Models\Gear;
use App\Models\Loan;
use App\Models\LoanItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GearFlowController extends Controller
{
    public function index(Request $request)
    {
        $selectedCategory = $request->query('category');
        $search = $request->query('search');

        $categories = Category::withCount('gears')->get();

        $gearsQuery = Gear::with('category');

        if ($selectedCategory) {
            $gearsQuery->whereHas('category', function ($q) use ($selectedCategory) {
                $q->where('slug', $selectedCategory);
            });
        }

        if ($search) {
            $gearsQuery->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('code', 'like', "%{$search}%")
                  ->orWhere('brand', 'like', "%{$search}%");
            });
        }

        $gears = $gearsQuery->orderBy('code')->get();

        $loans = Loan::with(['user', 'items.gear'])
            ->latest()
            ->take(10)
            ->get();

        $stats = [
            'total_gears' => Gear::count(),
            'available_gears' => Gear::where('status', 'available')->count(),
            'active_loans' => Loan::where('status', 'active')->count(),
            'pending_loans' => Loan::where('status', 'pending')->count(),
        ];

        $users = User::all();
        $availableGears = Gear::where('status', 'available')->get();

        return view('gearflow', compact('categories', 'gears', 'loans', 'stats', 'users', 'availableGears', 'selectedCategory', 'search'));
    }

    public function storeLoan(StoreLoanRequest $request)
    {
        $validated = $request->validated();
        $loanCode = 'LN-' . date('Ymd') . '-' . strtoupper(Str::random(4));

        $loan = Loan::create([
            'loan_code' => $loanCode,
            'user_id' => $validated['user_id'],
            'borrow_date' => $validated['borrow_date'],
            'due_date' => $validated['due_date'],
            'purpose' => $validated['purpose'],
            'status' => 'pending',
        ]);

        foreach ($validated['gear_ids'] as $gearId) {
            LoanItem::create([
                'loan_id' => $loan->id,
                'gear_id' => $gearId,
                'condition_before' => 'good',
            ]);
        }

        return redirect()->route('gearflow.index')->with('success', "Pengajuan surat jalan {$loanCode} tercatat di sistem.");
    }

    public function updateStatus(UpdateLoanStatusRequest $request, Loan $loan)
    {
        $validated = $request->validated();
        $newStatus = $validated['status'];
        $loan->update(['status' => $newStatus]);

        if ($newStatus === 'active') {
            foreach ($loan->items as $item) {
                $item->gear->update(['status' => 'borrowed']);
            }
            $msg = "Alat untuk surat jalan {$loan->loan_code} resmi diserahkan ke peminjam.";
        } elseif ($newStatus === 'returned') {
            $loan->update(['returned_at' => now()->toDateString()]);
            foreach ($loan->items as $item) {
                $item->gear->update(['status' => 'available']);
            }
            $msg = "Pengembalian surat jalan {$loan->loan_code} selesai diinspeksi. Stok alat kembali Ready.";
        } elseif ($newStatus === 'rejected') {
            $msg = "Surat jalan {$loan->loan_code} ditolak oleh pengelola lab.";
        } else {
            $msg = "Status surat jalan {$loan->loan_code} diubah menjadi {$newStatus}.";
        }

        return redirect()->route('gearflow.index')->with('success', $msg);
    }
}
