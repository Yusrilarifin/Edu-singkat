<?php namespace Config;

use CodeIgniter\Config\BaseConfig;

class Filters extends BaseConfig
{
    // 1) Daftarkan alias untuk filter
    public $aliases = [
        'csrf'    => \CodeIgniter\Filters\CSRF::class,
        'toolbar' => \CodeIgniter\Filters\DebugToolbar::class,
        'honeypot'=> \CodeIgniter\Filters\Honeypot::class,
        'auth'    => \App\Filters\AuthFilter::class,   // cek login
        'admin'   => \App\Filters\AdminFilter::class,  // cek role admin
    ];

    // 2) Terapkan secara global (opsional)
    public $globals = [
        'before' => [
            // 'csrf',   // kalau pakai CSRF
        ],
        'after'  => [
            'toolbar',
            // 'honeypot',
        ],
    ];

    // 3) Contoh kalau mau pakai per-route (namanya sudah di Routes.php)
    public $methods = [];
    public $filters = [];
}
