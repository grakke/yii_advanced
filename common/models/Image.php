<?php
/**
 * 图片压缩操作类
 * @author  chris.gong
 * @date 20180919
 */

namespace common\models;

use app\models\UploadForm;
use Yii;
use yii\web\UploadedFile;

class Image
{
    private $src;
    private $imageinfo;
    private $image;
    public $percent = 0.1;
    private $dir = 'uploads/';
    private $quality = 9;

    public function __construct($src)
    {
        $this->src = $src;
    }

    /**
     * 打开图片
     */
    public function openImage()
    {
        list($width, $height, $type, $attr) = getimagesize($this->src);
        $this->imageinfo = array(
            'width' => $width,
            'height' => $height,
            'type' => image_type_to_extension($type, false),
            'attr' => $attr
        );

        $fun = "imagecreatefrom" . $this->imageinfo['type'];
        $this->image = $fun($this->src);
    }

    /**
     * 操作图片
     */
    public function thumpImage()
    {
        //大于2000像素的
        if ($this->imageinfo['width'] >= 2000 && $this->imageinfo['height'] >= 2000) {
            $new_width = $this->imageinfo['width'] * $this->percent;
            $new_height = $this->imageinfo['height'] * $this->percent;
        } elseif ($this->imageinfo['width'] >= 1000 && $this->imageinfo['height'] >= 1000) {
            $new_width = $this->imageinfo['width'] * 0.5;
            $new_height = $this->imageinfo['height'] * 0.5;
        } else {
            $new_width = $this->imageinfo['width'];
            $new_height = $this->imageinfo['height'];
        }
        $image_thump = imagecreatetruecolor($new_width, $new_height);
        //将原图复制带图片载体上面，并且按照一定比例压缩,极大的保持了清晰度
        imagecopyresampled($image_thump, $this->image, 0, 0, 0, 0, $new_width, $new_height, $this->imageinfo['width'], $this->imageinfo['height']);
        imagedestroy($this->image);
        $this->image = $image_thump;
    }

    /**
     * 输出图片
     */
    public function showImage()
    {
        header('Content-Type: image/' . $this->imageinfo['type']);
        $funcs = "image" . $this->imageinfo['type'];
        $funcs($this->image);

    }

    /**
     * 保存图片到硬盘
     */
    public function saveImage($name)
    {
        $funcs = "image" . $this->imageinfo['type'];
        $funcs($this->image, $this->dir . $name . '.' . $this->imageinfo['type'], $this->quality);

        return '/' . $this->dir . $name . '.' . $this->imageinfo['type'];
    }

    /**
     * 销毁图片
     */
    public function __destruct()
    {
        imagedestroy($this->image);
    }

    public static function upload($name = 'file', $dir = './uploads/')
    {
        $instance = UploadedFile::getInstanceByName($name);

        if ($instance) {
            $fileName = md5(@mktime() . mt_rand(1111, 9999));
            $newFile = $dir . $fileName . '.' . $instance->getExtension();
            if ($instance->saveAs($newFile)) {
                return $newFile;
            }
        }

        return null;
    }

    public static function getThumb($imagePath)
    {
        $image = new static($imagePath);
        $image->percent = 0.02;
        $image->openImage();
        $image->thumpImage();
        $rand = md5(Helper::microtime_float() . Helper::randpw(8, 1));

        return $image->saveImage($rand);
    }


}