<?php

namespace App\Controllers;

use App\Models\m_livechat;

class c_dashboard extends BaseController
{
    protected $livechat;

    public function __construct()
    {
        $this->livechat = new m_livechat();
    }
    public function index()
    {
        $jumlah_aduan = "";
        $jumlah_aduan_selesai = "";
        $jumlah_aduan_belum_selesai = "";

        if (session('id_role') == 3) {
            $jumlah_aduan = $this->livechat->getJumlahAduanUser(session('id_user'));
            $jumlah_aduan_selesai = $this->livechat->getJumlahAduanUser(session('id_user'), "1");
            $jumlah_aduan_belum_selesai = $this->livechat->getJumlahAduanUser(session('id_user'), "0");
            $livechat = $this->livechat->getFullData(session('id_user'));// ini berangkat ke model m_kelolauser
        } else {
            $jumlah_aduan = $this->livechat->getJumlahAduanUser();
            $jumlah_aduan_selesai = $this->livechat->getJumlahAduanUser('', "1");
            $jumlah_aduan_belum_selesai = $this->livechat->getJumlahAduanUser('', "0");
            $livechat = $this->livechat->getFullData();// ini berangkat ke model m_kelolauser
        }
        $data = [
            'title' => 'Dashboard',
            'jumlah_aduan' => $jumlah_aduan,
            'jumlah_aduan_selesai' => $jumlah_aduan_selesai,
            'jumlah_aduan_belum_selesai' => $jumlah_aduan_belum_selesai,
            'livechat' => $livechat,
        ];
        return view('dashboard/v_dashboard', $data);
    }
}
