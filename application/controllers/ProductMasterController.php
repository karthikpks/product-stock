<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Karthik PKS - Full Stack Developer
 * Description: ProductMasterController controller class
 * 
 */
 class ProductMasterController extends CI_Controller{
    private $cm_id;
    function __construct(){
        parent::__construct();
        $this->load->model('ProductMasterTable');
        $this->cm_id = $this->session->userdata('cm_id');
    }

    public function saveProductMaster() {
        $this->productMasterTitle = strtolower($this->security->xss_clean($this->input->post('productMasterTitle')));
        $imageStatus = $imageUpload = $this->ajaxImageUpload();
        if($imageStatus["status"]) {
            $status = $this->insertProduct($imageStatus["path"]);
            $this->message = array('id' => $status, 'value'=> $this->productMasterTitle, 'message' => " Saved successfully..!", 'status' => true);
            if(!$status) {
                $this->message = array('id' => 0, 'value' => '', 'message' => "Select All Options or Title and Description Already Exists..", 'status' => false);
            }
            echo json_encode($this->message);
            exit();
        } else {
            $this->message = array('id' => $status, 'value'=> '', 'message' => $imageStatus["path"], 'status' => $imageStatus["status"]);
            echo json_encode($this->message);
            exit();
        }
        
    }

    public function updateProductMaster() {
    	$this->productMasterTitle = strtolower($this->security->xss_clean($this->input->post('productMasterTitle')));
        $imageStatus = $imageUpload = $this->ajaxImageUpload();
        if($imageStatus["status"]) {
            $status = $this->ProductMasterTable->updateProduct($imageStatus["path"]);
            $this->message = array('id' => $status, 'value'=> $this->productMasterTitle, 'message' => " Updated successfully..!", 'status' => true);
            if(!$status) {
                $this->message = array('id' => 0, 'value' => '', 'message' => "Select All Options or Title and Description Already Exists..", 'status' => false);
            }
            echo json_encode($this->message);
            exit();
        } else {
            $this->message = array('id' => $status, 'value'=> '', 'message' => $imageStatus["path"], 'status' => $imageStatus["status"]);
            echo json_encode($this->message);
            exit();
        }
    	
    }

    private function insertProduct($imagePath) {
    	return $this->ProductMasterTable->insertProduct($imagePath);
    }

    public function getProductList() {
        echo $this->ProductMasterTable->getProductList();
        exit();
    }

    public function getAllProductList() {
        echo $this->ProductMasterTable->getAllProductList();
        exit();
    }

    public function ajaxImageUpload() {
        $result = array();
        $path = $_SERVER['DOCUMENT_ROOT']."/product-stock/assets/uploads/";
        
        $valid_formats = array("jpg", "png", "gif", "bmp","jpeg","PNG","JPG","JPEG","GIF","BMP");
        if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
        {
            $imagename = $_FILES['productImage']['name'];
            $size = $_FILES['productImage']['size'];
            if(strlen($imagename))
            {   
                $ext = strtolower($this->getExtension($imagename));
                if(in_array($ext,$valid_formats))
                {
                    if($size<(1024*1024)) // Image size max 1 MB
                    {
                        $actual_image_name = time().$this->cm_id.".".$ext;
                        $uploadedfile = $_FILES['productImage']['tmp_name'];

                        /*//Re-sizing image. 
                        $widthArray = array(400,200,50); //You can change dimension here.
                        foreach($widthArray as $newwidth)
                        {
                        $filename=$this->compressImage($ext,$uploadedfile,$path,$actual_image_name,$newwidth);
                        echo "<img src='".$filename."' class='img'/>";
                        }*/

                        //Original Image
                        if(move_uploaded_file($uploadedfile, $path.$actual_image_name))
                        {
                            //Insert upload image files names into user_uploads table
                            $result = array(
                                    "status" => true,
                                    "path" => base_url()."assets/uploads/".$actual_image_name,
                                );
                            return $result;
                            }
                        else {
                            $result = array(
                                    "status" => true,
                                    "path" => "Image Upload file",
                                );
                            return $result;
                        }
                    }
                    else {
                        $result = array(
                            "status" => true,
                            "path" => "Image file size max 1 MB",
                        );
                        return $result;
                    }
                }
                else {
                    $result = array(
                        "status" => true,
                        "path" => "Invalid file format..",
                    );
                    return $result;
                }
            }
            else {
                $result = array(
                        "status" => true,
                        "path" => "Please select image",
                    );
                return $result;
        }
    }
    }

    public function compressImage($ext,$uploadedfile,$path,$actual_image_name,$newwidth)
    {

        if($ext=="jpg" || $ext=="jpeg" )
        {
        $src = imagecreatefromjpeg($uploadedfile);
        }
        else if($ext=="png")
        {
        $src = imagecreatefrompng($uploadedfile);
        }
        else if($ext=="gif")
        {
        $src = imagecreatefromgif($uploadedfile);
        }
        else
        {
        $src = imagecreatefrombmp($uploadedfile);
        }

        list($width,$height)=getimagesize($uploadedfile);
        $newheight=($height/$width)*$newwidth;
        $tmp=imagecreatetruecolor($newwidth,$newheight);
        imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
        $filename = $path.$newwidth.'_'.$actual_image_name; //PixelSize_TimeStamp.jpg
        imagejpeg($tmp,$filename,100);
        imagedestroy($tmp);
        return $filename;
    }

    public function getExtension($str)
    {
        $i = strrpos($str,".");
        if (!$i)
        {
        return "";
        }
        $l = strlen($str) - $i;
        $ext = substr($str,$i+1,$l);
        return $ext;
    }
}
?>