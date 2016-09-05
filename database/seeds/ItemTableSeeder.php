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

        $csv = array_map('str_getcsv', file(public_path('data_barang.csv')));

        for ($i = 1; $i < count($csv); ++$i) {
            DB::table('items')->insert([
                'model' => $csv[$i][0],
                'size' => $csv[$i][4],
                'color' => $csv[$i][5],
                'stok' => $csv[$i][3],
                'normal_price' => $csv[$i][1],
                'reseller_price' => $csv[$i][2],
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => Date('Y-m-d H:i:s'),
                'updated_at' => Date('Y-m-d H:i:s'),
            ]);
        }

        // foreach ($csv as $line => $key) {
            // $item->model = $line[0];
            // $item->size = $line[4];
            // $item->color = $line[5];
            // $item->stock = $line[3];
            // $item->normal_price = $line[1];
            // $item->reseller_price = $line[2];
            // $item->created_by = 1;
            // $item->updated_by = 1;

        // }
    }
}
