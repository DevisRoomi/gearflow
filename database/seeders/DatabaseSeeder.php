<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Gear;
use App\Models\Loan;
use App\Models\LoanItem;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Lab Supervisor',
            'email' => 'admin@gearflow.test',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'phone' => '081234567890',
            'department' => 'Media & Studio Ops',
        ]);

        $borrower = User::create([
            'name' => 'Devis Roomi',
            'email' => 'rumiii@gearflow.test',
            'password' => Hash::make('password'),
            'role' => 'borrower',
            'phone' => '089876543210',
            'department' => 'Interactive 3D / Dev',
        ]);

        $borrower2 = User::create([
            'name' => 'Aulia Creative',
            'email' => 'aulia@gearflow.test',
            'password' => Hash::make('password'),
            'role' => 'borrower',
            'phone' => '082111222333',
            'department' => 'Multimedia Design',
        ]);

        $catCameras = Category::create([
            'name' => 'Cameras & Lenses',
            'slug' => 'cameras-lenses',
            'description' => 'Mirrorless, cinema bodies, primes, and zoom lenses.',
            'badge_color' => '#FED7AA',
        ]);

        $catAudio = Category::create([
            'name' => 'Audio Gear',
            'slug' => 'audio-gear',
            'description' => 'Wireless mics, boom poles, and audio field recorders.',
            'badge_color' => '#BAE6FD',
        ]);

        $catLighting = Category::create([
            'name' => 'Lighting & Grip',
            'slug' => 'lighting-grip',
            'description' => 'RGB panels, COB lights, softboxes, and C-stands.',
            'badge_color' => '#FEF08A',
        ]);

        $catComputing = Category::create([
            'name' => 'Computing & VR',
            'slug' => 'computing-vr',
            'description' => 'Mobile workstations, VR headsets, and capture cards.',
            'badge_color' => '#BBF7D0',
        ]);

        $gear1 = Gear::create([
            'category_id' => $catCameras->id,
            'code' => 'CAM-01',
            'name' => 'Sony FX3 Cinema Line',
            'brand' => 'Sony',
            'condition' => 'good',
            'status' => 'borrowed',
            'location' => 'Locker A-01',
            'notes' => 'Includes 2x NP-FZ100 battery + top handle XLR unit.',
        ]);

        $gear2 = Gear::create([
            'category_id' => $catCameras->id,
            'code' => 'LNS-01',
            'name' => 'Sony FE 24-70mm f/2.8 GM II',
            'brand' => 'Sony',
            'condition' => 'good',
            'status' => 'borrowed',
            'location' => 'Locker A-02',
            'notes' => 'UV filter attached, front and rear cap included.',
        ]);

        $gear3 = Gear::create([
            'category_id' => $catAudio->id,
            'code' => 'MIC-01',
            'name' => 'DJI Mic 2 (2 TX + 1 RX)',
            'brand' => 'DJI',
            'condition' => 'good',
            'status' => 'available',
            'location' => 'Drawer B-04',
            'notes' => 'Includes 32-bit float internal recording transmitter.',
        ]);

        $gear4 = Gear::create([
            'category_id' => $catAudio->id,
            'code' => 'REC-01',
            'name' => 'Zoom H6 Handy Recorder',
            'brand' => 'Zoom',
            'condition' => 'fair',
            'status' => 'available',
            'location' => 'Drawer B-05',
            'notes' => 'Rubberized body slight cosmetic wear, functioning 100%.',
        ]);

        $gear5 = Gear::create([
            'category_id' => $catLighting->id,
            'code' => 'LGT-01',
            'name' => 'Aputure Amaran 200x Bi-Color',
            'brand' => 'Aputure',
            'condition' => 'good',
            'status' => 'available',
            'location' => 'Shelf C-01',
            'notes' => 'Bowens mount with reflector & AC adapter.',
        ]);

        $gear6 = Gear::create([
            'category_id' => $catComputing->id,
            'code' => 'VR-01',
            'name' => 'Meta Quest 3 512GB',
            'brand' => 'Meta',
            'condition' => 'good',
            'status' => 'available',
            'location' => 'Locker D-02',
            'notes' => 'Controllers + elite strap with battery.',
        ]);

        $loan1 = Loan::create([
            'loan_code' => 'LN-20261027-001',
            'user_id' => $borrower->id,
            'borrow_date' => now()->toDateString(),
            'due_date' => now()->addDays(3)->toDateString(),
            'purpose' => 'Commercial 3D Product Video & Motion Graphic Shoot',
            'status' => 'active',
            'admin_notes' => 'Approved by supervisor. Inspect lens glass upon return.',
        ]);

        LoanItem::create([
            'loan_id' => $loan1->id,
            'gear_id' => $gear1->id,
            'condition_before' => 'good',
        ]);

        LoanItem::create([
            'loan_id' => $loan1->id,
            'gear_id' => $gear2->id,
            'condition_before' => 'good',
        ]);

        $loan2 = Loan::create([
            'loan_code' => 'LN-20261027-002',
            'user_id' => $borrower2->id,
            'borrow_date' => now()->addDays(1)->toDateString(),
            'due_date' => now()->addDays(4)->toDateString(),
            'purpose' => 'Podcast Interview Session with Student Council',
            'status' => 'pending',
            'admin_notes' => null,
        ]);

        LoanItem::create([
            'loan_id' => $loan2->id,
            'gear_id' => $gear3->id,
            'condition_before' => 'good',
        ]);
    }
}
