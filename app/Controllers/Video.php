<?php

namespace App\Controllers;

use App\Models\VideoModel;

class Video extends BaseController
{

    public function __construct()
    {
        $this->videoModel = new VideoModel();
    }
    // 
    public function addData()
    {
        $title = $this->request->getPost('name');
        $duration = $this->request->getPost('duration');
        $thumbnail = $this->request->getFile('thumbnail');
        $category = $this->request->getPost('category');
        $video = $this->request->getFile('video');

        if ($video->isValid() && !$video->hasMoved()) {
            // rubah nama video video menjadi random pada codeigniter
            $newNameVideo = $video->getRandomName();
            // pindahkan video video ke folder video
            $video->move('video', $newNameVideo);
        }
        if ($thumbnail->isValid() && !$thumbnail->hasMoved()) {
            // rubah nama video video menjadi random pada codeigniter
            $newNameThumbnail = $thumbnail->getRandomName();
            // pindahkan video video ke folder video
            $thumbnail->move('thumbnail', $newNameThumbnail);
        }

        $data = [
            'title' => $title,
            'duration' => $duration,
            'path_video' => base_url('video') . '/' . $newNameVideo,
            'path_thumbnail' => base_url('thumbnail') . '/' . $newNameThumbnail,
            'kategory_id' => $category,
            'name_thumbnail' => $newNameThumbnail,
            'name_video' => $newNameVideo
        ];

        $this->videoModel->insert($data);
        return redirect()->to(base_url('user/video'));
    }

    // Delete
    public function delete($id)
    {
        $thumbnailName =  $this->videoModel->getNameThumbnail($id);
        $videoName =  $this->videoModel->getNameVideo($id);

        $result = $this->videoModel->deleteVideo($id);

        unlink('thumbnail/' . $thumbnailName->name_thumbnail);
        unlink('video/' . $videoName->name_video);

        if ($result != 1) {
            session()->setFlashdata('gagal', 'Delete Data Gagal');
        }
        return redirect()->to(base_url('user/video'));
    }

    // Update Data
    public function updateData()
    {
        $oldId = $this->request->getPost('old_id');
        $title = $this->request->getPost('name');
        $duration = $this->request->getPost('duration');
        $thumbnail = $this->request->getFile('thumbnail');
        $category = $this->request->getPost('category');

        // jika ada upload thumbnail tidak nul


        if ($thumbnail->isValid() && !$thumbnail->hasMoved()) {
            $id =  $this->videoModel->getNameThumbnail($oldId);

            $thumbnailName = $id->name_thumbnail;
            if (file_exists('thumbnail/' . $thumbnailName)) {
                unlink('thumbnail/' . $thumbnailName);
                $thumbnailName = $thumbnail->getRandomName();
                $thumbnail->move('thumbnail', $thumbnailName);
                $path_thumbnail = base_url('thumbnail') . '/' . $thumbnailName;
            }
        } {
            $id =  $this->videoModel->getNameThumbnail($oldId);
            $thumbnailName = $id->name_thumbnail;
            $path_thumbnail = base_url('thumbnail') . '/' . $thumbnailName;
        }


        $data = [
            'title' => $title,
            'duration' => $duration,
            'path_thumbnail' => $path_thumbnail,
            'kategory_id' => $category,
            'name_thumbnail' => $thumbnailName
        ];

        $result = $this->videoModel->updateVideo($oldId, $data);

        if ($result != 1) {
            session()->setFlashdata('gagal', 'Update Data Gagal');
        }

        return redirect()->to(base_url('user/video'));
    }
}
