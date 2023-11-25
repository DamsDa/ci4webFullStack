<?php

namespace App\Models;

use CodeIgniter\Model;

class KomikModel extends Model
{
    // ambil data dari tabel komik yang ada di database
    protected $table = 'komik';
    // jika menggunakan created_at dan updated_at
    protected $useTimestamps = true;
    // fieldnya harus kita kasih tau dulu agar kita bisa melakukan insert data
    protected $allowedFields = ['judul','slug','penulis','penerbit','sampul'];

    // default slug gada maka
    // kalau ada parameternya ambil wherenya
    public function getKomik($slug = false)
    {
        // jika slugnya gada maka ambil semua data komiknya
        if ($slug == false) {
            return $this->findAll();
        }
        // jika ada maka tampilkan bedasarkan slug
        return $this->where(['slug' => $slug])->first();
    }
}
