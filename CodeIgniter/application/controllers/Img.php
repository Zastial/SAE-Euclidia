<?php
class Img extends CI_Controller {

    public function get($file) {
        $path = $this->config->item('model_assets') . $file;

        if (!is_dir($path)) {
            $this->default();
        }

        $file_ext = "";
        foreach ($this->config->item('model_assets_ext') as $ext) {
            if(file_exists($path."/thumb.".$ext)) {
                $file_ext = $ext;
                break;
            }
        }
        
        if (empty($file_ext)) {
            $this->default();
        } else {
            header('Content-type: image/'.$ext);
            readfile($path . "/thumb.".$file_ext);
        }
    }

    public function default() {
        header('Content-type: image/png');
        readfile($this->config->item('model_assets') . "default/default-img.png");
    }

    public function getRandomHomeModel() {
        $path = $this->config->item('model_assets') . "home/";
        if (!is_dir($path)) {
            die();
        }

        $files = scandir($path);
        $models = array();
        foreach ($files as $f) {
            $ext = pathinfo($f, PATHINFO_EXTENSION);
            if ($ext == "glb" || $ext == "gltf") {
                $models[] = $path . $f;
            }
        }
        
        if (empty($models)) {
            die();
        }

        $key = array_rand($models);
        header('Content-type: text/json');
        readfile($models[$key]);
    }
}
?>