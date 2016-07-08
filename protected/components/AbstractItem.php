<?php

/**
 * Базовый класс элемента выборки
 */
abstract class AbstractItem implements \JsonSerializable {

    protected $_type = '';
    protected $_idProp = 'id';

    /**
     * Получение базового класса (обход бага с instanceof)
     *
     * @param none
     * @return string
     */
    public static function getAbstractClass() {
        return 'AbstractItem';
    }

    public function __construct($values = null) {
        if ($values) {
            $this->setFromArray($values);
        }
    }

    /**
     * Получение массива из объекта
     *
     * @param none
     * @return array
     */
    public function jsonSerialize() {
        return $this->toArray();
    }

    /**
     * Получение объекта из массива 
     *
     * @param array
     * @return none
     */
    public function setFromArray($values) {
        foreach ($values as $key => $value) {
            if (isset($this->$key)) {
                $this->$key = $value;
            }
        }
    }

    /**
     * Получение типа
     *
     * @param none
     * @return string
     */
    public function getType() {
        if ($this->_type) {
            return $this->_type;
        }

        $classExp = explode('_', get_class($this), 2);

        if (isset($classExp[1])) {
            return $this->_type = strtolower($classExp[1]);
        } else {
            throw new Exception("Error class name extends of Item");
        }
    }

    /**
     * Получение идентификатора
     *
     * @param none
     * @return integer
     */
    public function getId() {
        return $this->{$this->_idProp};
    }

    /**
     * Получение массива из объекта
     *
     * @param none
     * @return array
     */
    public function toArray() {
        try{
        $arrayed = [];

        foreach ($this as $key => $value) {
            if (!property_exists ( get_class($this) , $key )){
                continue;
            }
            $prop = new ReflectionProperty($this, $key);
            if (!$prop->isProtected()) {
                $arrayed[$key] = $value;
            }
        }

        $arrayed['type'] = $this->getType();
        $arrayed['id'] = $this->getId();
        }catch(Exception $e){
            var_dump($e->getTraceAsString());die();
        }
        return $arrayed;
    }

    /**
     * Заполнение объекта из массива 
     *
     * @param array
     * @return none
     */
    public function copyFromArray($values) {
        if (!empty($values)) {
            foreach ($values as $prop => $value) {
                $this->{$prop} = $value;
            }
        } else {
            trigger_error('Empty values for setting object.');
        }
    }

}
