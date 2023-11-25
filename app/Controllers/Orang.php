<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\OrangModel;

class Orang extends BaseController
{
    protected $OrangModel;

    public function __construct()
    {
        $this->OrangModel = new OrangModel();
    }

    public function index()
    {
        $currentPage = $this->request->getVar('page_orang') ? $this->request->getVar('page_orang') : 1;
        // cari bedasarkan keyword
        $keyword= $this->request->getVar('keyword');
        if($keyword){
            $orang = $this->OrangModel->search($keyword);
            }else{
                $orang = $this->OrangModel;
            }

        $data = [
            'title' => 'Daftar Orang | Laito',
            'orang' => $orang->paginate(6,'orang'),
            'pager' => $this->OrangModel->pager,
            'currentPage' => $currentPage
        ];

        return view('orang/index', $data);
    }

    public function detail($id)
    {
        $data = [
            'title' => 'Detail Member | Laito',
            'orang' => $this->OrangModel->getMember($id)
        ];
        // jika komik tidak ada di tabel komik kita


        return view('orang/detail', $data);
    }

    public function delete($id)
    {
        $this->OrangModel->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to(base_url() . 'orang');
    }

    // untuk menampilkan form create
    public function create()
    {
        $data = [
            'title' => 'Form Tambah Data member | Laito',
            // kirimkan validasi ke form create agar validasi error tampil
            'validation' => \Config\Services::validation(),
        ];

        return view('orang/create', $data);
    }

    // untuk menyimpan data yang kita buat di form create
    public function save()
    {
        // validasi input
        if (!$this->validate([
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi',
                ]
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi',
                ]
            ]
        ])) {
            // kirimkan with input data ke session() agar kita bisa tangkap error di create form
            // jika validasi gagal maka kembali ke form tambah data dan tampilkan error
            return redirect()->to(base_url() . 'orang/create')->withInput();
        }
        // jika validasi berhasil maka jalankan fungsi di bawah ini
        // kalau sudah bisa kita tangkap maka kita tinggal save ke database
        $this->OrangModel->save([
            'nama' => $this->request->getVar('nama'),
            'alamat' => $this->request->getVar('alamat'),
        ]);

        // buat flash data sebelum kita redirect
        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');

        return redirect()->to(base_url() . 'orang');
    }

    // view form edit
    public function edit($id)
    {
        $data = [
            'title' => "Form Ubah Data Komik",
            'validation' => \Config\Services::validation(),
            'orang' => $this->OrangModel->getMember($id)
        ];
        return view('orang/edit', $data);
    }

    // method simpaan edit bedasarkan id
    public function update($id)
    {
        // kalau user tidak mengganti judulnya maka
        // cek judulnya
        $namaLama = $this->OrangModel->getNama($this->request->getVar('nama'));
        // jika user judul komik yang lama sama dengan judul komik yang sekarng
        if ($namaLama['nama'] == $this->request->getVar('nama')) {
            $rule_judul = 'required';
            // jika user mengganti judul komik maka 
        } else {
            $rule_judul = 'required|is_unique[komik.judul]';
        };

        // validasi input
        if (!$this->validate([
            'nama' => [
                'rules' => $rule_judul,
                'errors' => [
                    'required' => '{field} harus diisi',
                ]
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi',
                ]
            ]
        ])) {
            // kirimkan with input data ke session() agar kita bisa tangkap error di create form
            // jika validasi gagal maka kembali ke form tambah data dan tampilkan error
            return redirect()->to(base_url() . 'orang/edit')->withInput();
        }

        // kalau sudah bisa kita tangkap maka kita tinggal save ke database
        $this->OrangModel->save([
            'id' => $id,
            'nama' => $this->request->getVar('nama'),
            'alamat' => $this->request->getVar('alamat'),

        ]);

        // buat flash data sebelum kita redirect
        session()->setFlashdata('pesan', 'Data berhasil diubah');

        return redirect()->to(base_url() . 'orang');
    }
}
