<?php

namespace App\Models;

use CodeIgniter\Model;

class OrangModel extends Model
{
    // ambil data dari tabel komik yang ada di database
    protected $table = 'orang';
    // jika menggunakan created_at dan updated_at
    protected $useTimestamps = true;
    // fieldnya harus kita kasih tau dulu agar kita bisa melakukan insert data
    protected $allowedFields = ['nama', 'alamat'];

    public function search($keyword)
    {
        return $this->table('orang')->like('nama', $keyword)->orLike('alamat',$keyword);
    }

    public function getMember($id)
    {
        // jika ada maka tampilkan ini
        return $this->table('orang')->find($id);
    }

    // default slug gada maka
    public function getNama($nama)
    {
        // jika ada maka tampilkan ini
        return $this->where(['nama' => $nama])->first();
    }
}
