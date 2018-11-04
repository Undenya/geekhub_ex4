<?php
/**
 * Created by PhpStorm.
 * User: UnDenya
 * Date: 04.11.2018
 * Time: 14:09
 */
namespace Undenya\Images;
class Image
{
    /**
     * @var string
     */
    public $image_src;
    public $image;
    public $type;
    public $format;

    /**
     * @var array
     */
    public $size;
    public $image_data;

    function __construct($image_src)
    {
        $this->image_src = $image_src;
        $this->image_data = getimagesize($image_src);

        $format = $this->image_data["mime"];
        $format = explode("/", $format);

        $this->type = $format[0];
        $this->format = $format[1];

        $this->checkType();
        $this->createImage();

        $this->size["width"] = $this->image_data[0];
        $this->size["height"] = $this->image_data[1];
    }


    function checkType()
    {
        if($this->type != "image")
        {
            $logger = new Logger();
            $logger->setErrorLog("not image");
            exit();
        }
    }

    public function createImage()
    {
        switch ($this->format)
        {
            case "jpeg":
                $this->image = imagecreatefromjpeg($this->image_src);
                break;
            case "png":
                $this->image = imagecreatefrompng($this->image_src);
                break;
            case "bmp":
                $this->image = imagecreatefrombmp($this->image_src);
                break;
            default:
                $logger = new Logger();
                $logger->setErrorLog("unsupported file");
                exit();
        }
    }

    /**
     * @param int $x
     * @param int $y
     * @param int $width
     * @param int $height
     * @return bool|resource
     */

    function crop($x, $y, $width, $height)
    {
        $img = imagecrop($this->image, ['x' => $x, 'y' => $y, 'width' => $width, 'height' => $height]);
        return $img;
    }

    /**
     * @param resource $image
     */

    public function viewImage($image = "")
    {
        if($image == "")
        {
            $image = $this->image;
        }

        switch ($this->format)
        {
            case "jpeg":
                imagejpeg($image);
                break;
            case "png":
                imagepng($image);
                break;
            case "bmp":
                imagebmp($image);
                break;
            default:
                $logger = new Logger();
                $logger->setErrorLog("unsupported file");
                exit();
        }
    }

    /**
     * @param string $path
     * @param resource $image
     * @return mixed
     */
    function save($path, $image = "")
    {
        if($image == "")
        {
            $image = $this->image;
        }

        switch ($this->format)
        {
            case "jpeg":
                $result = imagejpeg($image, $path);
                break;
            case "png":
                $result = imagepng($image, $path);
                break;
            case "bmp":
                $result = imagebmp($image, $path);
                break;
            default:
                $result = "unsupported file";
                break;
        }

        return $result;
    }
}