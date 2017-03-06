<?php
class SluggableBehavior extends ModelBehavior{

    private $defaultOptions = array(
        'field'    => 'name',  // Field that will be slugged
        'slug'      => 'slug',  // Field that will be used for the slug
        'lowercase' => true,    // Do we lowercase the slug ?
        'separator' => '-',     //
        'overwrite' => false    // Does the slug is auto generated when field is saved no matter what
    );
    private $options = array();

    public function setup(Model $model, $config = array()){
        $this->options[$model->alias] = array_merge($this->defaultOptions, $config);
    }

    /**
    * CakePHP Model Functions
    **/
    public function beforeSave(Model $model, $options = array()){
        $data = $model->data;
        $options = $this->options[$model->alias];
        if(
            isset($data[$model->alias][$options['field']]) &&
            (
                (!$options['overwrite'] && isset($data[$model->alias][$options['slug']]) && empty($data[$model->alias][$options['slug']])) ||
                $options['overwrite']
            )
        ){
            $slug = Inflector::slug($data[$model->alias][$options['field']], $options['separator']);
            if($options['lowercase']){
                $slug = strtolower($slug);
            }
            $model->data[$model->alias][$options['slug']] = $slug;
        }
    }


}