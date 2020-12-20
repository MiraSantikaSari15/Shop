<?php

use Illuminate\Database\Seeder;
use App\Model\Customer;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $this->truncateTable();

       Customer::create([
       		'name'			=> 'Jhon Doe',
       		'date_of_birth'	=> '1994-11-15',
       		'email'			=> 'jhondoe@gmail.com',
       		'phone'			=> '0853542637826',
       		'address'		=> 'Gambir, Kecamatan Gambir, Kota Jakarta Pusat, Daerah Khusus Ibukota Jakarta',
       		'image'			=> 'default.jpg'
       ]);
    }

    public function truncateTable()
    {
        Schema::disableForeignKeyConstraints();

        Customer::truncate();

        Schema::enableForeignKeyConstraints();
    }
}
