<?php

namespace Neptune\FirstModule\Api;


use Magento\Framework\Exception\AuthenticationException;
/**
 * Neptune Api to get login customer
 */

interface LoginRepositoryInterface{
	/**
	 *Login a customer
	 *
     *@param string $email
     *@param string $password
     *@return mixed []
	 *@throws AuthenticationException
	 */

	public function login($email, $password);
}