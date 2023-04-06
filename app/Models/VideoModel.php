<?php

namespace App\Models;

use CodeIgniter\Model;


class VideoModel extends Model
{
    protected $table = 'videos';
    protected $primaryKey = 'id_video';

    protected $allowedFields = ['title', 'duration', 'path_video', 'path_thumbnail', 'kategory_id', 'name_thumbnail', 'name_video', 'rating'];

    // Pengecekan jumlah data video
    public function countVideo()
    {
        $db = db_connect();
        $data = $db->query("SELECT COUNT(*) AS jumlah FROM videos");
        // cetak jumlah data
        $jumlah = $data->getRow();
        return $jumlah;
    }

    public function getNameThumbnail($id)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT name_thumbnail FROM videos WHERE id_video='$id'";
        $response = $db->query($sql);
        return $response->getResult()[0];
    }

    public function getNameVideo($id)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT name_video FROM videos WHERE id_video='$id'";
        $response = $db->query($sql);
        return $response->getResult()[0];
    }

    public function getCategory()
    {
        $query = $this->db->table('videos');
        $query->select('kategory_video.id_kategory_video, kategory_video.category_name');
        $query->join('kategory_video', 'videos.kategory_id = kategory_video.id_kategory_video', 'right');
        $query->groupBy('kategory_video.id_kategory_video');
        return $query->get()->getResult();
    }

    public function updateVideo($id, $data)
    {
        $db = \Config\Database::connect();
        $sql = "UPDATE videos
        SET title='$data[title]', duration='$data[duration]', path_thumbnail='$data[path_thumbnail]', kategory_id='$data[kategory_id]', name_thumbnail='$data[name_thumbnail]'
        WHERE id_video='$id'";
        $db->query($sql);
        return $db->affectedRows();
    }
    public function deleteVideo($id)
    {
        $db = \Config\Database::connect();
        $sql = "DELETE FROM videos WHERE id_video='$id'";
        $db->query($sql);
        return $db->affectedRows();
    }
    public function viewByCategoryId($id)
    {
        $query = $this->db->table('videos');
        $query->select('videos.*');
        $query->join('kategory_video', 'videos.kategory_id = kategory_video.id_kategory_video', 'inner');
        $query->where("videos.kategory_id = '$id'");
        return $query->get()->getResult();
    }

    public function rating($rating, $id)
    {
        $db = \Config\Database::connect();
        $sql = "UPDATE videos
        SET rating='$rating'
        WHERE id_video='$id'";
        $db->query($sql);
        return $db->affectedRows();
    }
}
