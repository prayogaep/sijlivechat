<?php

namespace App\Models;

use CodeIgniter\Model;

class m_livechat extends Model
{
    protected $table            = 'tbl_livechat'; // nama tabel yang ada di database
    protected $primaryKey       = 'id_livechat'; // kolom primary key yang ada di tabel tbl_livechat
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['kategori_id', 'user_id', 'keterangan', 'tanggal_aduan', 'operator_id', 'tanggal_selesai', 'status']; // Kolom yang diperbolehkan diisi dari inputan 

    function getFullData($id = null, $status = 0, $kategori = '',  $mark = 'detail')
    {
        $this->select('tbl_livechat.*, tbl_kategori.nama_kategori, tbl_user.username, tbl_asn.*');
        $this->join('tbl_kategori', 'tbl_livechat.kategori_id = tbl_kategori.id_kategori');
        $this->join('tbl_asn', 'tbl_livechat.user_id = tbl_asn.user_id');
        $this->join('tbl_user', 'tbl_livechat.operator_id = tbl_user.id_user', 'left');
        $this->where('tbl_livechat.status', $status);
        if ($id != null) {
            $this->where('tbl_livechat.user_id', $id);
        }
        if ($kategori != '') {
            $this->where('tbl_livechat.kategori_id', $kategori);
        }
        if ($mark != 'detail') {
            return $this->get()->getRowArray();
        }
        return $this->get()->getResultArray();
    }

    function getDetailAduan($id)
    {
        $this->join('tbl_kategori', 'tbl_livechat.kategori_id = tbl_kategori.id_kategori');
        $this->join('tbl_asn', 'tbl_livechat.user_id = tbl_asn.user_id');
        $this->where('id_livechat', $id);
        return $this->get()->getRowObject();
    }

    function getJumlahAduan($status = '', $waktu = '', $id = null)
    {
        if ($waktu != '') {
            $this->like('tanggal_aduan', $waktu);
        }
        if ($status != '') {
            $this->where('status', $status);
        }
        
        if ($id) {
            $this->where('user_id', $id);
        }
        return $this->countAllResults();
    }

    function getJumlahAduanOperator($waktu = '', $id = null)
    {
        $where = '';
        if ($id) {
            $where = "AND id_user = '$id'";
        }
        $query = $this->db->query("SELECT id_user, username, (SELECT COUNT(*) FROM tbl_livechat b where a.id_user = b.operator_id AND b.tanggal_aduan like '%$waktu%' $where) total FROM tbl_user a WHERE role_id = 2;");
        return $query->getResult();
        // $this->select("COUNT(*) total, operator_id, username");
        // $this->join('tbl_user', 'tbl_livechat.operator_id = tbl_user.id_user');
        // $this->where('operator_id !=', null);
        // if ($waktu != '') {
        //     $this->like('tanggal_aduan', $waktu);
        // }
        // $this->groupBy('operator_id');
        // return $this->get()->getResult();
    }
    function getJumlahAduanKategori($waktu = '', $id = null)
    {
        // $this->select("COUNT(*) total, kategori_id, nama_kategori");
        // $this->join('tbl_kategori', 'tbl_livechat.kategori_id = tbl_kategori.id_kategori');
        // $this->groupBy('kategori_id');
        // return $this->get()->getResult();
        $query = $this->db->query("SELECT *, (SELECT COUNT(*) FROM tbl_livechat b WHERE b.kategori_id = a.id_kategori AND b.tanggal_aduan like '%$waktu%') total FROM tbl_kategori a");
        return $query->getResult();
    }

    function getJumlahAduanUser($id = '', $status = '')
    {
        if ($status != '') {
            $this->where('status', $status);
        }
        if ($id != '') {
            $this->where('user_id', $id);
        }
        return $this->countAllResults();
    }
}
