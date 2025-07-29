<?php namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AdminFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Jika belum login atau bukan admin → kembalikan ke login
        if (! session()->get('isLoggedIn') || session()->get('userRole') !== 'admin') {
            return redirect()->to('/login')
                             ->with('error', 'Anda harus login sebagai admin untuk mengakses halaman ini.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak perlu aksi setelah request
    }
}
