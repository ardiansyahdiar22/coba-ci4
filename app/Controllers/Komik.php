<?php

namespace App\Controllers;

use App\Models\KomikModel;

class Komik extends BaseController
{
    protected $komikModel;
    public function __construct()
    {
        $this->komikModel = new KomikModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Page Komik',
            'komik' => $this->komikModel->getKomik()
        ];

        return view('komik/index', $data);
    }

    public function detail($slug)
    {
        $data = [
            'title' => 'Detail komik page',
            'komik' => $this->komikModel->getKomik($slug)
        ];

        // Jika komik tidak ada di tabel
        if (empty($data['komik'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Komik title' . $slug . ' is not found');
        }

        return view('komik/detail', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Form add data komik',
            'validation' => \Config\Services::validation()
        ];

        return view('komik/create', $data);
    }

    public function save()
    {
        // Validasi input
        if (!$this->validate([
            'judul' => [
                'rules' => 'required|is_unique[komik.judul]',
                'errors' => [
                    'required' => '{field} harus diisi.',
                    'is_unique' => '{field} sudah terdaftar, ganti judul lain!'
                ]
            ],
            'sampul' => [
                'rules' => 'max_size[sampul,1024]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Gambar yang anda upload terlalu besar',
                    'is_image' => 'Yang anda masukan bukan gambar',
                    'mime_in' => 'Yang anda masukan bukan format gambar'
                ]
            ]
        ])) {
            // $validation = \Config\Services::validation();
            // return redirect()->to('/komik/create')->withInput()->with('validation', $validation);
            return redirect()->to('/komik/create')->withInput();
        }

        // Ambil gambar
        $fileSampul = $this->request->getFile('sampul');

        // Cek apakah user upload gambar atau tidak
        if ($fileSampul->getError() == 4) {
            $namaFile = 'default.jpg';
        } else {
            // Generated nama sampul
            $namaFile = $fileSampul->getRandomName();

            // Pindah file ke folder img
            $fileSampul->move('img', $namaFile);
        }

        $slug = url_title($this->request->getVar('judul'), '-', true);

        $this->komikModel->save([
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $namaFile
        ]);

        session()->setFlashdata(
            'pesan',
            '<div class="alert alert-success" role="alert">
                Data komik successfully added!
            </div>'
        );

        return redirect()->to('/komik');
    }

    public function delete($id)
    {
        // Cari gambar berdasarkan id
        $komik = $this->komikModel->find($id);

        // Cek gambar yang dihapus default.jpg atau bukan
        if ($komik['sampul'] != 'default.jpg') {
            // Hapus file gambar
            unlink('img/' . $komik['sampul']);
        }

        $this->komikModel->delete($id);

        session()->setFlashdata(
            'pesan',
            '<div class="alert alert-success" role="alert">
                Data komik has been deleted!
            </div>'
        );
        return redirect()->to('/komik');
    }

    public function edit($slug)
    {
        $data = [
            'title' => 'Form edit data komik',
            'validation' => \Config\Services::validation(),
            'komik' => $this->komikModel->getKomik($slug)
        ];

        return view('komik/edit', $data);
    }

    public function update($id)
    {
        // Cek judul 
        $oldKomik = $this->komikModel->getKomik($this->request->getVar('slug'));

        if ($oldKomik['judul'] == $this->request->getVar('judul')) {
            $rules_judul = 'required';
        } else {
            $rules_judul = 'required|is_unique[komik.judul]';
        }

        // Validasi input
        if (!$this->validate([
            'judul' => [
                'rules' => $rules_judul,
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'sampul' => [
                'rules' => 'max_size[sampul,1024]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Gambar yang anda upload terlalu besar',
                    'is_image' => 'Yang anda masukan bukan gambar',
                    'mime_in' => 'Yang anda masukan bukan format gambar'
                ]
            ]
        ])) {

            return redirect()->to('/komik/edit/' . $this->request->getVar('slug'))->withInput();
        }

        $fileSampul = $this->request->getFile('sampul');

        // Cek gambar, apakah gambar lama atau bukan
        if ($fileSampul->getError() == 4) {
            $namaSampul = $this->request->getVar('sampulLama');
        } else {
            // Jika yg diupload gambar baru, lakukan generated nama gambar
            $namaSampul = $fileSampul->getRandomName();

            // Pindahkan gambar
            $fileSampul->move('img', $namaSampul);

            // Delete file lama
            unlink('img/' . $this->request->getVar('sampulLama'));
        }

        $slug = url_title($this->request->getVar('judul'), '-', true);

        $this->komikModel->save([
            'id' => $id,
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $namaSampul
        ]);

        session()->setFlashdata(
            'pesan',
            '<div class="alert alert-success" role="alert">
                Data komik has been updated!
            </div>'
        );

        return redirect()->to('/komik');
    }
}
