<?php

class ImgWorks
{
    private $file;
    private $name;
    private $path;

    public function __construct($file, $param, $name, $path)
    {
        $this->file = $file["$param"];
        $this->name = $name;
        $this->path = $path;
    }

    public function checkMaxSize($sizeMax)
    {
        $kbait = $sizeMax;
        $sizeMax = $sizeMax * 1024;

        foreach ($this->file as $file) {
            $fileSize = $file['size'];
            if ($fileSize > $sizeMax)
                return "NameFile: " . $file['name'] . ", sizeFile: " . $fileSize . "bit maxSize: " . $kbait . "Kb.";
        }

        return false;
    }

    public function checMinWH($minW, $minH)
    {
        foreach ($this->file as $file) {
            list($width, $height) = getimagesize($file['tmp_name']);
            if ($width < $minW && $height < $minH)
                return "NameFile: " . $file['name'] . ", widthFile: " . $width . "px heightFile: " . $height . "px minWidth: " . $minW . "px minHeight: " . $minH . "px.";
        }

        return false;
    }

    private function scaleImg($image, $w_o, $h_o)
    {
        if (($w_o < 0) || ($h_o < 0)) {
            echo "Некорректные входные параметры";
            return false;
        }

        list($w_i, $h_i, $type) = getimagesize($image);
        $types = array("", "gif", "jpeg", "png");
        $ext = $types[$type];
        if ($ext) {
            $func = 'imagecreatefrom' . $ext;
            $img_i = $func($image);
        } else {
            echo 'Некорректное изображение';
            return false;
        }

        if (!$h_o) $h_o = $w_o / ($w_i / $h_i);
        if (!$w_o) $w_o = $h_o / ($h_i / $w_i);
        $img_o = imagecreatetruecolor($w_o, $h_o);
        imagecopyresampled($img_o, $img_i, 0, 0, 0, 0, $w_o, $h_o, $w_i, $h_i);
        $func = 'image' . $ext;

        return $func($img_o, $image);
    }

    public function loadServer($mod = false, $x = 0, $y = 0)
    {
        if (!is_dir($this->path))
            mkdir($this->path, 0777, true);
        $urls = array();
        foreach ($this->file as $file) {
            if ($this->name === 'avatar') {
                $nameFile = 'avatar' . substr($file['name'], strrpos($file['name'], "."));
            } else {
                $nameFile = $file['name'];
            }

            if (move_uploaded_file($file['tmp_name'], $this->path . basename($nameFile))) {
                $files[] = realpath($this->path . $file['name']);
                $fname = $this->path . basename($nameFile);
                array_push($urls, $fname);
                if ($mod) {
                    $this->scaleImg($fname, $x, $y);
                }
            } else {
                $error = true;
                return true;
            }
        }

        return $urls;
    }

    function normalize_files_array($files = [], $name)
    {
        if ($files["$name"]['size'] <= 0) {
            throw new Exception('Image array is empty!');
            return -1;
        }

        $normalized_array = [];
        $allowedTypes = array('image/gif', 'image/png', 'image/jpg', 'image/jpeg');
        foreach ($files as $index => $file) {
            if (!is_array($file['name'])) {
                if (in_array($file['type'], $allowedTypes)) {
                    $normalized_array[$index][] = $file;
                    continue;
                } else {
                    throw new Exception('Invalid type! ' . $name);
                    return;
                }
            }

            foreach ($file['name'] as $idx => $name) {
                if (in_array($file['type'][$idx], $allowedTypes)) {
                    $normalized_array[$index][$idx] = [
                        'name' => $name,
                        'type' => $file['type'][$idx],
                        'tmp_name' => $file['tmp_name'][$idx],
                        'error' => $file['error'][$idx],
                        'size' => $file['size'][$idx]
                    ];
                } else {
                    throw new Exception('Invalid type! ' . $name);
                    return;
                }
            }
        }

        return $normalized_array;
    }
}
