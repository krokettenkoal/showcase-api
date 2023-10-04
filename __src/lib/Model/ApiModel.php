<?php

class ApiModel {
    public function __construct(?array $data)
    {
        if ($data) {
            $this->_apply($data);
        }
    }

    public function _apply(array $data): void
    {
        foreach ($data as $key => $value) {
            if(property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }
}