<?php

namespace Neptune\FirstModule\Model\Data;

use Neptune\FirstModule\Api\Data\PublicCategoriesInterface;
use Magento\Framework\DataObject;

class Product extends DataObject implements PublicCategoriesInterface
{
	/**
	 *@return int
	 */
	public function getId(){
		return $this->getData('id');
	}

	/**
	 *@param int $id
	 *@return $this
	 */
	public function setId($id){
		return $this->setData('id',$id);
	}

	/**
	 *@return string
	 */
	public function getName(){
		return $this->getData('name');
	}

	/**
	 *@param string $name
	 *@return $this
	 */
	public function setName($name){
		return $this->setData('name',$name);
	}

	/**
	 *@return int
	 */
	public function getParentId(){
		return $this->getData('parent_id');
	}

	/**
	 *@param int $parent_id
	 *@return $this
	 */
	public function setParentId($parent_id){
		return $this->setData('parent_id',$parent_id);
	}

	/**
	 *@return string
	 */
	public function getPath(){
		return $this->getData('path');
	}

	/**
	 *@param string $path
	 *@return $this
	 */
	public function setPath($path){
		return $this->setData('path',$path);
	}

	/**
	 *@return int
	 */
	public function getPosition(){
		return $this->getData('position');
	}

	/**
	 *@param int $position
	 *@return $this
	 */
	public function setPosition($position){
		return $this->setData('position',$position);
	}

	/**
	 *@return int
	 */
	public function getLevel(){
		return $this->getData('level');
	}
	/**
	 *@param int $level
	 *@return $this
	 */
	public function setLevel($level){
		return $this->setData('level',$level);
	}

	/**
	 *@return string
	 */

	public function getChildrenCount(){
		return $this->getData('children_count');
	}

	/**
	 *@param string $children_count
	 *@return $this
	 */
	public function setChildrenCount($children_count){
		return $this->setData('childern_count',$children_count);
	}

}