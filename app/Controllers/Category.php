<?php

namespace App\Controllers;

use App\Models\CategoryModel;

class Category extends BaseController
{
    public function __construct()
    {
        $this->categoryModel = new CategoryModel();
    }

    public function addData()
    {
        $nameCategory = $this->request->getPost('name');
        $thumbnail = $this->request->getFile('thumbnail');


        if ($thumbnail->isValid() && !$thumbnail->hasMoved()) {
            $thumbnailName = $thumbnail->getRandomName();
            $thumbnail->move('thumbnail', $thumbnailName);
        }

        $data = [
            'category_name' => $nameCategory,
            'path_image' => base_url('thumbnail') . '/' . $thumbnailName,
            'name_thumbnail' => $thumbnailName
        ];

        $this->categoryModel->insert($data);


        return redirect()->to(base_url('user/category'));
    }
    // 
    public function updateData()
    {
        $oldId = $this->request->getPost('old_id');
        $nameCategory = $this->request->getPost('name');
        $thumbnail = $this->request->getFile('thumbnail');

        $data =  $this->categoryModel->getThumbnail($oldId);

        $thumbnailName = $data->name_thumbnail;
        if (file_exists('thumbnail/' . $thumbnailName)) {
            unlink('thumbnail/' . $thumbnailName);
            $thumbnailName = $thumbnail->getRandomName();
            $thumbnail->move('thumbnail', $thumbnailName);
        }

        $data = [
            'category_name' => $nameCategory,
            'path_image' => base_url('thumbnail') . '/' . $thumbnailName,
            'name_thumbnail' => $thumbnailName
        ];
        $result = $this->categoryModel->updateKategori($oldId, $data);

        if ($result != 1) {
            session()->setFlashdata('gagal', 'Update Data Gagal');
        }

        return redirect()->to(base_url('user/category'));
    }

    // 
    public function delete($id)
    {
        $data =  $this->categoryModel->getThumbnail($id);
        $result = $this->categoryModel->deleteCategory($id);
        if (file_exists('thumbnail/' . $data->name_thumbnail)) {
            unlink('thumbnail/' . $data->name_thumbnail);
        }

        if ($result != 1) {
            session()->setFlashdata('gagal', 'Delete Data Gagal');
        }
        return redirect()->to(base_url('user/category'));
    }
}
