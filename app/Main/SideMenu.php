<?php

namespace App\Main;

class SideMenu
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

        if (auth()->guard('superadmin')->check()) {
            $menu = [
                'jenis-surat' => [
                    'icon' => 'folder-open',
                    'route_name' => 'jenis-surat.index',
                    'title' => 'Jenis Surat'
                ],
                'surat' => [
                    'icon' => 'mails',
                    'route_name' => 'surat.index',
                    'title' => 'Surat',
                ],
                'profile-desa' => [
                    'icon' => 'landmark',
                    'route_name' => 'profile-desa.index',
                    'title' => 'Profile Desa',

                ],
                'admin-aplikasi' => [
                    'icon' => 'user-cog',
                    'route_name' => 'admin-aplikasi.index',
                    'title' => 'Admin Aplikasi',

                ],
                'kepala-desa' => [
                    'icon' => 'user-check',
                    'route_name' => 'kepala-desa.index',
                    'title' => 'Kepala Desa'
                ],
                'operator-desa' => [
                    'icon' => 'user',
                    'route_name' => 'operator-desa.index',
                    'title' => 'Operator Desa'
                ],
            ];
        }

        if (auth()->guard('adminaplikasi')->check()) {
            $menu = [
                'dashboard' => [
                    'icon' => 'home',
                    'route_name' => 'dashboardutama',
                    'title' => 'Dashboard',
                ],
                'operasi' => [
                    'icon' => 'clipboard-check',
                    'route_name' => 'permohonan-surat.index',
                    'title' => 'Permohonan Surat',
                ],
            ];
        }

        if (auth()->guard('operatordesa')->check()) {
            $menu = [
                'dashboard' => [
                    'icon' => 'home',
                    'route_name' => 'dashboardutama',
                    'title' => 'Dashboard',
                ],
                'permohonan-surat' => [
                    'icon' => 'clipboard-check',
                    'route_name' => 'permohonan-surat.index',
                    'title' => 'Permohonan Surat',
                ],
            ];
        }

        if (auth()->guard('user')->check()) {
            $menu = [];
        }

        return $menu;
    }
}
