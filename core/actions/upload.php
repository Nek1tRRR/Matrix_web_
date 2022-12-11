<?php

class upload
{
    public function _userBanner_()
    {
        if(!empty($_FILES))
        {
            include_once "core/controllers/DB.php";
            $config = include "core/config/default.php";
            $db = new DB($config['DB']['name'], $config['DB']['user'], $config['DB']['pass'], $config['DB']['host'], $config['DB']['type']);
            $query = $db->getRow("SELECT `big_avatar`, `bannerSRC` FROM `users` WHERE `id` = ?", [$_SESSION['user']['id']]);
            if($query['bannerSRC'] !== '/app/tmpl/avatar/matrix_nofoto.jpg')
            {
                unlink($query['big_avatar']);
                unlink($query['bannerSRC']);
            }
            $uploaddir = 'uploads/users/banner';
            $uploaddir2 = 'upload/users/banner-croped';
            $files = $_FILES;
            $done_files = [];
            foreach ($files as $file)
            {
                $size = $file['size'];
                $format = explode('.',$file['name']);
                $format = $format[count($format) - 1];
                $name = rand(11111, 99999) . '.' . $format;
                $type = $file['type'];
                $i = getimagesize($file["tmp_name"]);
                $width = $i[0];
                $height = $i[1];

                if ($size > 99999999)
                {
                    die(json_encode(['error', 1]) );
                }
                if ($width >= 2560 and $height >= 1440)
                {
                    if (move_uploaded_file($file['tmp_name'], "$uploaddir/{$_SESSION['user']['id']}_$name"))
                    {
                        $db->updateRow("UPDATE `users` SET `big_avatar` = ?, `bannerSRC` = ? WHERE `id` = ?", ["$uploaddir2/{$_SESSION['user']['id']}_$name", "$uploaddir/{$_SESSION['user']['id']}_$name", $_SESSION['user']['id']]);
                        echo json_encode(['success', "$uploaddir/{$_SESSION['user']['id']}_$name"]);
                    }
                }

            }
        }else{
            include_once "core/controllers/DB.php";
            $config = include "core/config/default.php";
            $db = new DB($config['DB']['name'], $config['DB']['user'], $config['DB']['pass'], $config['DB']['host'], $config['DB']['type']);
            $query = $db -> getRow("SELECT `bannerSRC` FROM `users` WHERE `id` = ?", [$_SESSION['user']['id']]);
            echo $query['bannerSRC'];
        }
    }

    public function _bannerNew_()
    {
        if(!empty($_POST))
        {
            include_once "core/controllers/DB.php";
            $config = include "core/config/default.php";
            $db = new DB($config['DB']['name'], $config['DB']['user'], $config['DB']['pass'], $config['DB']['host'], $config['DB']['type']);
            $query = $db -> getRow("SELECT `big_avatar` FROM `users` WHERE `id` = ?", [$_SESSION['user']['id']]);
            if($query['bannerSRC'] !== '/app/tmpl/avatar/matrix_nofoto.jpg')
            {
                unlink($query['bannerSRC']);
                unlink($query['big_avatar']);
            }
            $image = $_POST['from'];
            $to = 'uploads/users/banner-croped';
            $name = explode('/', $image);
            $name = end($name);
            $format = explode('.',$name);
            $format = $format[count($format) - 1];
            $name = rand(11111, 99999) . '.' . $format;
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
                $db -> updateRow("UPDATE `users` SET `big_avatar` = ? WHERE `id` = ?", [$to . "/" . $name, $_SESSION['user']['id']]);
                echo $to . "/" . $name;
            }
        }
    }

    public function _deleteUserBanner_()
    {
        include_once "core/controllers/DB.php";
        $config = include "core/config/default.php";
        $db = new DB($config['DB']['name'], $config['DB']['user'], $config['DB']['pass'], $config['DB']['host'], $config['DB']['type']);
        $query = $db -> getRow("SELECT `big_avatar`, `bannerSRC` FROM `users` WHERE `id` = ?", [$_SESSION['user']['id']]);
        $db -> updateRow("UPDATE `users` SET `big_avatar` = ?, `bannerSRC` = ? WHERE `id` = ?", ['/app/tmpl/img/avatar/matrix_nofoto.jpg', '/app/tmpl/img/avatar/matrix_nofoto.jpg', $_SESSION['user']['id']]);
        unlink($query['big_avatar']);
        unlink($query['bannerSRC']);
    }

    public function _newUserAvatar_()
    {
        if(!empty($_FILES))
        {
            include_once "core/controllers/DB.php";
            $config = include "core/config/default.php";
            $db = new DB($config['DB']['name'], $config['DB']['user'], $config['DB']['pass'], $config['DB']['host'], $config['DB']['type']);
            $uploaddir = 'uploads/users/avatar';
            $uploaddir2 = 'uploads/users/avatar-croped';
            $files = $_FILES;
            foreach ($files as $file)
            {
                $size = $file['size'];
                $format = explode('.',$file['name']);
                $format = $format[count($format) - 1];
                $name = rand(11111, 99999) . '.' . $format;
                $type = $file['type'];
                $i = getimagesize($file["tmp_name"]);
                $width = $i[0];
                $height = $i[1];
                $query = $db -> getRow("SELECT `avatarSRC`, `avatar` FROM `users` WHERE `id` = ?", [$_SESSION['user']['user']['id']]);
                if($query['avatarSRC'] != '/app/tmpl/img/avatar/matrix_nofoto.jpg')
                {
                    unlink($query['avatar']);
                    unlink($query['avatarSRC']);
                }

                if ($size > 99999999)
                {
                    die(json_encode(['error', 1]) );
                }
                if ($width >= 100 and $height >= 100)
                {
                    if (move_uploaded_file($file['tmp_name'], "$uploaddir/{$_SESSION['user']['id']}_$name"))
                    {
                        $db->updateRow("UPDATE `users` SET `avatar` = ?, `avatarSRC` = ? WHERE `id` = ?", ["$uploaddir2/{$_SESSION['user']['id']}_$name", "$uploaddir/{$_SESSION['user']['id']}_$name", $_SESSION['user']['id']]);
                        echo json_encode(['success', "$uploaddir/{$_SESSION['user']['id']}_$name"]);
                    }
                }
            }
        }
    }

    public function _editUserBanner_(){
        if(!empty($_POST))
        {
            include_once "core/controllers/DB.php";
            $config = include "core/config/default.php";
            $db = new DB($config['DB']['name'], $config['DB']['user'], $config['DB']['pass'], $config['DB']['host'], $config['DB']['type']);
            $image = $_POST['from'];
            $to = 'uploads/users/avatar-croped';
            $name = explode('/', $image);
            $name = end($name);
            $format = explode('.',$name);
            $format = $format[count($format) - 1];
            $name = rand(11111, 99999) . '.' . $format;
            $x_o = $_POST['left'];
            $y_o = $_POST['top'];
            $w_o = $_POST['width'];
            $h_o = $_POST['height'];
            if (($x_o < 0) || ($y_o < 0) || ($w_o < 0) || ($h_o < 0)) {
                echo "Некорректные входные параметры";
                return false;
            }else{
                $query = $db -> getRow("SELECT `avatar` FROM `users` WHERE `id` = ?", [$_SESSION['user']['user']['id']]);
                if($query['avatar'] != '/app/tmpl/img/avatar/no_signal.png' and file_exists($query['avatar']))
                {
                    unlink($query['avatar']);
                }
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
                $db -> updateRow("UPDATE `users` SET `avatar` = ? WHERE `id` = ?", [$to . "/" . $name, $_SESSION['user']['id']]);
                echo $to . "/" . $name;
            }
        }
    }

    public function _deleteUserAvatar_(){
        include_once "core/controllers/DB.php";
        $config = include "core/config/default.php";
        $db = new DB($config['DB']['name'], $config['DB']['user'], $config['DB']['pass'], $config['DB']['host'], $config['DB']['type']);
        $query = $db -> getRow("SELECT `avatar`, `avatarSRC` FROM `users` WHERE `id` = ?", [$_SESSION['user']['id']]);
        $db -> updateRow("UPDATE `users` SET `avatar` = ?, `avatarSRC` = ? WHERE `id` = ?", ['/app/tmpl/img/avatar/no_signal.png', '/app/tmpl/img/avatar/no_signal.png', $_SESSION['user']['id']]);
        unlink($query['avatar']);
        unlink($query['avatarSRC']);
    }

    public function _createPost_()
    {
        include_once "core/controllers/DB.php";
        $config = include "core/config/default.php";
        $db = new DB($config['DB']['name'], $config['DB']['user'], $config['DB']['pass'], $config['DB']['host'], $config['DB']['type']);
        $date = date("d-m-Y");
        $time = date("G-i");
        $query = $db -> insertRow("INSERT INTO `posts` (`id_user`,`text`,`date`,`time`) VALUES (?,?,?,?)", [$_SESSION['user']['id'], $_POST['text'], $date, $time]);
        if($query)
        {
            echo json_encode(['send', 'success']);
        }else{
            echo json_encode(['send', 'error']);
        }
    }

    public function _getPosts_()
    {
        if(!empty($_POST))
        {
            include_once "core/controllers/DB.php";
            $config = include "core/config/default.php";
            $db = new DB($config['DB']['name'], $config['DB']['user'], $config['DB']['pass'], $config['DB']['host'], $config['DB']['type']);
            include_once "core/controllers/User.php";
            $user = new User($_POST['login']);

            $query = $db ->getRows("SELECT * FROM `posts` WHERE `id_user` = ? ORDER BY `id` DESC", [$user -> id]);
            $count = $db ->getRow("SELECT  count(`id`) FROM `posts` WHERE `id_user` = ? ORDER BY `id` DESC", [$user -> id]);
            $text[] = '';

            for($i = 0; $i < $count['count(`id`)']; $i++)
            {

                $text[$i] =
                    "<div class = 'white-block post-block' style = 'width: calc(100% - 2vw)'>
                        <div class = 'flex-between top-block-post'>
                            <div class = 'flex-middle user-data-post'>
                                <div class = 'user-avatar-container-middle'>
                                    <a href = '/@".$user -> login."'>
                                        <img src = '".$user -> avatar."'>
                                    </a>
                                </div>
                                <div class = 'user-name-and-date'>
                                    <a href = '/@".$user -> login."'>". $user -> name . " " . $user -> surname ."</a>
                                    <div class = 'date-post-block'>".$query[$i]['date']." в ". $query[$i]['time'] ."</div>
                                </div>
                            </div>
                            <div class = 'edit-post-nav'>
                                <img src = '/app/tmpl/img/menu/more.png'>                            
                                <div class = 'edit-controll-post'>
                                    <ul>
                                        <li onclick = 'post.delete(".$query[$i]['id'].")'>Удалить</li>
                                        <li>Изменить</li>
                                    </ul>
                                </div> 
                            </div>
                        </div>
                        <div class = 'text-post'>
                            ".trim($query[$i]['text'])."
                        </div>
                    </div>";
            }
            $text['count'] = $count['count(`id`)'];
            echo json_encode($text);
        }
    }

    public function _delPosts_()
    {
        if(!empty($_POST['id']))
        {
            include_once "core/controllers/DB.php";
            $config = include "core/config/default.php";
            $db = new DB($config['DB']['name'], $config['DB']['user'], $config['DB']['pass'], $config['DB']['host'], $config['DB']['type']);
            $query = $db -> deleteRow("DELETE FROM `posts` WHERE `id` = ?", [$_POST['id']]);
            if($query)
            {
                echo json_encode(['send', 'success']);
            }else{
                echo json_encode(['send', 'error']);
            }
        }
    }

    public function _people_()
    {
        if(!empty($_POST))
        {
            if($_POST['f'] == 'all')
            {
                include_once "core/controllers/DB.php";
                $config = include "core/config/default.php";
                $db = new DB($config['DB']['name'], $config['DB']['user'], $config['DB']['pass'], $config['DB']['host'], $config['DB']['type']);

                $query = $db -> getRows("SELECT `id`, `login`, `name`, `surname`, `avatar` FROM `users` ORDER BY `id` DESC LIMIT 10");
                $count  = $db -> getRow("SELECT count(`id`) FROM `users`");
                $user = [];
                for($i = 0; $i < $count['count(`id`)']; $i++)
                {
                    $user[$i] = ["name" => $query[$i]['name'], "id" => $query[$i]['id'], "surname" => $query[$i]['surname'], "login" => $query[$i]['login'], "avatar" => $query[$i]['avatar']];
                }
                echo json_encode($user);
            }
        }
    }


}
//   "DELETE FROM `posts` WHERE `id` = ?", [$_POST['id']]

//    }











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
