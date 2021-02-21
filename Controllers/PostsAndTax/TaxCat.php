<?php
namespace Controllers\PostsAndTax;

use Controllers\ACF\GetACF;
use PHPMailer\PHPMailer\Exception;

class TaxCat extends TaxonomyAbstract {

    static $options =
        [
             'type' => 'product_cat',
             'fields' =>
                [
                    'img'
                ],
        ];

    public $icon;
    public function __construct($id)
    {

        parent::__construct(self::$options['type'],$id,self::$options['fields']);

        $this->set_icon();


        

    }


    
    private function set_icon()
    {
     
        $this->icon = ['url'=>wp_get_attachment_url( get_term_meta( $this->id, 'thumbnail_id', true ) ),'alt'=>$this->title];
    }

    protected function set_link()
    {

        if(!$this->is_third_level())
        {
            parent::set_link();
        }else
            {
              $separator = $_GET?'&':'?';
                $this->link = get_permalink( wc_get_page_id( 'shop' ) ).$separator.'thirdCat='.$this->id;
            }
    }

    public function set_parent($className='\\'.__CLASS__)
    {
        parent::set_parent($className);
    }

    public function get_children()
    {
        $result = [];
        foreach (get_terms( $this->type,['hide_empty' => true,'parent'=>$this->id]) as $item)
        {
            $result[] = new self($item->term_id);
        }
        return $result;
    }


    public function get_id()
    {
        return $this->id;
    }

    public function is_first_level()
    {
        if(!$this->parent)
        {
            return true;
        }
        return false;
    }

    public function is_second_level()
    {
        if(!$this->parent)
        {
            return false;
        }

        if($this->parent->is_first_level())
        {
            return true;
        }

        return false;
    }

    public function is_third_level()
    {

        if(!$this->parent)
        {
            return false;
        }

        if($this->parent->is_second_level())
        {
            return true;
        }

        return false;
    }

    private function get_main_level()
    {
        if($this->is_first_level())
        {
            return false;
        }elseif($this->is_second_level())
        {
            return $this->parent;
        }

        return $this->parent->parent;

    }

    public function get_other_cats()
    {

        if(!$this->get_main_level())
        {
            return false;
        }
        $result= [];
        $parents = get_terms( self::$options['type'],['hide_empty' => true,'parent'=>0]);


        foreach ($parents as $parent)
        {
            if($parent->term_id == $this->get_main_level()->get_id())
            {
                foreach (get_terms( self::$options['type'],['hide_empty' => true,'parent'=>$parent->term_id]) as $children)
                {
                    if($children->term_id !== $this->id)
                    {
                        $result[] = new self($children->term_id);
                    }

                }
            }
        }
        return  $result;
    }


    public static function get_termParent($type='',$className='')
    {
        return parent::get_termParent(self::$options['type'],'\\'.__CLASS__);

    }

    public static function get_termFirstLevel()
    {
        $result = [];
        foreach (get_terms( self::$options['type'],['hide_empty' => true,'parent'=>0]) as $key=>$item)
        {
            $parent = new self($item->term_id);
            $result[$key] = $parent;

        }
        return $result;
    }

    public static function get_termSecondLevel()
    {
        $result = [];
        foreach (get_terms( self::$options['type'],['hide_empty' => false,'parent'=>0]) as $key=>$item)
        {

            foreach (get_terms( self::$options['type'],['hide_empty' => false,'parent'=>$item->term_id]) as $keyKey=>$tax)
            {
                $children = new self($tax->term_id);
                $result[] = $children;
            }

        }
        return $result;
    }

    public static function get_termThirdLevel()
    {
        $result = [];

        foreach (get_terms( self::$options['type'],['hide_empty' => true,'parent'=>0]) as $key=>$item)
        {

            foreach (get_terms( self::$options['type'],['hide_empty' => false,'parent'=>$item->term_id]) as $keyKey=>$tax)
            {

                foreach (get_terms( self::$options['type'],['hide_empty' => false,'parent'=>$tax->term_id]) as $taxTax)
                {

                    $childrenChildren = new self($taxTax->term_id);

                    $result[$key]=$childrenChildren;
                }
            }
        }

        return $result;
    }

    public static function get_termHierarchical($type='',$className='')
    {

        return parent::get_termHierarchical(self::$options['type'],'\\'.__CLASS__);
    }



}