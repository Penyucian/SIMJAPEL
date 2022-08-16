<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 *
 * How to use ?
 * - fullpath (ex:media/data/dms/file.pdf) dengan enkripsi key dms di config
 * base_url() sys/file/full_download/full_path_file_dienkrip
 *
 * - config_path, filename dengan enkripsi key dms di config
 * base_url() sys/file/download/config_path_dienkrip/filename_dienkrip
 * base_url() sys/file/download?path=config_path_dienkrip&file=filename_dienkrip
 *
 * - config_path, filename dengan enkripsi key default sistem
 * base_url() sys/file/unduh/config_path_dienkrip/filename_dienkrip
 * base_url() sys/file/unduh?path=config_path_dienkrip&file=filename_dienkrip
 *
 */
class File extends SYS_Controller {
    private $key;
    public function __construct() {
        parent::__construct();

        if(!$this->user_id){
            show_404('', FALSE);
        }

        $this->key = array('key' => config_item('encryption_key_dms'));
    }
    //fullpath (ex:media/data/dms/file.pdf) dengan enkripsi key dms
    function full_download($file=null){
        $file = ($file) ? $file : $this->input->get('file');
        if ($file == null){
            header ("HTTP/1.0 404 Not Found");
            return;
        }
        //filename
        $file_path = $this->encryption_lib->urldecode($file, $this->key);
        $this->get_($file_path);
    }
    //fullpath (ex:media/data/dms/file.pdf)
    function fullpath_download($file=null){
        $file = ($file) ? $file : $this->input->get('file');
        if ($file == null){
            header ("HTTP/1.0 404 Not Found");
            return;
        }
        //filename
        $file_path = $this->encryption_lib->urldecode($file);
        $this->get_($file_path);
    }
    //config_path, filename dengan enkripsi key dms
    function download($config_path=null, $file=null){
        $config_path = ($config_path) ? $config_path : $this->input->get('path');
        $file = ($file) ? $file : $this->input->get('file');
        if ($config_path==null or $file == null){
            header ("HTTP/1.0 404 Not Found");
            return;
        }
        //config_path
        $config_path = $this->encryption_lib->urldecode($config_path, $this->key);
        //filepath
        $path = $this->config->item($config_path);
        if ($path == null){
            header ("HTTP/1.0 404 Not Found");
            return;
        }
        //filename
        $file = $this->encryption_lib->urldecode($file, $this->key);
        $file_path = $path.''.$file;
        $this->get_($file_path);
    }
    //config_path, filename dengan enkripsi key default
    function unduh($config_path=null, $file=null){
        $config_path = ($config_path) ? $config_path : $this->input->get('path');
        $file = ($file) ? $file : $this->input->get('file');
        if ($config_path==null or $file == null){
            header ("HTTP/1.0 404 Not Found");
            return;
        }
        //config_path
        $config_path = $this->encryption_lib->urldecode($config_path);
        //filepath
        $path = $this->config->item($config_path);
        if ($path == null){
            header ("HTTP/1.0 404 Not Found");
            return;
        }
        //filename
        $file = $this->encryption_lib->urldecode($file);
        $file_path = $path.''.$file;
        $this->get_($file_path);
    }
    public function get_($file_path){
        if (file_exists($file_path)){
            $type = pathinfo($file_path, PATHINFO_EXTENSION);
            $arrType = array(
                'zip' => 'application/zip',
                'tar' => 'application/zip',
                'rar' => 'application/zip',
                'pdf' => 'application/pdf',
                'txt' => 'text/plain',
                'js'  => 'text/plain',
                'css' => 'text/plain',
                'php' => 'text/plain',
                'asp' => 'text/plain',
                'rtf' => 'application/msword',
                'doc' => 'application/msword',
                'docx' => 'application/msword',
                'xls' => 'application/vnd.ms-excel',
                'xlsx' => 'application/vnd.ms-excel',
                'ppt' => 'application/vnd.ms-powerpoint',
                'exe' => 'application/octet-stream',
                'gif' => 'image/gif',
                'png' => 'image/png',
                'jpeg'=> 'image/jpeg',
                'jpg' => 'image/jpeg',
                'bmp' => 'image/jpeg',
                'mpeg'=> 'audio/mpeg'
            );

            $berkas = basename($file_path);

            $fsize = filesize($file_path);

            ob_end_clean();

            header("Pragma: public");
            header("Expires: 0");
            header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
            header("Cache-Control: public");
            header("Content-Description: File Transfer");
            header('Access-Control-Allow-Origin: *');
            header('Access-Control-Allow-Methods: GET, POST');
            header("Access-Control-Allow-Headers: X-Requested-With");
            header("Content-Type: ".$arrType[$type]);
            header('Content-Disposition: inline; filename="' . $berkas . '"');
            header("Content-Transfer-Encoding: binary");
            header("Content-Length: " . $fsize);

            $file = @fopen($file_path,"rb");
            if ($file) {
                while(!feof($file)) {
                    print(fread($file, 1024*8));
                    flush();
                    if (connection_status()!=0) {
                        @fclose($file);
                        die();
                    }
                }
                @fclose($file);
            }
        }else{
            header ("HTTP/1.0 404 Not Found");
            return;
        }
    }
}

/* End of file File.php */
/* Location: ./modules/sys/modal.php */
