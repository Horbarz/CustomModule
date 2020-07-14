<?php

namespace Neptune\FirstModule\Model;

use Magento\Framework\Exception\EmailNotConfirmedException;
use Magento\Framework\Exception\AuthenticationException;
use Magento\Customer\Api\AccountManagementInterface;
use Neptune\FirstModule\Api\LoginRepositoryInterface;

class LoginRepository implements LoginRepositoryInterface{

    /**
	 * @var AccountManagementInterface
	 */
    protected $customerAccountManagement;
    
    /**
	 * LoginRepository constructor.
	 * @param AccountManagementInterface $customerAccountManagement
	 */

    public function __construct(AccountManagementInterface $customerAccountManagement){
        $this->customerAccountManagement = $customerAccountManagement;
    } 

    /**
	 * Get Product by its ID
	 * @param string $email
     * @param string $password
     * @return mixed []
	 * @throws EmailNotConfirmedException
     * @throws AuthenticationException
	 */

    public function login($email, $password){
        $login = array();
        if($email)
            $login['username'] = $email;
        if($password)
            $login['password'] = $password;
        
        if(!empty($login['username']) && !empty($login['password'])){
            try{
                $customer = $this->customerAccountManagement
                                ->authenticate($login['username'], $login['password']);
                $code = 200;
                $error = false;
                $data = array('id'=>$customer->getId(),
                            'username'=>$customer->getEmail(),
                            'name'=>ucwords($customer->getFirstName().' '. $customer->getLastName())
            );
            }catch(EmailNotConfirmedException $e){
                $value = $this->customerUrl->getEmailConfirmationUrl($login['username']);
                $data = __(
                    'This account is not confirmed.'.'<a href="%1">Click here</a> to resend confirmation mail.'. $value
                );
                $code = 404;
            }catch(AuthenticationException $e){
                $data = __('Invalid login or password.');
                $code = 0;
                $error = true;
            }
        }else{
            $data = __('Invalid login or password.');
            $code = 404;
            $error = true;
        }
        $result = array('status'=>$code,'error'=>$error,'message'=>strval($code),'data'=>array($data));
        header("Content-Type: applicationn/json; charset=utf-8");
        $this->response = json_encode($result);
        print_r($this->response,false);
        die();
    }
}