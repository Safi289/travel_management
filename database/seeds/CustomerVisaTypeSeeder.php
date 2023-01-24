<?php

use Illuminate\Database\Seeder;

class CustomerVisaTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'Single Entry',
            'Double Entry',
            'Hajj',
            'Umrah Hajj',
            'Others',
        ];
        foreach ($data as $row) {
            \App\CustomerVisaType::create([
                'title' => $row,
            ]);
        }
    }
}
