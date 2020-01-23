<?php

function saveUploadedImage($image, $name) {
	if (!$image) return;

	// Папка с картинками
	$img_path = 'uploads/';

	$date = date('Y/m/');
    $folder = public_path() . DIRECTORY_SEPARATOR . $img_path . $date;


	if (!is_dir($folder)) {
		mkdir($folder, 0777, 1);
	}

    $name =  substr(str_slug($name), 0, 8) . '_' . microtime(1);
	$image_name = $name . '.' . $image->getClientOriginalExtension();

    $image->move($folder, $image_name);

    return $img_path . $date . $image_name;
}


function resize_image($source_file, $target_file, $w, $h, $crop=FALSE) {

    $imgsize = getimagesize($source_file);

    switch ($imgsize['mime']) {
        case 'image/gif':
            $image_create = "imagecreatefromgif";
            break;

        case 'image/png':
            $image_create = "imagecreatefrompng";
            break;

        case 'image/jpeg':
            $image_create = "imagecreatefromjpeg";
            break;
        case 'image/webp':
            $image_create = "imagecreatefromwebp";
            break;
        default:
            return false;
            break;
    }


    $width = $imgsize[0];
    $height = $imgsize[1];

    $r = $width / $height;
    if ($crop) {
        if ($width > $height) {
            $width = ceil($width-($width*abs($r-$w/$h)));
        } else {
            $height = ceil($height-($height*abs($r-$w/$h)));
        }
        $newwidth = $w;
        $newheight = $h;
    } else {
        if ($w/$h > $r) {
            $newwidth = $h*$r;
            $newheight = $h;
        } else {
            $newheight = $w/$r;
            $newwidth = $w;
        }
    }
    $src = $image_create($source_file);
    $dst = imagecreatetruecolor($newwidth, $newheight);


    imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

    imagejpeg($dst, $target_file);
}

/**
 * Ресайз картинок
 * image - путь к картинке
 * width - ширина
 * height - высота
 * crop - резать или не резать
 * string - путь к уменьшенной картинке
 */
function resize($image, $width, $height, $crop = true)
{
    $app_url = isset($_SERVER['APP_URL']) ? $_SERVER['APP_URL'] : '';
    $image = str_replace($app_url, '', $image);

    if (strpos($image, 'http') === 0) {
        return $image;
    }


    $image = trim($image, '/');
    $ext = last(explode('.', $image));
    $img_name = last(explode('/', $image));
    $new_img_name = substr($img_name, 0, 8) . '-' . $width . 'x' . $height . '-' . md5($img_name);
    $new_img_name = str_slug($new_img_name) . '.' . $ext;

    $cache_path = 'uploads/cache/';

    if (!is_dir($cache_path)) {
        mkdir($cache_path, 0777, true);
    }

    $new_file = $cache_path . $new_img_name;

    if (file_exists($image) && !file_exists($new_file)) {
        resize_image($image, $new_file, $width, $height, $crop);
    }

    return '/' . $new_file;
}





function settings($key, $default = null)
{
    $settings = Cache::rememberForever($key, function() use ($key) {
        return \App\Models\Settings::where('key', $key)->first();
    });

    if (!$settings) return $default;

    return $settings->value;
}

function clearphone($number) {
	return preg_replace("/[^\+0-9]/", '', $number);
}
