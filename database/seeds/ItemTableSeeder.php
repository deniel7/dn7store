<?php

use Illuminate\Database\Seeder;

class ItemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('items')->truncate();

        DB::table('items')->insert([
            'model' => 'Longsleeves Nike Pro Combat',
            'size' => 'S',
            'color' => 'black',
            'stok' => 1,
            'normal_price' => 200000,
            'reseller_price' => 190000,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => Date('Y-m-d H:i:s'),
            'updated_at' => Date('Y-m-d H:i:s'),
        ]);
    }
}
