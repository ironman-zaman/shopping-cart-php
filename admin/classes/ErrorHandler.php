<?php
namespace ShoppingCart;
class ErrorHandler{
    private $errors=array();
    public function errors($key=-1,$error=-1){
        if ($key!=-1 && $error !=-1) {
            $this->errors[$key] = $error;
        }
        if(count($this->errors)===0){
            return false;
        }
        else return $this->errors;
    }
}