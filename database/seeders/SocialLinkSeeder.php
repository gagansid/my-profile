<?php

namespace Database\Seeders;

use App\Models\SocialLink;
use Illuminate\Database\Seeder;

class SocialLinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $links = [
            ['platform' => 'Instagram', 'url' => 'https://www.instagram.com/gagans.id', 'icon' => 'ri-instagram-line', 'order' => 1],
            ['platform' => 'LinkedIn', 'url' => 'https://www.linkedin.com/in/gagan-suganda', 'icon' => 'ri-linkedin-box-line', 'order' => 2],
            ['platform' => 'GitHub', 'url' => 'https://github.com/gagansuganda', 'icon' => 'ri-github-line', 'order' => 3],
            ['platform' => 'Email', 'url' => 'mailto:gagan.suganda98@gmail.com', 'icon' => 'ri-mail-line', 'order' => 4],
            ['platform' => 'WhatsApp', 'url' => 'https://api.whatsapp.com/send?phone=+6289664044727&text=Hello, more information!', 'icon' => 'ri-whatsapp-line', 'order' => 5],
            ['platform' => 'Messenger', 'url' => 'https://m.me/gagans.id', 'icon' => 'ri-messenger-line', 'order' => 6],
        ];

        foreach ($links as $link) {
            SocialLink::updateOrCreate(['platform' => $link['platform']], $link);
        }
    }
}
