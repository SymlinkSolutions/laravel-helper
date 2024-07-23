<?php

namespace Symlink\LaravelHelper\Properties;

use Illuminate\Support\Facades\Log;

class Property {

    /**
     * @var App\Model
     */
    protected $model = false;

    public function __construct($model = false) {
        $this->model = $model;
    }

    public function key() {
        return false;
    }

    public function default() {
        return false;
    }

    public function value() {
        $value = session($this->key());
        if (!$value){
            try{
                $property = $this->model->properties()->where("key", $this->key())->first();
                if (!$property) $value = $this->default();
                else $value = $property->value;
            } catch (\Exception $e) {
                $value = $this->default();
            }
            session([$this->key() => $value]);
        }
        return $value;
    }

    public function save($value) {
        if ($value == session($this->key())) return;

        // Use firstOrCreate to get the property
        $property = $this->model->properties()->firstOrCreate(
            ['key' => $this->key()],
            ['value' => $value]
        );

        // Check if the value needs to be updated
        if ($property->wasRecentlyCreated || $property->value !== $value) {
            $property->value = $value;
            $property->save();
        }

        // Update the session value
        session([$this->key() => $value]);
    }

    public function get_data_arr(){
        return [];
    }

}