<?php namespace App\Models;

use CodeIgniter\Model;

class BarangDistributorModel extends Model
{
    protected $table      = 'barang_distributor';
    protected $primaryKey = 'id';

    protected $returnType     = 'array';

    protected $allowedFields = ['foto','nama_barang','jenis_barang_id', 'ukuran_barang_id','stok','harga_dasar','harga_jual','keterangan'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getBarang()
    {
        $builder = $this->db->table($this->table);
        $builder->select('barang_distributor.*');
        $builder->select('ukuran_barang.id as ukuran_barang_id,ukuran_barang.nama as ukuran_barang_nama');
        $builder->select('jenis_barang.id as jenis_barang_id,jenis_barang.nama as jenis_barang_nama');
        $builder->join('jenis_barang', 'jenis_barang.id = barang_distributor.jenis_barang_id');
        $builder->join('ukuran_barang', 'ukuran_barang.id = barang_distributor.ukuran_barang_id');
        $query = $builder->get()->getResultArray();
        return $query;
    }
    
    public function getLastId()
    {
        return $this->db->insertID();
    }
}