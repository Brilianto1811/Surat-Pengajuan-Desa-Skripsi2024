<?php

namespace App\Main;

class TopMenu
{
    /**
     * List of side menu items.
     */
    public static function menu(): array
    {
        $menu = [
            'dashboard' => [
                'icon' => 'home',
                'route_name' => 'dashboard',
                'title' => 'Dashboard',
            ],
        ];

        if (auth()->guard('user')->check()) {
            $menu = [
                'halaman-utama' => [
                    'icon' => 'home',
                    'route_name' => 'halamanutama',
                    'title' => 'Halaman Utama',
                ],
                'surat-pengajuan-page' => [
                    'icon' => 'mails',
                    'route_name' => 'surat-pengajuan.index',
                    'title' => 'Surat Pengajuan',
                ],
            ];
        }

        return $menu;
    }
}
