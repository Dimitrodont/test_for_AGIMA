<?php

	/*
	 * Корзина
	 * массив [ключ - это id товара, значение - это количество товара]
	 */
	class Basket{
		private $arr = null;

		function __construct(){
			$this->arr = array();
		}

		function getSize(){
			$size = 0;
			foreach ($this->arr as $value) {
    			$size += $value;
			}
			return $size;
		}

		function getArr(){
			return $this->arr;
		}

		function add($items_ID){
			if(array_key_exists($items_ID, $this->arr)){
				$this->arr[$items_ID] += 1;
			}else{
				$this->arr += [$items_ID => 1];
			}
		}

		function rem($items_ID){
			if(array_key_exists($items_ID, $this->arr)){
				$this->arr[$items_ID] -= 1;
				if($this->arr[$items_ID] == 0){
					unset($this->arr[$items_ID]);
				}
			}
		}

		function del($items_ID){
			if(array_key_exists($items_ID, $this->arr)){
				unset($this->arr[$items_ID]);
			}
		}

		function clear(){
			$this->arr = array();
		}
	}