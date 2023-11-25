<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KomikModel;

class Komik extends BaseController
{
    // agar kita tidak usah instansiasi terus jika ingin menambahkan delete method insert method dll
    // agar kita bisa panggil untuk class turunanya maka kita butuh property
    protected $komikModel;

    public function __construct()
    {
        $this->komikModel = new KomikModel();
    }

    public function index()
    {
        // konek ke database menggunakan Models
        // $komik = $this->komikModel->findAll();

        $data = [
            'title' => 'Daftar Komik | Laito',
            'komik' => $this->komikModel->getKomik()
        ];

        return view('komik/index', $data);
    }

    public function detail($slug)
    {
        $data = [
            'title' => 'Detail Komik | Laito',
            'komik' => $this->komikModel->getKomik($slug)
        ];
        // jika komik tidak ada di tabel komik kita
        if (empty($data['komik'])) {
            // maka
            throw new \CodeIgniter\Exceptions\PageNotFoundException("judul komik $slug tidak ditemukan");
        }

        return view('komik/detail', $data);
    }

    // untuk menampilkan form create
    public function create()
    {
        $data = [
            'title' => 'Form Tambah Data Komik | Laito',
            // kirimkan validasi ke form create agar validasi error tampil
            'validation' => \Config\Services::validation(),
        ];

        return view('komik/create', $data);
    }

    // untuk menyimpan data yang kita buat di form create
    public function save()
    {
        // validasi input
        if (!$this->validate([
            'judul' => [
                'rules' => 'required|is_unique[komik.judul]',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'is_unique' => '{field} sudah terdaftar'
                ]
            ],
            'penulis' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi',
                ]
            ],
            'penerbit' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi',
                ]
            ],
            'sampul' => [
                'rules' => 'max_size[sampul,1024]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' =>  'Hanya boleh file jpg, png atau jpeg'
                ]
            ]
        ])) {
            // kirimkan with input data ke session() agar kita bisa tangkap error di create form
            // jika validasi gagal maka kembali ke form tambah data dan tampilkan error
            return redirect()->to(base_url() . 'komik/create')->withInput();
        }

        // kelola gambar
        $fileSampul = $this->request->getFile('sampul');
        // cek apakah tidak ada gambar yg di upload
        if ($fileSampul->getError() == 4) {
            // kalau tidak pilih gambar maka pakai gambar default
            $namaSampul = 'default.jpg';
        } else {
            // jika pilih gambar maka
            // generate nama sampul random
            $namaSampul = $fileSampul->getRandomName();
            // pindahkan file sampul ke img
            $fileSampul->move('img', $namaSampul);
        }
        // jika validasi berhasil maka jalankan fungsi di bawah ini

        // untuk mengambil request apapun yang dikirimkan dari form create
        // $this->request->getVar();
        // kita ubah judul untuk kita jadikan slug
        // dengan url_title() kita bisa ubah judul menjadi slug dengan 3 param 1 ambil request data judul 2 separator 3 lowrcase true default false
        $slug = url_title($this->request->getVar('judul'), '-', true);
        // kalau sudah bisa kita tangkap maka kita tinggal save ke database
        $this->komikModel->save([
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $namaSampul
        ]);

        // buat flash data sebelum kita redirect
        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');

        return redirect()->to(base_url() . 'komik');
    }

    // method delete untuk menghapus data komik bedasarkan id
    public function delete($id)
    {
        // cari gambar bedasarkan id
        $komik = $this->komikModel->find($id);
        // cek jika file gambarnya default
        if($komik['sampul'] != 'default.jpg'){
            // hapus gambar
            unlink('img/' . $komik['sampul']);
        }
        $this->komikModel->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to(base_url() . 'komik');
    }

    // method form edit
    public function edit($slug)
    {
        $data = [
            'title' => "Form Ubah Data Komik",
            'validation' => \Config\Services::validation(),
            'komik' => $this->komikModel->getKomik($slug)
        ];
        return view('komik/edit', $data);
    }

    // method simpaan edit bedasarkan id
    public function update($id)
    {
        // kalau user tidak mengganti judulnya maka
        // cek judulnya
        $komikLama = $this->komikModel->getKomik($this->request->getVar('slug'));
        // jika user judul komik yang lama sama dengan judul komik yang sekarng
        if ($komikLama['judul'] == $this->request->getVar('judul')) {
            $rule_judul = 'required';
            // jika user mengganti judul komik maka 
        } else {
            $rule_judul = 'required|is_unique[komik.judul]';
        };
        // validasi data sebelum update ke database
        if (!$this->validate([
            'judul' => [
                'rules' => $rule_judul,
                'errors' => [
                    'required' => '{field} harus diisi',
                    'is_unique' => '{field} sudah terdaftar'
                ]
            ],
            'penulis' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi',
                ]
            ],
            'penerbit' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi',
                ]
            ],
            'sampul' => [
                'rules' => 'max_size[sampul,1024]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' =>  'Hanya boleh file jpg, png atau jpeg'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            // kirimkan with input data ke session() agar kita bisa tangkap error di create form
            // jika validasi gagal maka kembali ke form ubah data dan tampilkan error serta simpan inputan
            return redirect()->to(base_url() . 'komik/edit/' . $this->request->getVar('slug'))->withInput()->with('validation', $validation);
        }
        // ambil gambar baru dari request
        $fileSampul = $this->request->getFile('sampul');
        // cek gambar apakah tetap gambar lama
        if ($fileSampul->getError() == 4) {
            // kalau pakai gambar lama maka jangan diubah
            $namaSampul = $this->request->getVar('sampulLama');
            } else {
                // tapi kalau di upload sampul baru maka
                // generate nama sampul random
                $namaSampul = $fileSampul->getRandomName();
                // pindahkan gambar yang baru ke folder img
                $fileSampul->move('img', $namaSampul);
                // hapus gambar yang lama
                unlink('img/' . $this->request->getVar('sampulLama'));
                }

        $slug = url_title($this->request->getVar('judul'), '-', true);
        // kalau sudah bisa kita tangkap maka kita tinggal save ke database
        $this->komikModel->save([
            'id' => $id,
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $namaSampul
        ]);

        // buat flash data sebelum kita redirect
        session()->setFlashdata('pesan', 'Data berhasil diubah');

        return redirect()->to(base_url() . 'komik');
    }
}
