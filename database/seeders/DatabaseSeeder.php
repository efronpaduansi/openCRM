<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Status;
use App\Models\Produk;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Make seeder for users
        User::create([
            'name'      => 'Administrator',
            'email'     => 'admin@gmail.com',
            'password'  => bcrypt('admin'),
            'role'      => 'admin',
        ]);

        User::create([
            'name'      => 'Ela Lestari Sagala',
            'email'     => 'elalestarisagala12@gmail.com',
            'password'  => bcrypt('12345'),
            'role'      => 'guest',
        ]);

        User::create([
            'name'      => 'Customer01',
            'email'     => 'customer@gmail.com',
            'password'  => bcrypt('12345'),
            'role'      => 'client',
        ]);

        // make seeder for statuses
        Status::create([
            'status' => 'Pending',
        ]);
        Status::create([
            'status' => 'Approved',
        ]);
        Status::create([
            'status' => 'Rejected',
        ]);
        Status::create([
            'status' => 'Request Upgrade',
        ]);
        // Make seeder for produks
        Produk::create([
            'nama_produk'   => 'Internet Broadband 10 Mbps',
            'deskripsi'     => 'Internet speed up to 10 Mbps',
            'harga'         => '176000',
            'total_pajak'   => '17600',
        ]);

        Produk::create([
            'nama_produk'   => 'Internet Broadband 20 Mbps',
            'deskripsi'     => 'Internet speed up to 20 Mbps',
            'harga'         => '226000',
            'total_pajak'   => '22600',
        ]);

        Produk::create([
            'nama_produk'   => 'Internet Broadband 50 Mbps',
            'deskripsi'     => 'Internet speed up to 50 Mbps',
            'harga'         => '281000',
            'total_pajak'   => '28100',
        ]);
    }
}
