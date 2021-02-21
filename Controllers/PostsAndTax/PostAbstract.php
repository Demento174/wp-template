<?php
namespace Controllers\PostsAndTax;
use \Controllers\ACF\GetACF as GetACF;
use TaxonomyAbstract;

class PostAbstract{
    protected $type;
    protected $id;

    public $acf;
    public $title;
    public $link;
    public $img;
    public $taxonomy;

    protected function __construct($type,$id=null,$acf=[])
    {
        $this->type = $type;
        $this->id = self::query_id($id);
        $this->set_acf($acf);

        $this->set_title($this->id);
        $this->set_link($this->id);
        $this->set_img($this->id);
    }

    public static function query_id($id=null)
    {
        if(!$id)
        {
            global $post;
            return $post->ID;
        }else
            {
                return  $id;
            }
    }

    protected function set_acf($acf=[])
    {
        if(!$acf)
        {
            $this->acf = [];
        }else
            {
                $this->acf = GetACF::getACF($acf,$this->id);
            }
    }

    private function set_title($id)
    {
        $this->title = get_the_title($id);
    }

    private function set_link($id)
    {
        $this->link = get_permalink($id);
    }

    private function set_img($id)
    {

        $this->img = !get_the_post_thumbnail_url($id)?false:get_the_post_thumbnail_url($id,'full');
    }

    protected function set_taxonomy($taxonomy,$className)
    {

        if(!get_the_terms( $this->id, $taxonomy ))
        {
            $this->taxonomy = [];
            return;
        }

        foreach (get_the_terms( $this->id, $taxonomy ) as $item)
        {
            $this->taxonomy[] = new $className($item->term_id);
        }
       
    }

    public static function convert_post($input,$className)
    {

        if(gettype($input) === 'array')
        {
            $result = [];
            foreach ($input as $item)
            {
                $result[] = new $className($item->ID);
            }
        }else
            {
                $result = new $className($input->ID);
            }
        return $result;
    }

    public static function get_all_posts($type,$className)
    {

        return self::convert_post(get_posts(['post_type'=>$type,'numberposts'=>-1,]),$className);
    }

    public static function get_sample_posts($include,$type,$className)
    {
        return self::convert_post(get_posts(['post_type'=>$type,'include'=>$include,'numberposts'=>-1,]),$className);

    }

    public static function get_taxonomy_posts($tax_id,$tax_slug,$type,$className)
    {

        $input =  get_posts(
            [
                'post_type' => $type,
                'numberposts' => -1,
                'tax_query' =>
                    [
                        [
                            'taxonomy' => $tax_slug,
                            'field' => 'id',
                            'terms' => $tax_id
                        ]
                    ]
            ]
        );

        return self::convert_post($input,$className);
    }
}