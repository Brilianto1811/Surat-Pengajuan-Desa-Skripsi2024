<?php

namespace App\Main;

class SimpleMenu
{
    /**
     * List of side menu items.
     */
    public static function menu(): array
    {
        return [
            'dashboard' => [
                'icon' => 'home',
                'title' => 'Dashboard',
                'sub_menu' => [
                    'dashboard' => [
                        'icon' => 'activity',
                        'route_name' => 'dashboard',
                        'title' => 'Test 1'
                    ],
                    'dashboard-overview-2' => [
                        'icon' => 'activity',
                        'route_name' => 'dashboard-overview-2',
                        'title' => 'Test 2'
                    ],
                    'dashboard-overview-3' => [
                        'icon' => 'activity',
                        'route_name' => 'dashboard-overview-3',
                        'title' => 'Test 3'
                    ],
                    'dashboard-overview-4' => [
                        'icon' => 'activity',
                        'route_name' => 'dashboard-overview-4',
                        'title' => 'Test 4'
                    ]
                ]
            ],
            'master' => [
                'icon' => 'hard-drive',
                'title' => 'Master',
                'sub_menu' => [
                    'jenis-surat' => [
                        'icon' => 'folder-open',
                        'route_name' => 'jenis-surat',
                        'title' => 'Jenis Surat'
                    ],
                    'surat' => [
                        'icon' => 'mails',
                        'route_name' => 'surat',
                        'title' => 'Surat',
                    ],
                    'profile-desa' => [
                        'icon' => 'landmark',
                        'route_name' => 'profile-desa',
                        'title' => 'Profile Desa',

                    ],
                    'aktivasi-kecamatan' => [
                        'icon' => 'layout-grid',
                        'route_name' => 'aktivasi-kecamatan',
                        'title' => 'Aktivasi Kecamatan',

                    ],
                    'admin-aplikasi' => [
                        'icon' => 'user-cog',
                        'route_name' => 'admin-aplikasi',
                        'title' => 'Admin Aplikasi',

                    ],
                    'kepala-desa' => [
                        'icon' => 'user-check',
                        'route_name' => 'kepala-desa',
                        'title' => 'Kepala Desa'
                    ],
                    'operator-desa' => [
                        'icon' => 'user',
                        'route_name' => 'operator-desa',
                        'title' => 'Operator Desa'
                    ],
                ]
            ],
            'operasi' => [
                'icon' => 'clipboard-check',
                'title' => 'Operasi',
                'sub_menu' => [
                    'data-kk' => [
                        'icon' => 'database',
                        'route_name' => 'data-kk',
                        'title' => 'Data KK'
                    ],
                    'data-individu' => [
                        'icon' => 'users',
                        'route_name' => 'data-individu',
                        'title' => 'Data individu',
                    ],
                    'permohonan-surat' => [
                        'icon' => 'mail',
                        'route_name' => 'permohonan-surat',
                        'title' => 'Permohonan Surat',

                    ],
                    'cetak-surat' => [
                        'icon' => 'printer',
                        'route_name' => 'cetak-surat',
                        'title' => 'Cetak Surat',

                    ],
                    'informasi-status-surat' => [
                        'icon' => 'mail-warning',
                        'route_name' => 'informasi-status-surat',
                        'title' => 'Informasi Status Surat',

                    ],
                ]
            ],
        ];
    }
}
