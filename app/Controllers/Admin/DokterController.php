<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class DokterController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Data Dokter RSUD',
            'dokters' => $this->DokterModel->orderBy('id_dokter', 'DESC')->findAll(),
            'validation' => $this->validation
        ];

        return view('admin/dokter/index', $data);
    }

    public function detail($id_dokter)
    {
        $data = [
            'title' => 'Detail Data Dokter',
            'dokters' => $this->DokterModel->where('id_dokter', $id_dokter)->first()
        ];

        return view('admin/dokter/index', $data);
    }

    public function insert()
    {
        // validasi input
        $rules = $this->validate([
            'nama_dokter' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Dokter harus di isi',
                ]
            ],
            'spesialis' => [
                'rules' => 'required',
                'errors' => [
                'required' => 'spesialis harus di isi',
                ]
            ],
            'no_telepon' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'No telepon harus di isi',
                    'numeric' => 'no telepon harus berupa angka'
                ]
            ],
            'email' => [
                'rules' => 'required',
                'errors' => [
                'required' => 'Email harus di isi',
                ]
            ],
            'foto' => [
                'rules' => 'max_size[foto,2048]|is_image[foto]|ext_in[foto,png,jpg,jpeg]|mime_in[foto,image/png,image/jpg,image/jpeg]',
                'errors' => [
                   
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
            'nama_dokter'              => strip_tags($this->request->getPost('nama_dokter')),
            'spesialis'                => strip_tags($this->request->getPost('spesialis')),
            'no_telepon'               => strip_tags($this->request->getPost('no_telepon')),
            'email'                    => strip_tags($this->request->getPost('email')),
            'foto'                     => $namaFoto
        ];
        $this->DokterModel->insert($data);

        return redirect()->to(base_url('dokter'))->with('success', 'Data Dokter Berhasil Di Tambahkan');
    }


    public function update($id_dokter)
    {
        // validasi input
        $rules = $this->validate([
            'nama_dokter' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Dokter harus di isi',
                ]
            ],
            'spesialis' => [
                'rules' => 'required',
                'errors' => [
                'required' => 'spesialis harus di isi',
                ]
            ],
            'no_telepon' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'No telepon harus di isi',
                    'numeric' => 'no telepon harus berupa angka'
                ]
            ],
            'email' => [
                'rules' => 'required',
                'errors' => [
                'required' => 'Email harus di isi',
                ]
            ],
            'foto' => [
                'rules' => 'max_size[foto,2048]|is_image[foto]|ext_in[foto,png,jpg,jpeg]|mime_in[foto,image/png,image/jpg,image/jpeg]',
                'errors' => [
                   
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
            'nama_dokter'              => strip_tags($this->request->getPost('nama_dokter')),
            'spesialis'                => strip_tags($this->request->getPost('spesialis')),
            'no_telepon'               => strip_tags($this->request->getPost('no_telepon')),
            'email'                    => strip_tags($this->request->getPost('email')),
            'foto'                     => $namaFoto
        ];
        $this->DokterModel->update($id_dokter, $data);

        return redirect()->to(base_url('dokter'))->with('success', 'Data Dokter Berhasil Di Ubah');
    }


    public function delete()
    {
        if ($this->request->isAJAX()) {


            $id_dokter = $this->request->getVar('id_dokter');
            // cari data berdasarkan id
            // SELECT * FROM tbl_pasien WHERE id_pasien = $id_pasien // fungsi di native
            $data = $this->DokterModel->find($id_dokter);

            // fungsi hapus foto dari folder
            unlink(WRITEPATH . '../public/asset-admin/img/' . $data->foto);

            // fungsi hapus data dari database
            $this->DokterModel->delete($id_dokter);

            $result = [
                'success' => 'Data Dokter Berhasil Di Hapus'
            ];

            echo json_encode($result);
        } else {
            exit('404 Not Found');
        }
    }





}
