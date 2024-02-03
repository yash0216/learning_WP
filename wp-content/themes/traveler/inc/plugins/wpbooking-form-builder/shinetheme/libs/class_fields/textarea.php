<?php
/**
 * Created by wpbooking.
 * Developer: nasanji
 * Date: 12/23/2016
 * Version: 1.0
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
if(!class_exists('WB_Form_Builder_Textarea')){
    class WB_Form_Builder_Textarea extends WB_Form_Builder_Abstract_fields{
        static $_inst = false;
        protected $field_id = 'textarea';
        protected $field_group = 'basic';
        function __construct()
        {
            parent::__construct();
        }
        public function get_field_settings()
        {
            $this->field_settings = array(
                array(
                    'id' => 'title',
                    'label' => esc_html__('Title','traveler'),
                    'type' => 'text',
                    'require' => true
                ),
                array(
                    'id' => 'name',
                    'label' => esc_html__('Name','traveler'),
                    'type' => 'text',
                    'desc' => esc_html__('The name in input tag:','traveler').' &lt;input type="text" <strong>name</strong>="field_name" &gt;',
                    'require' => true
                ),
                array(
                    'id' => 'required',
                    'label' => esc_html__('Required','traveler'),
                    'type' => 'checkbox',
                ),
                array(
                    'id' => 'advance',
                    'label' => esc_html__('Advanced Options','traveler'),
                    'type' => 'link',
                ),
                array(
                    'id' => 'placeholder',
                    'label' => esc_html__('Placeholder (optional)','traveler'),
                    'type' => 'text',
                    'adv_field' => true
                ),
                array(
                    'id' => 'desc',
                    'label' => esc_html__('Description (optional)','traveler'),
                    'type' => 'text',
                    'adv_field' => true
                ),
                array(
                    'id' => 'extra_class',
                    'label' => esc_html__('Extra Class (optional)','traveler'),
                    'type' => 'text',
                    'adv_field' => true
                ),
                array(
                    'id' => 'custom_id',
                    'label' => esc_html__('Custom Field ID (optional)','traveler'),
                    'type' => 'text',
                    'adv_field' => true
                )
            );
            return parent::get_field_settings(); // TODO: Change the autogenerated stub
        }
        public function get_info($key)
        {
            $this->field_info = array(
                'title' => esc_html__('Textarea','traveler'),
                'desc' => esc_html__('Textarea field','traveler')
            );
            return parent::get_info($key); // TODO: Change the autogenerated stub
        }
        function get_frontend_html($data)
        {
            parent::get_frontend_html($data); // TODO: Change the autogenerated stub
            $html = '<div class="form-group '.$data['class'].'">
                        <label for="' . $data['custom_id'] . '">' . $data['label'] . ' ' . (($data['required']) ? '<span class="required">*</span>' : '') . '</label>
                        <textarea class="form-control" id="'.$data['custom_id'].'" name="'.$data['name'].'" placeholder="'.($data['placeholder']?$data['placeholder']:'').'"></textarea>
                        <span class="desc">'.$data['desc'].'</span>
                    </div>';
            return $html;
        }
        function get_admin_html($data, $order_id){
            parent::get_admin_html($data, $order_id);
            $value = isset( $_POST[ $data['name']] ) ? $_POST[ $data['name'] ] : get_post_meta( $order_id, $data['name'], true );
            $html = '<div class="form-row">
                        <label class="form-label"
                               for="' . $data['name'] . '">' . $data['label'] . ' ' . (($data['required']) ? '<span class="required">*</span>' : '') . '</label>
                        <div class="controls">
                            <textarea class="form-control form-control-admin" id="'.$data['name'].'" name="'.$data['name'].'" placeholder="'.($data['placeholder']?$data['placeholder']:'').'">'.$value.'</textarea>
                        </div>
                    </div>';
            return $html;
        }
        static function inst()
        {
            if (!self::$_inst)
                self::$_inst = new self();
            return self::$_inst;
        }
    }
    WB_Form_Builder_Textarea::inst();
}