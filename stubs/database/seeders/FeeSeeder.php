<?php

namespace Database\Seeders;

use App\Models\Fee;
use Illuminate\Database\Seeder;

class FeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fees = [
            [
                'name:en' => 'Early Registration Author',
                'name:ar' => 'تسجيل مبكر للمؤلف',
                'price' => 750,
            ],
            [
                'name:en' => 'Early Registration Student Author',
                'name:ar' => 'تسجيل مبكر لطالب مؤلف',
                'price' => 375,
            ],
            [
                'name:en' => 'Regular Registration Author',
                'name:ar' => 'التسجيل العادي للمؤلف',
                'price' => 950,
            ],
            [
                'name:en' => 'Regular Registration Student Author',
                'name:ar' => 'التسجيل العادي لطالب مؤلف',
                'price' => 500,
            ],
            [
                'name:en' => 'KFUPM Affiliates (Must Use KFUPM Email)',
                'name:ar' => 'أعضاء جامعة KFUPM (يجب استخدام بريد KFUPM)',
                'price' => 0,
            ],
            [
                'name:en' => 'Public Attendee (Free Registration)',
                'name:ar' => 'الحضور العام (تسجيل مجاني)',
                'price' => 0,
            ],

        ];

        foreach ($fees as $fee) {
            Fee::query()->create($fee);
        }
    }
}
