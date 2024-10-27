<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'nama' => 'Kesiswaan',
            'email' => 'kesiswaan@gmail.com',
            'password' => password_hash("12345678", PASSWORD_DEFAULT),
            'role' => 'kesiswaan',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        User::create([
            'nama' => 'Operator',
            'email' => 'operator@gmail.com',
            'password' => password_hash("12345678", PASSWORD_DEFAULT),
            'role' => 'operator',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        User::create([
            'nama' => 'Lilis Tati Elis',
            'email' => 'lilis@gmail.com',
            'password' => password_hash("12345678", PASSWORD_DEFAULT),
            'role' => 'wali',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        User::create([
            'nama' => 'Euis Nursibahhayati',
            'email' => 'euis@gmail.com',
            'password' => password_hash("12345678", PASSWORD_DEFAULT),
            'role' => 'wali',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        User::create([
            'nama' => 'Pemi Sri Handini',
            'email' => 'pemi@gmail.com',
            'password' => password_hash("12345678", PASSWORD_DEFAULT),
            'role' => 'wali',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        User::create([
            'nama' => 'Engkus Kusnadi',
            'email' => 'engkus@gmail.com',
            'password' => password_hash("12345678", PASSWORD_DEFAULT),
            'role' => 'wali',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        User::create([
            'nama' => 'Himatul Munawaroh',
            'email' => 'hima@gmail.com',
            'password' => password_hash("12345678", PASSWORD_DEFAULT),
            'role' => 'wali',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        User::create([
            'nama' => 'Ani Nuraeni',
            'email' => 'ani@gmail.com',
            'password' => password_hash("12345678", PASSWORD_DEFAULT),
            'role' => 'wali',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // User::create([
        //     'nama' => 'Reyga Marza Ramadhan',
        //     'email' => 'rey@gmail.com',
        //     'password' => password_hash("12345678", PASSWORD_DEFAULT),
        //     'role' => 'siswa',
        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ]);

        // User::create([
        //     'nama' => 'Satria Galam Pratama',
        //     'email' => 'sat@gmail.com',
        //     'password' => password_hash("12345678", PASSWORD_DEFAULT),
        //     'role' => 'siswa',
        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ]);

        // User::create([
        //     'nama' => 'Irma Naila Juwita',
        //     'email' => 'iruma@gmail.com',
        //     'password' => password_hash("12345678", PASSWORD_DEFAULT),
        //     'role' => 'siswa',
        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ]);

        User::create([
            'nama' => 'Dani Supriyadi',
            'email' => 'ortu@gmail.com',
            'password' => password_hash("12345678", PASSWORD_DEFAULT),
            'role' => 'walis',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        User::create([
            'nama' => 'Tati Hariyati',
            'email' => 'ortu2@gmail.com',
            'password' => password_hash("12345678", PASSWORD_DEFAULT),
            'role' => 'walis',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        User::create([
            'nama' => 'Supratman Widodo',
            'email' => 'ortu3@gmail.com',
            'password' => password_hash("12345678", PASSWORD_DEFAULT),
            'role' => 'walis',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // User::create([
        //     'nama' => 'Haanun Syauqoni',
        //     'email' => 'noon@gmail.com',
        //     'password' => password_hash("12345678", PASSWORD_DEFAULT),
        //     'role' => 'siswa',
        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ]);

        // User::create([
        //     'nama' => 'Hariz May Rayhan',
        //     'email' => 'rizz@gmail.com',
        //     'password' => password_hash("12345678", PASSWORD_DEFAULT),
        //     'role' => 'siswa',
        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ]);
    }
}
