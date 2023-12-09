<?php

namespace App\Controllers;
use App\Models\KomikModel;

class Home extends BaseController
{
    protected $komikModel;

    public function __construct()
    {
        $this->komikModel = new KomikModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Daftar Komik | Laito',
            'komik' => $this->komikModel->getKomik()
        ];

        return view('pages/home', $data);
    }
}
