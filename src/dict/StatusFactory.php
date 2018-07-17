<?php 
namespace AppWidget\dict;

class StatusFactory extends DictFactory{
    public function createDict(){
        return new Status();
    }
}