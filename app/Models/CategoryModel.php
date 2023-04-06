<?php

namespace App\Models;

use CodeIgniter\Model;


class CategoryModel extends Model
{
    protected $table = 'kategory_video';
    protected $primaryKey = 'id_kategory_video';

    protected $allowedFields = ['category_name', 'path_image', 'name_thumbnail'];



    public function deleteCategory($id)
    {
        $db = \Config\Database::connect();
        $sql = "DELETE FROM kategory_video WHERE id_kategory_video='$id'";
        $db->query($sql);
        return $db->affectedRows();
    }

    public function getCategory()
    {
        $query = $this->db->table('kategory_video');
        $query->select('kategory_video.id_kategory_video, kategory_video.category_name, kategory_video.path_image, kategory_video.name_thumbnail, COUNT(videos.kategory_id) AS video_count');
        $query->join('videos', 'kategory_video.id_kategory_video = videos.kategory_id', 'left');
        $query->groupBy('kategory_video.id_kategory_video');

        return $query->get()->getResult();
    }

    public function getThumbnail($id)
    {
        $db = \Config\Database::connect();
        $sql = "SELECT name_thumbnail FROM kategory_video WHERE id_kategory_video='$id'";
        $response = $db->query($sql);
        return $response->getResult()[0];
    }

    public function updateKategori($id, $data)
    {
        $db = \Config\Database::connect();
        $sql = "UPDATE kategory_video
        SET category_name='$data[category_name]', path_image='$data[path_image]', name_thumbnail='$data[name_thumbnail]'
        WHERE id_kategory_video='$id'";
        $db->query($sql);
        return $db->affectedRows();
    }
}
