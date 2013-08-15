<?php namespace Justinhilles\Admin\Validators;

abstract class Validator {
 
  protected $input;
 
  protected $messages;

  protected $validation;
 
  public function __construct($input = NULL)
  {
    $this->input = $input ? : \Input::all();
  }
 
  public function passes()
  {
    $this->validation = \Validator::make($this->input, static::$rules);
 
    if($this->validation->passes()) return true;
     
    $this->messages = $this->validation->messages();
 
    return false;
  }
 
  public function messages()
  {
    return $this->messages;
  }

  public function data()
  {
  	return $this->validation->getData();
  }
 
}