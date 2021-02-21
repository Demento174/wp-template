<?php
namespace Controllers\ScriptsAndStyles;

class RegisterScriptsAndStyle{
    private $settings;
    private $folder;
    private $templateName;

    public function __construct($settings=null)
    {
        $this->settings = !$settings?require_once('settings.php'):$settings;
        $this->folder = $this->settings['folder'];
        $this->templateName = WP_get_theme()->Name;
        add_action('wp_enqueue_scripts',[$this,'handler']);
    }

    private function define_file_type($file)
    {
        $array = explode('.',$file);

        $result = end($array);

        return $result;
    }

    private function set_script_or_style_title($file)
    {
        $array = explode('/',$file);

        $last = end($array);

        $array2 = explode('.',$last);

        return $this->templateName.'-'.$array2[0];
    }

    private function register_script($title,$path,$deps=null,$ver=null,$in_footer=null)
    {


        wp_enqueue_script( $title, $path, $deps, $ver,$in_footer);
        wp_localize_script( $title, 'ajax',
            array(
                'url' => admin_url('admin-ajax.php')
            )
        );
    }

    private function register_style($title,$path,$deps=null,$ver=null,$media=null)
    {

        wp_enqueue_style( $title, $path, $deps, $ver,$media);
    }


    public function handler()
    {
        foreach ($this->settings['data'] as $item)
        {
            if($this->define_file_type($item['src']) === 'js')
            {

                $this->register_script(
                    $this->set_script_or_style_title($item['src']),
                    $this->folder.$item['src'],
                    isset($item['deps'])?$item['deps']:null,
                    isset($item['ver'])?$item['ver']:null,
                    isset($item['in_footer'])?$item['in_footer']:null
                );
            }else
            {

                $this->register_style(
                    $this->set_script_or_style_title($item['src']),
                    $this->folder.$item['src'],
                    isset($item['deps'])?$item['deps']:null,
                    isset($item['ver'])?$item['ver']:null,
                    isset($item['media'])?$item['media']:null
                );
            }
        }
    }
}