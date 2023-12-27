<?php

namespace App\Controllers;

use App\Models\m_livechat;

class c_laporan extends BaseController
{
    protected $livechat;

    public function __construct()
    {
        $this->livechat = new m_livechat();
    }
    public function index()
    {
        $bulan = [
            "01" => "Januari",
            "02" => "Februari",
            "03" => "Maret",
            "04" => "April",
            "05" => "Mei",
            "06" => "Juni",
            "07" => "Juli",
            "08" => "Agustus",
            "09" => "September",
            "10" => "Oktober",
            "11" => "November",
            "12" => "Desember"
        ];
        $rBulan = $this->request->getGet('bulan') ?? '';
        $rTahun = $this->request->getGet('tahun') ?? '';
        if ($this->request->getGet('bulan') && $this->request->getGet('tahun')) {
            $waktu = $rTahun . "-" . $rBulan;
        } else {
            $waktu = '';
        }
        $id = null;
        if (session('id_role') == 3) {
            $id = session('id_user');
        }

        $jumlah_aduan = $this->livechat->getJumlahAduan('', $waktu, $id);
        $jumlah_aduan_selesai = $this->livechat->getJumlahAduan("1", $waktu, $id);
        $jumlah_aduan_belum_selesai = $this->livechat->getJumlahAduan("0", $waktu, $id);
        $jumlah_peroperator = $this->livechat->getJumlahAduanOperator($waktu, $id);
        $jumlah_perkategori = $this->livechat->getJumlahAduanKategori($waktu, $id);

        $data = [
            'title' => 'Laporan',
            'jumlah_aduan' => $jumlah_aduan,
            'jumlah_aduan_selesai' => $jumlah_aduan_selesai,
            'jumlah_aduan_belum_selesai' => $jumlah_aduan_belum_selesai,
            'jumlah_peroperator' => $jumlah_peroperator,
            'jumlah_perkategori' => $jumlah_perkategori,
            'bulan' => $bulan,
        ];
        return view('laporan/v_laporan', $data);
    }
}
