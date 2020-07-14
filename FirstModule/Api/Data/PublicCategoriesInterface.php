<?php

namespace Neptune\FirstModule\Api\Data;

interface PublicCategoriesInterface
{
	/**
	 *@return int
	 */
	public function getId();

	/**
	 *@param int $id
	 *@return $this
	 */
	public function setId($id);

	
	/**
	 *@return string
	 */
	public function getName();

	/**
	 *@param string $name
	 *@return $this
	 */
	public function setName($name);


	/**
	 *@return int
	 */
	public function getParentId();

	/**
	 *@param int $parent_id
	 *@return $this
	 */
	public function setParentId($parent_id);

	/**
	 *@return string
	 */
	public function getPath();

	/**
	 *@param string $path
	 *@return $this
	 */
	public function setPath($path);

	/**
	 *@return int
	 */
	public function getPosition();

	/**
	 *@param int $position
	 *@return $this
	 */
	public function setPosition($position);

	/**
	 *@return int
	 */
	public function getLevel();

	/**
	 *@param int $level
	 *@return $this
	 */
	public function setLevel($level);


	/**
	 *@return string
	 */
	public function getChildrenCount();

	/**
	 *@param string $children_count
	 *@return $this
	 */
	public function setChildrenCount($children_count);

}