<?php
namespace Controllers\PostsAndTax;
use \Controllers\ACF\GetACF as GetACF;

class PostProduct extends PostAbstract {



    static $postType = 'product';
    static $tax_slug = 'product_cat';
    static $fields =
        [
            'article',
            'price',
            'brands',
            'images',
            'drawing',
            'description',
            'returns',
            'warranty',
            'buy_this',
            'similar'
        ];

        protected $product;

        private $units;

        private $article;
        private $price;
        private $brands;
        private $images = [];
        private $drawing;
        private $description;
        private $returns;
        private $warranty;
        private $cross_sell=[];
        private $upsell=[];
        private $compatibility;
        private $dimensions;
        private $count_stock;
        private $attributes;
        private $short_description;


    public function __construct($id=null)
    {
        parent::__construct('furniture',$id,self::$fields);

        $this->set_units();

        $this->set_taxonomy(self::$tax_slug,'\Controllers\PostsAndTax\TaxCat');

        $this->set_product();

        $this->set_article();
        $this->set_price();
        $this->set_brands();
        $this->set_images();
        $this->set_img();
        $this->set_drawing();
        $this->set_description();
        $this->set_returns();
        $this->set_warranty();
        $this->set_cross_sell();
        $this->set_upsell();
        $this->set_compatibility();
        $this->set_dimensions();
        $this->set_count_stock();
        $this->set_attributes();
        $this->set_short_description();
    }

    protected function set_units()
    {
        $this->units = get_field('shop','options')['units'];

    }

    protected function set_acf($acf=[])
    {
        parent::set_acf($acf);
    }

    protected function set_product()
    {
        $this->product = wc_get_product($this->id);
    }

    protected function set_article()
    {
        $this->article = $this->product->get_sku();
    }

    protected function set_price()
    {
        $this->price = (float) $this->product->get_price();
    }

    protected function set_brands()
    {
        $this->brands = get_metabox_acf_repeater('brands','options',$this->id);
    }

    protected function set_images()
    {


        foreach ($this->product->get_gallery_image_ids() as $item)
        {
            $this->images[] = ['url'=>wp_get_attachment_url($item),'alt'=>$this->title];
        }

    }

    private function set_img()
    {

        if($this->images)
        {
            $this->img = $this->images[0];
        }

    }

    protected function set_drawing()
    {
        $this->drawing = get_field('drawing',$this->id);
    }

    protected function set_description()
    {
        $this->description = $this->product->get_short_description();
    }

    protected function set_returns()
    {
        $this->returns = get_field('shop','options')['returns'];
    }

    protected function set_warranty()
    {
        $this->warranty = !get_field('warranty',$this->id)?get_field('shop','options')['warranty']:get_field('warranty',$this->id);
    }

    protected function set_cross_sell()
    {
        /*
         * crosssail
         */
        foreach ($this->product->get_cross_sell_ids() as $item)
        {
            $this->cross_sell[] = new $this($item);
        }

    }

    protected function set_upsell()
    {
        foreach ($this->product->get_upsell_ids() as $item)
        {
            $this->upsell[] = new $this($item);
        }
    }

    protected function set_compatibility()
    {
        $this->compatibility = $this->product->get_attribute('compatibility');
    }

    protected function set_short_description()
    {
        $this->short_description = get_field('short_description',$this->id);
    }

    protected function set_dimensions()
    {
        if($this->product->get_weight())
        {
            $this->dimensions['weight']=
                [
                    'title'=>'Вес',
                    'value'=>$this->product->get_weight()
                ];
        }

        if($this->product->get_length())
        {
            $this->dimensions['length']=
                [
                    'title'=>'Длина',
                    'value'=>$this->product->get_length()
                ];
        }

        if($this->product->get_width())
        {
            $this->dimensions['width']=
                [
                    'title'=>'Ширина',
                    'value'=>$this->product->get_width()
                ];
        }

        if($this->product->get_height())
        {
            $this->dimensions['height']=
                [
                    'title'=>'Высота',
                    'value'=>$this->product->get_height()
                ];
        }

    }

    protected function set_count_stock()
    {
        $this->count_stock = get_post_meta( $this->id, '_stock', true );
    }

    protected function set_attributes()
    {
        $this->attributes = $this->product->get_attributes();
    }


    public function get_id()
    {
        return $this->id;
    }

    public function get_article()
    {
        return $this->article;
    }

    public function get_price()
    {
        return $this->price.' '.$this->units['currency'];
    }

    public function get_brands()
    {
        return $this->brands;
    }

    public function get_images()
    {
        return $this->images;
    }

    public function get_drawing()
    {
        return $this->drawing;
    }

    public function get_description()
    {
        return $this->description;
    }

    public function get_returns()
    {
        return $this->returns;
    }

    public function get_warranty()
    {
        return $this->warranty;
    }

    public function get_cross_sell()
    {
        return $this->cross_sell;
    }

    public function get_upsell()
    {
        return $this->upsell;
    }

    public function get_short_description()
    {

        return $this->short_description;
    }

    public  function get_compatibility()
    {

        return array_map(
            function ($item)
            {
                return trim($item);
            },
            explode(',',$this->compatibility));
    }

    public function get_dimensions()
    {
        $arr = [];
        foreach ($this->dimensions as $key=>$item)
        {
            $arr[$key] = $item;
            if($key !== 'weight')
            {
                $arr[$key]['value'] .= ', '.$this->units['dimensions'];
            }else
            {
                $arr[$key]['value'] .= ', '.$this->units['weight'];
            }
        }
        return $arr;
    }

    public function get_count_stock()
    {
        return (int) $this->count_stock;
    }

    public function get_characteristics($count=0)
    {
        $result = [];

        foreach ($this->attributes as $attribute)
        {
            if($attribute['name'] == 'pa_compatibility')
            {
                continue;
            }
            $result[]=
                [
                    'title'=>wc_attribute_label($attribute['name']),
                    'value'=>$this->product->get_attribute($attribute['name'])
                ];

        }

        return $count===0?array_merge($result,$this->get_dimensions()):array_slice(array_merge($result,$this->get_dimensions()),0,$count);
    }




    public function get_taxonomy()
    {
        $result = [];
        $className = '\Controllers\PostsAndTax\TaxCat';
        $type = self::$tax_slug;

        foreach (get_terms( $type,['hide_empty' => true,'parent'=>0]) as $key=>$item)
        {
            $parent = new $className($item->term_id);
            if(has_term($item->term_id,$type,$this->id))
            {
                $result[$key]['term'] = $parent;
                foreach (get_terms( $type,['hide_empty' => false,'parent'=>$item->term_id]) as $keyKey=>$tax)
                {
                    if(has_term($tax->term_id,$type,$this->id))
                    {
                        $children = new $className($tax->term_id);
                        $result[$key]['children'][$keyKey]['term'] = $children;

                        foreach (get_terms( $type,['hide_empty' => false,'parent'=>$tax->term_id]) as $taxTax)
                        {

                            if(has_term($taxTax->term_id,$type,$this->id))
                            {

                                $childrenChildren = new $className($taxTax->term_id);

                                $result[$key]['children'][$keyKey]['children'][]=$childrenChildren;
                            }else
                                {
                                    continue;
                                }

                        }
                    }else
                        {
                            continue;
                        }

                }
            }

        }

        return $result;

    }

    public static function get_all_posts($postType='',$class='\\'.__CLASS__)
    {
        return parent::get_all_posts(self::$postType,$class);
    }

    public static function get_sample_posts($include,$post='',$class= '\\'.__CLASS__)
    {
        return parent::get_sample_posts($include,self::$postType,$class);
    }

    public static function get_taxonomy_posts($tax_id,$tax_slug='',$type='',$class= '\\'.__CLASS__)
    {
        return parent::get_taxonomy_posts($tax_id,self::$tax_slug,self::$postType,$class= '\\'.__CLASS__);
    }


}