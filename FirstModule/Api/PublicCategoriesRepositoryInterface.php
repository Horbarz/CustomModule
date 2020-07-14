<?php

namespace Neptune\FirstModule\Api;


use Magento\Framework\Exception\NotFoundException;
/**
 * Neptune Api to get current login customer
 */

interface PublicCategoriesRepositoryInterface{
	/**
	 *Login a customer
	 *
     *@return mixed []
	 *@throws NotFoundException
	 */

	public function getPublicCategories();
}