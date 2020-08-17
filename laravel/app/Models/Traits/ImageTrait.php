<?php

namespace App\Models\Traits;

trait ImageTrait
{
    public function setImageAttribute($image)
    {
        if (isset($this->attributes['image'])) {
            $this->deleteImage();
        }

        $this->attributes['image'] = $this->saveUploadedImage($image, $this->name);
    }

    protected function deleteImage($image_key = 'image')
    {
        $image = $this->attributes[$image_key];
        if (!$image) return;

        $image = public_path($image);

        if (is_file($image)) {
            unlink($image);
        }
    }

    protected function saveUploadedImage($image, $name, $dir = '') {
        if (!$image) return;

        $dir = $dir ? $dir : $this->table;

        // Папка с картинками
        $img_path = $dir ? 'uploads' . DIRECTORY_SEPARATOR . $dir : 'uploads';

        $date = date('Y/m');
        $folder = public_path() . DIRECTORY_SEPARATOR . $img_path . DIRECTORY_SEPARATOR . $date;


        if (!is_dir($folder)) {
            mkdir($folder, 0777, 1);
        }

        $name =  substr(str_slug($name), 0, 8) . '_' . microtime(1);
        $image_name = $name . '.' . $image->getClientOriginalExtension();

        $image->move($folder, $image_name);

        return $img_path . DIRECTORY_SEPARATOR . $date . DIRECTORY_SEPARATOR . $image_name;
    }
}
