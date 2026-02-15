<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Akun Kepala SKB
        User::firstOrCreate(
            ['email' => 'kepala@workpulse.test'],
            [
                'name' => 'Dr. Budi Santoso, M.Pd.',
                'nip' => '197001011995031001',
                'password' => bcrypt('password'),
                'role' => 'kepala_skb',
                'is_active' => true,
                'phone' => '081234567890',
            ]
        );

        // Akun Tata Usaha
        User::firstOrCreate(
            ['email' => 'tu@workpulse.test'],
            [
                'name' => 'Siti Rahayu, S.E.',
                'nip' => '198505152010012001',
                'password' => bcrypt('password'),
                'role' => 'tu',
                'is_active' => true,
                'phone' => '081234567891',
            ]
        );

        // Akun Pamong 1
        User::firstOrCreate(
            ['email' => 'pamong1@workpulse.test'],
            [
                'name' => 'Ahmad Fauzi, S.Pd.',
                'nip' => '199001012019031001',
                'password' => bcrypt('password'),
                'role' => 'pamong',
                'is_active' => true,
                'phone' => '081234567892',
            ]
        );

        // Akun Pamong 2
        User::firstOrCreate(
            ['email' => 'pamong2@workpulse.test'],
            [
                'name' => 'Dewi Lestari, S.Pd.',
                'nip' => '199203032020042001',
                'password' => bcrypt('password'),
                'role' => 'pamong',
                'is_active' => true,
                'phone' => '081234567893',
            ]
        );

        // Akun Pamong 3 (belum diaktifkan - untuk test)
        User::firstOrCreate(
            ['email' => 'pamong3@workpulse.test'],
            [
                'name' => 'Riko Pratama, S.Pd.',
                'nip' => '199405052021031001',
                'password' => bcrypt('password'),
                'role' => 'pamong',
                'is_active' => false,
                'phone' => '081234567894',
            ]
        );
    }
}
