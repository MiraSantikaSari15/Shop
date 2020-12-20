<?php

use Illuminate\Database\Seeder;
use App\Model\Product;
use Carbon\Carbon;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$this->truncateTable();
    	
    	$data = [
    		[
    			'title'			=> 'Cardigan Rajut Wanita',
    			'slug'			=> 'Cardigan-Rajut-Wanita',
    			'size'			=> 'XL',
    			'price'			=> 56000,
    			'stock'			=> 100,
    			'description' 	=> 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
    			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
    			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
    			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
    			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
    			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
    			'image'			=> '5YJcwGbnNVyGpJ42W8Kt5tnBoRvOs9rpzN4HKoch.png',
    			'created_at'	=> Carbon::now(),
    			'updated_at'	=> Carbon::now()
    		],
    		[
    			'title'			=> 'MORYMONY GON - Shoulder Bag Wanita',
    			'slug'			=> 'MORYMONY-GON-Shoulder-Bag-Wanita',
    			'size'			=> 'No',
    			'price'			=> 120000,
    			'stock'			=> 100,
    			'description' 	=> 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
    			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
    			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
    			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
    			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
    			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
    			'image'			=> 'CokMvuoBO6AbYddm7nHZRHcEJMuaGRG9trVKTjNA.png',
    			'created_at'	=> Carbon::now(),
    			'updated_at'	=> Carbon::now()
    		],
    	];

    	Product::insert($data);
    }

    public function truncateTable()
    {
    	Schema::disableForeignKeyConstraints();

    	Product::truncate();

    	Schema::enableForeignKeyConstraints();
    }
}
