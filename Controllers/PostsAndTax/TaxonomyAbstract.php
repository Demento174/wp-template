<?php
namespace Controllers\PostsAndTax;
use \Controllers\ACF\GetACF as GetACF;

abstract class TaxonomyAbstract{

    protected $type;
    protected $term;
    protected $id;
    public $title;
    public $slug;
    public $description;
    public $link;
    public $acf;
    public $parent;
    public $children;

    public function __construct($type,$id,$acf=[])
    {
        $this->type = $type;
        $this->set_term($id);

        if($this->term)
        {
            $this->set_id();
            $this->set_title();
            $this->set_slug();
            $this->set_description();
            $this->set_parent();
            $this->set_link();
            $this->set_acf($acf);
            $this->set_children();
        }

    }

    private  function set_term($id)
    {
        $this->term =  get_term_by( 'id', $id, $this->type);;
    }

    private function set_id()
    {
        $this->id = $this->term->term_id;
    }

    private function set_title()
    {
        $this->title = $this->term->name;
    }

    private function set_slug()
    {
        $this->slug = $this->term->slug;
    }

    private function set_description()
    {
        $this->description = $this->term->description;
    }

    protected function set_link()
    {

        $this->link = get_term_link((int)$this->id, $this->type );
    }

    protected function set_acf($acf=[])
    {
        if(!$acf || !$this->term)
        {
            $this->acf = [];
        }else
        {
            $this->acf = GetACF::getACF($acf,$this->term);
        }
    }

    protected function set_parent($className)
    {
        if(get_ancestors( $this->id, $this->type, 'taxonomy' ))
        {
         
            $this->parent =new $className(get_ancestors( $this->id, $this->type, 'taxonomy' )[0]);

        }else
            {
                $this->parent = false;
            }

    }

    protected function set_children()
    {
        foreach (get_terms( $this->type,['hide_empty' => true,'parent'=>$this->id]) as $item)
        {
            $this->children[] = $item;
        }
    }

    protected static function get_termParent($type='',$className='')
    {

        $result = [];

        foreach (get_terms( $type,['hide_empty' => true,'parent'=>0]) as $item)
        {
            $result[] = new $className($item->term_id);
        }

        return $result;
    }

    public static function get_termHierarchical($type='',$className='')
    {

        $result = [];

        foreach (get_terms( $type,['hide_empty' => true,'parent'=>0]) as $key=>$item)
        {
            $parent = new $className($item->term_id);
            $result[$key]['term'] = $parent;
            foreach (get_terms( $type,['hide_empty' => false,'parent'=>$item->term_id]) as $keyKey=>$tax)
            {
                $children = new $className($tax->term_id);
                $result[$key]['children'][$keyKey]['term'] = $children;

                foreach (get_terms( $type,['hide_empty' => false,'parent'=>$tax->term_id]) as $taxTax)
                {
                    
                    $childrenChildren = new $className($taxTax->term_id);

                    $result[$key]['children'][$keyKey]['children'][]['term']=$childrenChildren;
                }
            }
        }

        return $result;
    }


    public static function preserving_hierarchy()
    {
        add_action( 'save_post', function ($post_id)
        {
            $post = get_post($post_id);

//            if($post->post_type !== $post_type)
//            {
//                return;
//            }


            $terms = get_the_terms( $post_id, 'product_cat' );
            if( !$terms )
            {
                return;
            }

            foreach ($terms as $term)
            {
                $first_parent = wp_get_term_taxonomy_parent_id( $term,'product_cat');
                if(!$first_parent)
                {
                    continue;
                }
                wp_set_post_terms( $post_id, [$first_parent], 'product_cat',true);

                $second_parent = wp_get_term_taxonomy_parent_id( $first_parent,'product_cat');

                if(!$second_parent)
                {
                    continue;
                }
                wp_set_post_terms( $post_id, [$second_parent], 'product_cat',true);
            }
        } );
    }
}