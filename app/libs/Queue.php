<?php
/**
 * Created by PhpStorm.
 * User: thang
 * Date: 07-Mar-18
 * Time: 02:42 PM
 */
class Queue {

    protected $queue;
    protected $limit;

    public function __construct($limit = 10, $initial = array()) {
        // initialize the stack
        $this->queue = $initial;
        // stack can only contain this many items
        $this->limit = $limit;
    }

    public function push($item) {
        // trap for stack overflow
        if (count($this->queue) < $this->limit) {
            // prepend item to the start of the array
            array_push($this->queue, $item);
        } else {
            throw new RunTimeException('Stack is full!');
        }
    }

    public function pop() {
        if ($this->isEmpty()) {
            // trap for stack underflow
            throw new RunTimeException('Stack is empty!');
        } else {
            // pop item from the start of the array
            return array_shift($this->queue);
        }
    }

    public function peek() {
        return current($this->queue);
    }

    public function isExisted($checkItem){
        foreach ($this->queue as $item){
            if($checkItem === $item) return true;
        }
        return false;
    }

    public function deleteItem($delItem){
        foreach ($this->queue as $item){
            if($delItem === $item) {

            }
        }
    }

    public function isEmpty() {
        return empty($this->queue);
    }
    public function size() {
        return count($this->queue);
    }

    /**
     * @return array
     */
    public function getQueue()
    {
        return $this->queue;
    }
}