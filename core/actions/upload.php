<?php

class upload
{
    public function _userBanner_()
    {
        $uploaddir = "uploads/users/banner";
        $files = $_FILES;
        $done_files = [];
        foreach($files as $file)
        {
            $size = $file['size'];
            $format = explode('.',$file['name']);
            $format = $format[count($format) - 1];
            $name = hash('crc32', time()) . '.' . $format;
            $type = $file['type'];
            $i = getimagesize($file["tmp_name"]);
            $width = $i[0];
            $height = $i[1];

            if($size > 99999999)
            {
                die( json_encode(['error', 1]) );
            }
            if($width >= 2560 and $height >= 1440)
            {
                if(move_uploaded_file($file['tmp_name'], "$uploaddir/{$_SESSION['user']['id']}_$name"))
                {
                    include_once "core/controllers/DB.php";
                    $config = include "core/config/default.php";
                    $db = new DB($config['DB']['name'], $config['DB']['user'], $config['DB']['pass'], $config['DB']['host'], $config['DB']['type']);

                    $db -> updateRow("UPDATE `users` SET `big_avatar` = ?, `bannerSRC`", ["$uploaddir/{$_SESSION['user']['id']}_$name", "$uploaddir/{$_SESSION['user']['id']}_$name"]);
                    echo json_encode(['success',"$uploaddir/{$_SESSION['user']['id']}_$name"]);
                }
            }

        }
    }

    public function _bannerNew_()
    {
        $image = $_POST['from'];
        $to = 'uploads/users/banner-croped';
        $name = explode('/', $image);
        $name = end($name);
        $x_o = $_POST['left'];
        $y_o = $_POST['top'];
        $w_o = $_POST['width'];
        $h_o = $_POST['height'];

        if (($x_o < 0) || ($y_o < 0) || ($w_o < 0) || ($h_o < 0)) {
            echo "Некорректные входные параметры";
            return false;
        }else{
            list($w_i, $h_i, $type) = getimagesize($image);
            $types = ["", "gif", "jpeg", "png"];
            $ext = $types[$type];
            if ($ext) {
                $func = 'imagecreatefrom' . $ext;
                $img_i = $func($image);
            }else{
                echo 'Некорректное изображение';
                return false;
            }
            $img_o = imagecreatetruecolor($w_o, $h_o);
            imagecopy($img_o, $img_i, 0, 0, $x_o, $y_o, $w_o, $h_o);
            $func = 'image'.$ext;
            copy($image, $to . '/' . $name);
            $func($img_o, $to . "/" . $name);
            include_once "core/controllers/DB.php";
            $config = include "core/config/default.php";
            $db = new DB($config['DB']['name'], $config['DB']['user'], $config['DB']['pass'], $config['DB']['host'], $config['DB']['type']);

            $db -> updateRow("UPDATE `users` SET `big_avatar` = ?", [$to . "/" . $name]);
            echo $to . "/" . $name;

        }
    }

    public function _deleteUserBanner_()
    {
        include_once "core/controllers/DB.php";
        $config = include "core/config/default.php";
        $db = new DB($config['DB']['name'], $config['DB']['user'], $config['DB']['pass'], $config['DB']['host'], $config['DB']['type']);

        $db -> updateRow("UPDATE `users` SET `big_avatar` = ?", ['/app/tmpl/img/avatar/matrix_nofoto.jpg']);
    }

    public function _editUserBanner_()
    {
        include_once "core/controllers/DB.php";
        $config = include "core/config/default.php";
        $db = new DB($config['DB']['name'], $config['DB']['user'], $config['DB']['pass'], $config['DB']['host'], $config['DB']['type']);

        $db -> updateRow("UPDATE `users` SET `big_avatar` = ?", ['/app/tmpl/img/avatar/matrix_nofoto.jpg']);
    }

}









//        $aInitialImageFilePath = $_POST['from'];
//        $aNewImageFilePath = $_POST['to'];
//        $aNewImageWidth = $_POST['width'];
//        $aNewImageHeight = $_POST['height'];
//
//            if (($aNewImageWidth < 0) || ($aNewImageHeight < 0)){
//                return false;
//            }
//
//            $lAllowedExtensions = array(1 => "gif", 2 => "jpeg", 3 => "png");
//
//            list($lInitialImageWidth, $lInitialImageHeight, $lImageExtensionId) = getimagesize($aInitialImageFilePath);
//
//            if(!array_key_exists($lImageExtensionId, $lAllowedExtensions)) {
//                return false;
//            }
//            $lImageExtension = $lAllowedExtensions[$lImageExtensionId];
//
//            $func = 'imagecreatefrom' . $lImageExtension;
//
//            $lInitialImageDescriptor = $func($aInitialImageFilePath);
//
//            $lCroppedImageWidth = 0;
//            $lCroppedImageHeight = 0;
//            $lInitialImageCroppingX = 0;
//            $lInitialImageCroppingY = 0;
//            if ($aNewImageWidth / $aNewImageHeight > $lInitialImageWidth / $lInitialImageHeight){
//                $lCroppedImageWidth = floor($lInitialImageWidth);
//                $lCroppedImageHeight = floor($lInitialImageWidth * $lCroppedImageHeight / $aNewImageWidth);
//                $lInitialImageCroppingY = floor( ($lInitialImageHeight - $lCroppedImageHeight) / 2);
//            }else{
//                $lCroppedImageWidth = floor($lInitialImageHeight * $lInitialImageWidth / $aNewImageHeight);
//                $lCroppedImageHeight = floor($lInitialImageHeight);
//                $lInitialImageCroppingX = floor( ($lInitialImageWidth- $lCroppedImageWidth) / 2);
//            }
//
//            $lNewImageDescriptor = imagecreatetruecolor($aNewImageWidth, $aNewImageHeight);
//            imagecopyresampled($lNewImageDescriptor, $lInitialImageDescriptor, 0, 0, $lInitialImageCroppingX, $lInitialImageCroppingY, $aNewImageWidth, $aNewImageHeight, $lInitialImageWidth, $lInitialImageHeight);
//            $func = 'image' . $lImageExtension;
//
//            return $func($lNewImageDescriptor, $aNewImageFilePath);
