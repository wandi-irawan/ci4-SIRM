<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class PoliController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Data Poli',
            'polis' => $this->PoliModel->orderBy('id_poli', 'DESC')->findAll(),
            'validation' => $this->validation
        ];

        return view('admin/poli/index', $data);
    }

    public function insert()
    {
        // validasi input
        $rules = $this->validate([
            'nama_poli' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama poli harus di isi',
                ]
            ]
        ]);

        // jika gagal
        if (!$rules) {
            // kembali dan tampil errornya
            return redirect()->back()->with('failed', $this->validation->getErrors());
        }

        // jika berhasil insert ke db
        $data = [
            'nama_poli' => strip_tags($this->request->getPost('nama_poli'))
        ];

        $this->PoliModel->insert($data);

        // kalau berhasil kembalikan dan tampil pesan
        return redirect()->back()->with('success', 'Data Poli Berhasil Ditambahkan');

    }

    public function update($id_pasien)
    {
        // validasi input
        $rules = $this->validate([
            'nama_poli' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama poli harus di isi'
                ]
            ]
        ]);

        // jika gagal
        if (!$rules) {
            // kembali dan tampil errornya
            return redirect()->back()->with('failed', $this->validation->getErrors());
        }

        // jika berhasil update ke db
        $data = [
            'nama_poli' => strip_tags($this->request->getPost('nama_poli'))
        ];

        $this->PoliModel->update($id_pasien, $data);

        // kalau berhasil kembalikan dan tampil pesan
        return redirect()->back()->with('success', 'Data Poli Berhasil Diubah');
    }

    public function delete($id_pasien)
    {
        $this->PoliModel->delete($id_pasien);

        return redirect()->back()->with('success', 'Data Poli Berhasil Dihapus');
    }

}
