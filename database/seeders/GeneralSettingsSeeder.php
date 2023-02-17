<?php

namespace Database\Seeders;

use App\Models\Website;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GeneralSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Website::create([
            'seo_title'=> '',
            'seo_description'=> '',
            'seo_keywords'=> '',
            'footer_about'=> '',
            'need_varification'=> 'no',
            'favicon'=> 'backend/assets/uploads/settings/default.jpg',
            'logo_header'=> 'backend/assets/uploads/settings/default.jpg',
            'logo_footer'=> 'backend/assets/uploads/settings/default.jpg'
        ]);
    }
}
