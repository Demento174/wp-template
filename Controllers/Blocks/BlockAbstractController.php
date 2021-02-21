<?php
namespace Controllers\Blocks;
use Controllers\ACF\GetACF as GetACF;
use \Controllers\PostsAndTax\PostAbstract;


Abstract class BlockAbstractController
{
    protected $template;
    protected $id;
    protected $acf=[];
    protected $data=[];

    protected function __construct($template,$id=null,$selectors=null,$debug=false)
    {
        $this->set_template($template);
        $this->set_id($id);
        if($selectors)
        {
            $this->set_acf($selectors);
            $this->set_debug($debug);
        }
        $this->set_data();
    }

    private function set_template($template)
    {

        $this->template = $template.'.twig';
        if(!file_exists(get_template_directory().'/Views'.substr($this->template,1)))
        {

            wp_die("Template $this->template does not exist");
        }
    }

    private function set_id($id=null)
    {
        $this->id =PostAbstract::query_id($id);
    }

    protected function set_acf($selectors)
    {
        if(!$selectors)
        {
            $this->acf = [];
        }else
            {
                $this->acf = GetACF::getACF($selectors,$this->id);
            }
    }

    protected function set_debug($debug)
    {
        if($debug)
        {
            /*---------------------------[ START ]---------------------------*/
            echo '<pre class="debug" style="
                                    background-color: rgba(0,0,0,0.8);
                                    display: inline-block;
                                    border: 5px solid springgreen;
                                    color: white;
                                    padding: 1rem;">';

                        print_r($this->acf);
                        echo '</pre>';
                        die;
            /*---------------------------[ END ]---------------------------*/
        }
    }

    public function render()
    {
        \Timber::render($this->template,!empty($this->data)?$this->data:null);
    }

    protected function set_data()
    {
        $this->data = $this->acf;
    }

}