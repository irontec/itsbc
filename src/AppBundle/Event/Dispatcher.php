<?php

namespace AppBundle\Event;

use Symfony\Component\DependencyInjection\Reference;


class Dispatcher {

    private $listeners;

    public function __construct(){

        $this->listeners = array();
    }

    public function addListener($listener, string $name){
        $this->listeners[$name] = $listener;
    //public function addListener($a){
    //    $this->listeners[$a[1]] = $a[0];
    }

    public function dispatch($event, $method=null){
            $reference = $this->listeners[(string)$event];
            if(method_exists($reference, $method)) 
                return $reference->$method();

    }

} 

