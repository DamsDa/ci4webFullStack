<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KomikModel;

class Pages extends BaseController
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

    public function about()
    {
        $data = [
            'title' => 'About | Laito'
        ];

        return view('pages/about', $data);
    }

    public function contact()
    {
        $data = [
            'title' => 'Contact | Laito',
            'alamat' => [
                [
                    'tipe' => 'Rumah',
                    'alamat' => 'Jl. Raya Cibadak No.123, Kec. Cimanggis',
                    'kota' => 'Depok'
                ],
                [
                    'tipe' => 'Kantor',
                    'alamat' => 'Jl. Raya Bojongsoang No.567, Kec. Beji',
                    'kota' => 'Bandung'
                ]
            ]
        ];

        return view('pages/contact', $data);
    }
}
