<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SocialMedia;

class SocialMediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SocialMedia::create([
            'name' => 'Facebook',
            'url' => 'www.facebook.com',
            'icon' => 'lni lni-facebook-filled',
        ]);

        SocialMedia::create([
            'name' => 'Twitter',
            'url' => 'www.twitter.com',
            'icon' => 'lni lni-twitter-original',
        ]);

        SocialMedia::create([
            'name' => 'Instagram',
            'url' => 'www.instagram.com',
            'icon' => 'lni lni-instagram',
        ]);

        SocialMedia::create([
            'name' => 'Google',
            'url' => 'www.google.com',
            'icon' => 'lni lni-google',
        ]);
    }
}
