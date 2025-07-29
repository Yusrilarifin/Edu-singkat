<?php namespace App\Controllers;

use App\Models\MateriModel;
use CodeIgniter\Controller;

class Admin extends Controller
{
    protected $materiModel;

    public function __construct()
    {
        helper(['url', 'form', 'session']);
        $this->materiModel = new MateriModel();
    }

    // Tampilkan halaman approval materi
    public function approval()
    {
        $data['pendingList'] = $this->materiModel
            ->where('status', 'pending')
            ->findAll();

        echo view('materi/approval', $data);
    }

    // Approve materi by ID
    public function approve($id = null)
    {
        if ($id && $this->materiModel->update($id, ['status' => 'approved'])) {
            return redirect()->to('admin/approval')->with('success', 'Materi approved');
        }
        return redirect()->back()->with('error', 'Gagal approve materi');
    }

    // Reject materi by ID
    
    public function reject($id = null) {
        if ($id && $this->materiModel->delete($id)) {
            return redirect()->to('admin/approval')
                            ->with('success','Materi rejected and removed');
        }
        return redirect()->back()->with('error','Gagal reject materi');
    }
}