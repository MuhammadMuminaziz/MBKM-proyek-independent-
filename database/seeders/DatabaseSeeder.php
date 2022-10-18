<?php

namespace Database\Seeders;

use App\Models\KartuRm;
use App\Models\Month;
use App\Models\PoliKlinik;
use App\Models\User;
use App\Models\Year;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'type' => 'Administrator',
            'photo' => 'default.png',
            'password' => Hash::make('admin123')
        ]);
        User::create([
            'name' => 'Profile',
            'email' => 'profile@gmail.com',
            'type' => 'Profile',
            'photo' => 'default.png',
            'password' => Hash::make('profile123')
        ]);
        User::create([
            'name' => 'Rekam Medis',
            'email' => 'rekammedis@gmail.com',
            'type' => 'Rekam Medis',
            'photo' => 'default.png',
            'password' => Hash::make('rekammedis123')
        ]);
        User::create([
            'name' => 'Rawat Jalan',
            'email' => 'rawatjalan@gmail.com',
            'type' => 'Rawat Jalan',
            'photo' => 'default.png',
            'password' => Hash::make('rawatjalan123')
        ]);
        User::create([
            'name' => 'Rawat Inap',
            'email' => 'rawatinap@gmail.com',
            'type' => 'Rawat Inap',
            'photo' => 'default.png',
            'password' => Hash::make('rawatinap123')
        ]);

        Year::create([
            'year' => '2022'
        ]);

        Month::create([
            'moon' => '01',
            'bulan' => 'Januari'
        ]);
        Month::create([
            'moon' => '02',
            'bulan' => 'Februari'
        ]);
        Month::create([
            'moon' => '03',
            'bulan' => 'Maret'
        ]);
        Month::create([
            'moon' => '04',
            'bulan' => 'April'
        ]);
        Month::create([
            'moon' => '05',
            'bulan' => 'Mei'
        ]);
        Month::create([
            'moon' => '06',
            'bulan' => 'Juni'
        ]);
        Month::create([
            'moon' => '07',
            'bulan' => 'Juli'
        ]);
        Month::create([
            'moon' => '08',
            'bulan' => 'Agustus'
        ]);
        Month::create([
            'moon' => '09',
            'bulan' => 'September'
        ]);
        Month::create([
            'moon' => '10',
            'bulan' => 'Oktober'
        ]);
        Month::create([
            'moon' => '11',
            'bulan' => 'November'
        ]);
        Month::create([
            'moon' => '12',
            'bulan' => 'Desember'
        ]);
    }
}
