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
}
?>