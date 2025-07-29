<?php namespace App\Models;

use CodeIgniter\Model;

class MateriModel extends Model
{
    protected $table      = 'materi';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    protected $allowedFields    = ['judul', 'isi', 'file', 'user_id', 'status'];

    // Otomatis handle created_at & updated_at
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validasi sederhana
    protected $validationRules    = [
        'judul' => 'required|min_length[3]',
        'isi'   => 'required',
    ];
    protected $skipValidation     = false;
}
