<?php namespace App\Controllers;

use App\Models\MateriModel;
use CodeIgniter\Controller;

class Materi extends Controller {
    protected $materiModel;
    protected $validation;

    
    public function __construct(){
        helper(['url','form','session']);
        $this->materiModel = new MateriModel();
        $this->validation  = \Config\Services::validation();
    }

    // List semua materi milik user (atau semua jika admin)
   // app/Controllers/Materi.php

    public function index() {
        helper(['url','form','session']);
        $q        = $this->request->getGet('q');
        $builder  = $this->materiModel->builder();

        // Hanya materi yg approved
        $builder->where('status', 'approved');

        // Search
        if (! empty($q)) {
            $builder->groupStart()
                    ->like('judul', $q)
                    ->orLike('isi',   $q)
                    ->groupEnd();
        }

        $data = [
            'materiList' => $builder->orderBy('created_at','DESC')
                                    ->get()
                                    ->getResultArray(),
            'q'          => $q,
        ];

        echo view('materi/index', $data);
        }


 
    public function show($id = null) {
        $materi = $this->materiModel->find($id);
        if (! $materi) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Materi #{$id} tidak ditemukan");
        }

        echo view('materi/show', ['materi' => $materi]);
    }


    // Tampilkan form tambah materi
    public function create() {
        echo view('partials/header', ['title'=>'Tambah Materi']);
        echo view('partials/navbar');
        echo view('materi/create');    // hanya konten form
        echo view('partials/footer');
    }

    // form edit
    public function edit($id = null){
        $materi = $this->materiModel->find($id);
        if (! $materi) {
            return redirect()->to('/materi')->with('error','Materi tidak ditemukan');
        }
        
        echo view('partials/header', ['title'=>'Edit Materi']);
        echo view('partials/navbar');
        echo view('materi/edit', ['materi'=>$materi]); // hanya konten form
        echo view('partials/footer');
    }

    // Proses simpan materi baru
    public function store() {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'judul' => 'required|min_length[3]',
            'isi'   => 'required'
        ]);

        if (! $validation->withRequest($this->request)->run()) {
            return redirect()->back()
                             ->withInput()
                             ->with('errors', $validation->getErrors());
        }

        $insertId = $this->materiModel->insert([
            'judul'   => $this->request->getPost('judul'),
            'isi'     => $this->request->getPost('isi'),
            'user_id' => session()->get('userId'),
            'status'  => 'pending'
        ]);

        if (! $insertId) {
            return redirect()->back()
                             ->withInput()
                             ->with('errors', $this->materiModel->errors());
        }

        return redirect()->to('/materi')
                         ->with('success','Materi berhasil ditambahkan dan menunggu approval.');
    }


    // Proses update data materi
     public function update($id = null) {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'judul' => 'required|min_length[3]',
            'isi'   => 'required'
        ]);

        if (! $validation->withRequest($this->request)->run()) {
            return redirect()->back()
                             ->withInput()
                             ->with('errors', $validation->getErrors());
        }

        $updated = $this->materiModel->update($id, [
            'judul' => $this->request->getPost('judul'),
            'isi'   => $this->request->getPost('isi')
        ]);

        if (! $updated) {
            return redirect()->back()
                             ->withInput()
                             ->with('errors', $this->materiModel->errors());
        }

        return redirect()->to('/materi')
                         ->with('success','Materi berhasil diperbarui.');
    }

    // Hapus materi 
    public function delete($id = null) {
        $materi = $this->materiModel->find($id);
        if (! $materi) {
            return redirect()->back()->with('error', 'Materi tidak ditemukan');
        }
        // hanya pemilik atau admin
        if (session()->get('userRole') !== 'admin' && $materi['user_id'] != session()->get('userId')) {
            return redirect()->back()->with('error', 'Tidak punya hak menghapus');
        }


        $this->materiModel->delete($id);
        return redirect()->back()->with('success', 'Materi dihapus');
    }
}
