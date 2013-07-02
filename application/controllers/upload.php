<?php
    
    class Upload extends CI_Controller {
        function __construct() {
            parent::__construct();
        }
        public function index() {
            /*$targetDir = str_replace('\\', '/', FCPATH) . "/public/media";
                $targetDir = str_replace('\\', '/', FCPATH) . "/public/media/2013";
                $checkDir = is_dir($targetDir);
                if($checkDir == false)
                {
                mkdir($targetDir, 0777, true);
            }*/
            //$dateDir = array();
            //$dateDir['Y']= date("Y");
           // $dateDir['m']= date("m");
            //$dateDir['d']= date("d");
            //$this->checkUpdateDir($dateDir);
            // print_r($dateDir);
            $this->load->view( 'panel/product/upload');
        }
        public function sss()
        {
            /*$filePatch ="C:\/xampp\/htdocs\/shop\/trunk\/\/public\/media\/2013\/05\/06\/3_1.jpg";
            $filePatch = str_replace ("/\/","",$filePatch);
            $test = getimagesize($filePatch);
            print_r($test);*/
            //echo is_dir(FCPATH."/public/media/");
           // echo is_dir("http://localhost/shop/trunk/public/media/2013/05/06");
                //echo site_url();
                //echo base_url();
                $dateDir = array();
            $dateDir['Y']= date("Y");
            $dateDir['m']= date("m");
            $dateDir['d']= date("d");
                 $newTargetDir = $this->checkUpdateDir($dateDir);
                 print_r($newTargetDir['relativePath']);
                
         }
        public function checkUpdateDir($dateDir = array())
        {
        $arrayReturn = array();
            if($dateDir!=null)
            {
                $targetDir = $newDir = "";
                foreach($dateDir as $value)
                {
                    if($newDir == "")
                    {
                        $newDir = $value;
                    }
                    else
                    {
                        $newDir .= "/".$value;
                    }
                    
                    $targetDir = str_replace('\\', '/', FCPATH) . "/public/media/".$newDir;
                    $checkDir = is_dir($targetDir);
                    if($checkDir == false)
                    {
                        mkdir($targetDir, 0777, true);
                    }
                }
                $arrayReturn['targetDir'] = $targetDir;
                $relativePath =  "/public/media/".$newDir;
                $arrayReturn['relativePath'] = str_replace('\/','/',$relativePath);
                return $arrayReturn;
            }else
            {
                return;
            }
        }
        
        function thumbailImage($width=null,$height=null,$fileName=null,$targetDir =null)
        {
            $nw = $width;
            $nh = $height;
            $source = $targetDir."/".$fileName;
            $source = str_replace ('//','/',$source);
            $stype = explode(".", $fileName);
            $stype = $stype[count($stype)-1];
            $destPath = $targetDir."/"."thumb_" .$fileName;
            $dest = $destPath;
            $size = getimagesize($source);
            $w = $size[0];
            $h = $size[1];
            
            switch(strtolower($stype)) 
            {
                case 'gif':
                $simg = imagecreatefromgif($source);
                break;
                case 'jpg':
                $simg = imagecreatefromjpeg($source);
                break;
                case 'png':
                $simg = imagecreatefrompng($source);
                break;
            }
            
            $dimg = imagecreatetruecolor($nw, $nh);
            $wm = $w/$nw;
            $hm = $h/$nh;
            $h_height = $nh/2;
            $w_height = $nw/2;
            
            if($w> $h) 
            {
                $adjusted_width = $w / $hm;
                $half_width = $adjusted_width / 2;
                $int_width = $half_width - $w_height;
                imagecopyresampled($dimg,$simg,-$int_width,0,0,0,$adjusted_width,$nh,$w,$h);
                } elseif(($w <$h) || ($w == $h)) {
                $adjusted_height = $h / $wm;
                $half_height = $adjusted_height / 2;
                $int_height = $half_height - $h_height;
                
                imagecopyresampled($dimg,$simg,0,-$int_height,0,0,$nw,$adjusted_height,$w,$h);
            } 
            else 
            {
                imagecopyresampled($dimg,$simg,0,0,0,0,$nw,$nh,$w,$h);
            }
            $thumb = imagejpeg($dimg,$dest,90);
            if($thumb!='')
            {
                return "thumb_" .$fileName;
            }else
            {
                return;
            }
        }
        
        function uploads($paramUpload=null)
        {
            /**
                * upload.php
                *
                * Copyright 2009, Moxiecode Systems AB
                * Released under GPL License.
                *
                * License: http://www.plupload.com/license
                * Contributing: http://www.plupload.com/contributing
            */
            
            // HTTP headers for no cache etc
            header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
            header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
            header("Cache-Control: no-store, no-cache, must-revalidate");
            header("Cache-Control: post-check=0, pre-check=0", false);
            header("Pragma: no-cache");
            
            // Settings
            $dateDir = array();
            $dateDir['Y']= date("Y");
            $dateDir['m']= date("m");
            $dateDir['d']= date("d");
            $newTargetDir = $this->checkUpdateDir($dateDir);
            //  $direct     = $_REQUEST['diretorio'];
            if($newTargetDir['targetDir'] != null or $newTargetDir['targetDir'] != '')
            {
                $targetDir      = $newTargetDir['targetDir'];
                $relativePath   = $newTargetDir['relativePath'];
            }else
            {
                $targetDir  = str_replace('\\', '/', FCPATH) . "/public/media";
                $targetDir .= $targetDir;
                $relativePath = "/public/media/";
            }
            
            $cleanupTargetDir = true; // Remove old files
            $maxFileAge     = 5 * 3600; // Temp file age in seconds
            
            // 5 minutes execution time
            @set_time_limit(5 * 60);
            
            // Uncomment this one to fake upload time
            // usleep(5000);
            
            // Get parameters
            $chunk      = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
            $chunks     = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 0;
            $fileName   = isset($_REQUEST["name"]) ? $_REQUEST["name"] : '';
            
            // Clean the fileName for security reasons
            $fileName = preg_replace('/[^\w\._]+/', '_', $fileName);
            
            // Make sure the fileName is unique but only if chunking is disabled
            if ($chunks < 2 && file_exists($targetDir . "/" . $fileName)) {
                $ext = strrpos($fileName, '.');
                $fileName_a = substr($fileName, 0, $ext);
                $fileName_b = substr($fileName, $ext);
                
                $count = 1;
                while (file_exists($targetDir . "/" . $fileName_a . '_' . $count . $fileName_b))
                $count++;
                
                $fileName = $fileName_a . '_' . $count . $fileName_b;
            }
            
            $filePath = $targetDir . "/" . $fileName;
            
            
            
            
            // Create target dir
            if (!file_exists($targetDir))
            @mkdir($targetDir);
            
            // Remove old temp files	
            if ($cleanupTargetDir) {
                if (is_dir($targetDir) && ($dir = opendir($targetDir))) {
                    while (($file = readdir($dir)) !== false) {
                        $tmpfilePath = $targetDir . "/" . $file;
                        
                        // Remove temp file if it is older than the max age and is not the current file
                        if (preg_match('/\.part$/', $file) && (filemtime($tmpfilePath) < time() - $maxFileAge) && ($tmpfilePath != "{$filePath}.part")) {
                            @unlink($tmpfilePath);
                        }
                    }
                    closedir($dir);
                    } else {
                    die('{"jsonrpc" : "2.0", "error" : {"code": 100, "message": "Failed to open temp directory."}, "id" : "id"}');
                }
            }	
            
            // Look for the content type header
            if (isset($_SERVER["HTTP_CONTENT_TYPE"]))
            $contentType = $_SERVER["HTTP_CONTENT_TYPE"];
            
            if (isset($_SERVER["CONTENT_TYPE"]))
            $contentType = $_SERVER["CONTENT_TYPE"];
            
            // Handle non multipart uploads older WebKit versions didn't support multipart in HTML5
            if (strpos($contentType, "multipart") !== false) {
                if (isset($_FILES['file']['tmp_name']) && is_uploaded_file($_FILES['file']['tmp_name'])) {
                    // Open temp file
                    $out = @fopen("{$filePath}.part", $chunk == 0 ? "wb" : "ab");
                    if ($out) {
                        // Read binary input stream and append it to temp file
                        $in = @fopen($_FILES['file']['tmp_name'], "rb");
                        
                        if ($in) {
                            while ($buff = fread($in, 4096))
                            fwrite($out, $buff);
                        } else
                        die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
                        @fclose($in);
                        @fclose($out);
                        @unlink($_FILES['file']['tmp_name']);
                    } else
                    die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
                } else
                die('{"jsonrpc" : "2.0", "error" : {"code": 103, "message": "Failed to move uploaded file."}, "id" : "id"}');
                } else {
                // Open temp file
                $out = @fopen("{$filePath}.part", $chunk == 0 ? "wb" : "ab");
                if ($out) {
                    // Read binary input stream and append it to temp file
                    $in = @fopen("php://input", "rb");
                    
                    if ($in) {
                        while ($buff = fread($in, 4096))
                        fwrite($out, $buff);
                    } else
                    die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
                    
                    @fclose($in);
                    @fclose($out);
                } else
                die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
            }
            
            // Check if file has been uploaded
            if (!$chunks || $chunk == $chunks - 1) {
                // Strip the temp .part suffix off 
                rename("{$filePath}.part", $filePath);
            }
            // create thumbnail image
            $thumb = $this->thumbailImage(200,200,$fileName,$targetDir);
            //  die('{"jsonrpc" : "2.0", "result" : null, "id" : "id"}');
            die(json_encode(array('jsonrpc'=>'2.0', 'fileName'=>basename($filePath), 'filePath'=>$targetDir,'thumbName'=>$thumb,'relativePath'=>$relativePath)));
        }
        
		function upload_single() {
			$this->load->view( 'panel/common/upload_single');
		}
    }                                                