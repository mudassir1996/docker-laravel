<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OutletSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run($data)
    {
        $outlet_settings = DB::table('outlet_settings')->insert(
            [
                [
                    'key' => 'edit_retail_price',
                    'value' => '1',
                    'outlet_id' =>  $data['outlet_id'],
                    'created_by' => $data['created_by'],
                    'created_at' =>  \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ],
                [
                    'key' => 'product_level_discount',
                    'value' => '1',
                    'outlet_id' =>  $data['outlet_id'],
                    'created_by' => $data['created_by'],
                    'created_at' =>  \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ],
                [
                    'key' => 'bill_level_discount',
                    'value' => '1',
                    'outlet_id' =>  $data['outlet_id'],
                    'created_by' => $data['created_by'],
                    'created_at' =>  \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ],

            ]
        );
    }
}
