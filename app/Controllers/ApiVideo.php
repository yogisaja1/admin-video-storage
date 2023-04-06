<?php

namespace App\Controllers;

use App\Models\VideoModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class ApiVideo extends ResourceController
{
    use ResponseTrait;
    // all users
    // json
    protected $format = 'json';

    public function index()
    {
        $model = new VideoModel();
        $data['video'] = $model->orderBy('id_video', 'DESC')->findAll();
        return $this->respond($data);
    }

    // single user
    public function show($id = null)
    {
        $model = new VideoModel();
        $data = $model->viewByCategoryId($id);
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('Data video tidak ditemukan.');
        }
    }


    // Get Data Video By Rating Desc
    public function getVideoByRatingDesc()
    {
        $model = new VideoModel();
        // tampilkan juga nama kategori dari relasi tabel kategori
        $model->select('videos.*, kategory_video.category_name');
        $model->join('kategory_video', 'kategory_video.id_kategory_video = videos.kategory_id');
        $model->orderBy('rating', 'DESC');
        $data = $model->findAll();
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('Data video tidak ditemukan.');
        }
    }

    // api ubah rating
    // method post
    public function updateRating()
    {
        $data = $this->request->getJSON();
        $model = new VideoModel();
        $id_video = $data->id_video;
        $rating = $data->rating;

        $data = [
            'rating' => $rating
        ];

        $model->update($id_video, $data);
        $response = [
            'status'   => 200,
            'error'    => null,
            'messages' => [
                'success' => 'Rating berhasil diubah.',
                'data' => $id_video,
                'rating' => $rating
            ]
        ];
        return $this->respond($response);
    }
}
