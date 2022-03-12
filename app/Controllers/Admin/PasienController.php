<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\Request;

class PasienController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Data Pasien',
            'pasiens' => $this->PasienModel->orderBy('id_pasien', 'DESC')->findAll(),
            
        ];

        // memanggil file index.php yang ada di folder admin/pasien
        return view('admin/pasien/index', $data);
    }

    public function detail($id_pasien)
    {
        $data = [
            'title' => 'Detail Data Pasien',
            'pasien' => $this->PasienModel->where('id_pasien', $id_pasien)->first()
        ];

        return view('admin/pasien/detail', $data);
    }

    public function view_insert()
    {
        $data = [
            'title' => 'Tambah Data Pasien',
            'validation' => $this->validation
        ];

        return view('admin/pasien/tambah', $data);
    }

    public function insert()
    {
        // validasi input
        $rules = $this->validate([
            'no_rm' => [
                'rules' => 'required|numeric|is_unique[pasien.no_rm]|max_length[10]|min_length[10]',
                'errors' => [
                    'required' => 'no rm tidak boleh kosong',
                    'numeric' => 'no rm harus angka',
                    'is_unique' => 'no rm sudah terdaftar',
                    'max_length' => 'no rm maksimal 10 karakter',
                    'min_length' => 'no rm minimal 10 karakter'
                ]
            ],
            'nik' => [
                'rules' => 'required|numeric|is_unique[pasien.no_rm]|max_length[16]|min_length[16]',
                'errors' => [
                    'required' => 'nik tidak boleh kosong',
                    'numeric' => 'nik harus angka',
                    'is_unique' => 'nik sudah terdaftar',
                    'max_length' => 'nik maksimal 16 karakter',
                    'min_length' => 'nik minimal 16 karakter'
                ]
            ],
            'nama' => [
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => 'nama tidak boleh kosong',
                    'min_length' => 'nama minimal 3 karakter'
                ]
            ],
            'alamat' => [
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => 'alamat tidak boleh kosong',
                    'min_length' => 'alamat minimal 3 karakter'
                ]
            ],
            'jenis_kelamin' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'jenis kelamin tidak boleh kosong',
                ]
            ],
            'agama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'agama tidak boleh kosong',
                ]
            ],
            'diagnosa' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'diagnosa tidak boleh kosong',
                ]
            ],
            'jenis_rawat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'jenis pelayanan tidak boleh kosong',
                ]
            ],
            'biaya' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'jenis pelayanan tidak boleh kosong',
                    'numeric' => 'biaya harus berupa angka'
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'email tidak boleh kosong',
                    'valid_email' => 'email tidak valid'
                ]
            ],
            'no_telepon' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'no telepon tidak boleh kosong',
                    'numeric' => 'no telepon harus berupa angka'
                ]
            ],
            'foto' => [
                'rules' => 'uploaded[foto]|max_size[foto,2048]|is_image[foto]|ext_in[foto,png,jpg,jpeg]|mime_in[foto,image/png,image/jpg,image/jpeg]',
                'errors' => [
                    'uploaded' => 'foto harus di upload',
                    'max_size' => 'foto max 2 mb',
                    'is_image' => 'yang anda pilih bukan gambar',
                    'ext_in' => 'foto tidak valid',
                    'mime_in' => 'foto harus berupa png,jpg,jpeg'
                ]
            ]
        ]);

        // jika gagal validasi
        if (!$rules) {
            session()->setFlashdata('failed', $this->validation->getErrors());
            return redirect()->back()->withInput();
        }

        // ambil foto
        $getFoto = $this->request->getFile('foto');

        // ambil nama foto dan rendomkan
        $namaFoto = $getFoto->getRandomName();

        // pindahkan ke folder asset admin/img
        $getFoto->move(WRITEPATH . '../public/asset-admin/img', $namaFoto);

        // ambil data reques untuk dimasukan ke db
        $data = [
            'no_rm'              => strip_tags($this->request->getPost('no_rm')),
            'nik'                => strip_tags($this->request->getPost('nik')),
            'nama'               => strip_tags($this->request->getPost('nama')),
            'alamat'             => strip_tags($this->request->getPost('alamat')),
            'jenis_kelamin'      => strip_tags($this->request->getPost('jenis_kelamin')),
            'agama'              => strip_tags($this->request->getPost('agama')),
            'diagnosa'           => strip_tags($this->request->getPost('diagnosa')),
            'jenis_rawat'        => strip_tags($this->request->getPost('jenis_rawat')),
            'biaya'              => strip_tags($this->request->getPost('biaya')),
            'email'              => strip_tags($this->request->getPost('email')),
            'no_telepon'         => strip_tags($this->request->getPost('no_telepon')),
            'foto'               => $namaFoto
        ];
        $this->PasienModel->insert($data);

        return redirect()->to(base_url('pasien'))->with('success', 'Data Pasien Berhasil Di Tambahkan');
    }

    public function view_update($id_pasien)
    {
        $data = [
            'title' => 'Ubah Data Pasien',
            'pasien' => $this->PasienModel->find($id_pasien),
            'validation' => $this->validation
        ];
        return view('admin/pasien/ubah', $data);
    }


    public function update($id_pasien)
    {
        // validasi input
        $rules = $this->validate([
            'no_rm' => [
                'rules' => 'required|numeric|is_unique[pasien.no_rm,id_pasien,{id_pasien}]|max_length[10]|min_length[10]',
                'errors' => [
                    'required' => 'no rm tidak boleh kosong',
                    'numeric' => 'no rm harus angka',
                    'is_unique' => 'no rm sudah terdaftar',
                    'max_length' => 'no rm maksimal 10 karakter',
                    'min_length' => 'no rm minimal 10 karakter'
                ]
            ],
            'nik' => [
                'rules' => 'required|numeric|is_unique[pasien.nik,id_pasien,{id_pasien}]|max_length[16]|min_length[16]',
                'errors' => [
                    'required' => 'nik tidak boleh kosong',
                    'numeric' => 'nik harus angka',
                    'is_unique' => 'nik sudah terdaftar',
                    'max_length' => 'nik maksimal 16 karakter',
                    'min_length' => 'nik minimal 16 karakter'
                ]
            ],
            'nama' => [
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => 'nama tidak boleh kosong',
                    'min_length' => 'nama minimal 3 karakter'
                ]
            ],
            'alamat' => [
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => 'alamat tidak boleh kosong',
                    'min_length' => 'alamat minimal 3 karakter'
                ]
            ],
            'jenis_kelamin' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'jenis kelamin tidak boleh kosong',
                ]
            ],
            'agama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'agama tidak boleh kosong',
                ]
            ],
            'diagnosa' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'diagnosa tidak boleh kosong',
                ]
            ],
            'jenis_rawat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'jenis pelayanan tidak boleh kosong',
                ]
            ],
            'biaya' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'jenis pelayanan tidak boleh kosong',
                    'numeric' => 'biaya harus berupa angka'
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'email tidak boleh kosong',
                    'valid_email' => 'email tidak valid'
                ]
            ],
            'no_telepon' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'no telepon tidak boleh kosong',
                    'numeric' => 'no telepon harus berupa angka'
                ]
            ],
            'foto' => [
                'rules' => 'max_size[foto,2048]|is_image[foto]|ext_in[foto,png,jpg,jpeg]|mime_in[foto,image/png,image/jpg,image/jpeg]',
                'errors' => [
                    'uploaded' => 'foto harus di upload',
                    'max_size' => 'foto max 2 mb',
                    'is_image' => 'yang anda pilih bukan gambar',
                    'ext_in' => 'foto tidak valid',
                    'mime_in' => 'foto harus berupa png,jpg,jpeg'
                ]
            ]
        ]);

        // jika gagal validasi
        if (!$rules) {
            session()->setFlashdata('failed', $this->validation->getErrors());
            return redirect()->back()->withInput();
        }

        // ambil foto
        $getFoto = $this->request->getFile('foto');

        // check ganti foto atau tidak
        if ($getFoto->getError() == 4) {
            // kondisi jika tidak upload foto baru tetapkan foto lama
            $namaFoto = $this->request->getPost('fotoLama');
        } else {
            // jika upload foto baru
            // ambil nama foto dan rendomkan
            $namaFoto = $getFoto->getRandomName();

            // pindahkan ke folder asset admin/img
            $getFoto->move(WRITEPATH . '../public/asset-admin/img', $namaFoto);

            // hapus foto lama di img
            unlink(WRITEPATH . '../public/asset-admin/img/' . $this->request->getPost('fotoLama'));
        }


        // ambil data reques untuk dimasukan ke db
        $data = [
            'no_rm'              => strip_tags($this->request->getPost('no_rm')),
            'nik'                => strip_tags($this->request->getPost('nik')),
            'nama'               => strip_tags($this->request->getPost('nama')),
            'alamat'             => strip_tags($this->request->getPost('alamat')),
            'jenis_kelamin'      => strip_tags($this->request->getPost('jenis_kelamin')),
            'agama'              => strip_tags($this->request->getPost('agama')),
            'diagnosa'           => strip_tags($this->request->getPost('diagnosa')),
            'jenis_rawat'        => strip_tags($this->request->getPost('jenis_rawat')),
            'biaya'              => strip_tags($this->request->getPost('biaya')),
            'email'              => strip_tags($this->request->getPost('email')),
            'no_telepon'         => strip_tags($this->request->getPost('no_telepon')),
            'foto'               => $namaFoto
        ];
        $this->PasienModel->update($id_pasien, $data);

        return redirect()->to(base_url('pasien'))->with('success', 'Data Pasien Berhasil Di Ubah');
    }


    public function delete()
    {
        if ($this->request->isAJAX()) {


            $id_pasien = $this->request->getVar('id_pasien');
            // cari data berdasarkan id
            // SELECT * FROM tbl_pasien WHERE id_pasien = $id_pasien // fungsi di native
            $data = $this->PasienModel->find($id_pasien);

            // fungsi hapus foto dari folder
            unlink(WRITEPATH . '../public/asset-admin/img/' . $data->foto);

            // fungsi hapus data dari database
            $this->PasienModel->delete($id_pasien);

            $result = [
                'success' => 'Data Pasien Berhasil Di Hapus'
            ];

            echo json_encode($result);
        } else {
            exit('404 Not Found');
        }
    }
}
