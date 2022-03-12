<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class ObatController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Data Obat',
            'obats' => $this->ObatModel->orderBy('id_obat', 'DESC')->findAll(),
            // 'validation' => $this->validation
        ];

        return view('admin/obat/index', $data);
    }

    public function view_insert()
    {
        $data = [
            'title' => 'Tambah Data Obat',
            'validation' => $this->validation
        ];

        return view('admin/obat/tambah', $data);
    }

    public function insert()
    {
        // validasi input
        $rules = $this->validate([
            'nama_dokter' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'nama dokter tidak boleh kosong',
                ]
            ],
            'nama_obat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'nama obat tidak boleh kosong',

                ]
            ],
            'dosis' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'dosis tidak boleh kosong',
                ]
            ],
            'aturan_pakai' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'aturan pakai tidak boleh kosong',
                ]
            ],
            'jumlah' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'jumlah tidak boleh kosong',
                ]
            ]



        ]);

        // jika gagal validasi
        if (!$rules) {
            session()->setFlashdata('failed', $this->validation->getErrors());
            return redirect()->back()->withInput();
        } // 


        // ambil data reques untuk dimasukan ke db
        $data = [
            'nama_dokter'              => strip_tags($this->request->getPost('nama_dokter')),
            'nama_obat'                => strip_tags($this->request->getPost('nama_obat')),
            'dosis'               => strip_tags($this->request->getPost('dosis')),
            'aturan_pakai'             => strip_tags($this->request->getPost('aturan_pakai')),
            'jumlah'      => strip_tags($this->request->getPost('jumlah')),

        ];
        $this->ObatModel->insert($data);

        return redirect()->to(base_url('obat'))->with('success', 'Data Obat Berhasil Di Tambahkan');
    }


    public function detail($id_obat)
    {
        $data = [
            'title' => 'Detail Data Obat',
            'obat' => $this->ObatModel->where('id_obat', $id_obat)->first()
        ];

        return view('admin/obat/detail', $data);
    }

    public function delete()
    {
        if ($this->request->isAJAX()) {


            $id_obat = $this->request->getVar('id_obat');
            // cari data berdasarkan id
            // SELECT * FROM tbl_pasien WHERE id_pasien = $id_pasien // fungsi di native
            $data = $this->ObatModel->find($id_obat);

            // fungsi hapus data dari database
            $this->ObatModel->delete($id_obat);

            $result = [
                'success' => 'Data Obat Berhasil Di Hapus'
            ];

            echo json_encode($result);
        } else {
            exit('404 Not Found');
        }
    }



    public function view_update($id_obat)
    {
        $data = [
            'title' => 'Ubah Data Obat',
            'obat' => $this->ObatModel->find($id_obat),
            'validation' => $this->validation
        ];
        return view('admin/obat/ubah', $data);
    }


    public function update($id_obat)
    {
        // validasi input
        $rules = $this->validate([
            'nama_dokter' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'nama dokter tidak boleh kosong'

                ]
            ],
            'nama_obat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'nama obat tidak boleh kosong'

                ]
            ],
            'dosis' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'dosis tidak boleh kosong'

                ]
            ],
            'aturan_pakai' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'aturan tidak boleh kosong'

                ]
            ],
            'jumlah' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'jumlah tidak boleh kosong'

                ]
            ]

        ]);

        // jika gagal validasi
        if (!$rules) {
            session()->setFlashdata('failed', $this->validation->getErrors());
            return redirect()->back()->withInput();
        }


        // ambil data reques untuk dimasukan ke db
        $data = [
            'nama_dokter'              => strip_tags($this->request->getPost('nama_dokter')),
            'nama_obat'                => strip_tags($this->request->getPost('nama_obat')),
            'dosis'               => strip_tags($this->request->getPost('dosis')),
            'aturan_pakai'             => strip_tags($this->request->getPost('aturan_pakai')),
            'jumlah'      => strip_tags($this->request->getPost('jumlah'))

        ];
        $this->ObatModel->update($id_obat, $data);

        return redirect()->to(base_url('obat'))->with('success', 'Data Obat Berhasil Di Ubah');
    }
}
