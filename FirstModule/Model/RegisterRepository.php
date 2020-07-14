<?php

namespace Neptune\FirstModule\Model;

use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\Exception\AuthenticationException;
use Magento\Customer\Api\AccountManagementInterface;
use Neptune\FirstModule\Api\RegisterRepositoryInterface;
use Magento\Framework\App\RequestFactory;
use Magento\Customer\Model\CustomerExtractor;


class RegisterRepository implements RegisterRepositoryInterface{
    /**
     * @var RequestFactory
     */
    protected $requestFactory;

    /**
     * @var CustomerExtractor
     */
    protected $customerExtractor;

    /**
	 * @var AccountManagementInterface
	 */
    protected $customerAccountManagement;
    
    /**
	 * RegisterRepository constructor.
     * @param RequestFactory $requestFactory
     * @param CustomerExtractor $customerExtractor
	 * @param AccountManagementInterface $customerAccountManagement
	 */

    public function __construct(AccountManagementInterface $customerAccountManagement,
                                    RequestFactory $requestFactory,
                                    CustomerExtractor $customerExtractor
    ){
        
        $this->customerAccountManagement = $customerAccountManagement;
        $this->requestFactory = $requestFactory;
        $this->customerExtractor = $customerExtractor;
    } 

    /**
	 * Register a user
	 * @param string $email
     * @param string $password
     * @param string $firstname
     * @param string $lastname
	 * @throws AlreadyExistsException
     * @throws AuthenticationException
	 */

    public function register($email, $password, $firstname, $lastname){
        $register = array();
        if($email)
            $register['username'] = $email;
        if($password)
            $register['password'] = $password;
        if($firstname)
            $register['firstname'] = $firstname;
        if($lastname)
            $register['lastname'] = $lastname;
               
        $request = $this->requestFactory->create();
        $request->setParams($register);
        
        if(!empty($register['username']) && 
            !empty($register['password']) &&
            !empty($register['firstname']) &&
            !empty($register['lastname'])){
            try{
                $customer = $this->customerExtractor->extract('customer_account_create', $request);
                $customer = $this->customerAccountManagement
                                ->createAccount($customer, $register['password']);
                $code = 200;
                $error = false;
                $data = array('id'=>$customer->getId(),
                            'username'=>$customer->getEmail(),
                            'firstname'=> $customer->getFirstName(),
                            'lastname'=>$customer->getLastName()
            );
            }
            catch(AlreadyExistsException $e){
                $data = __('Invalid login or password.');
                $code = 404;
                $error = true;
            }
            catch(AuthenticationException $e){
                $data = __('Invalid login or password.');
                $code = 404;
                $error = false;
            }
        }else{
            $data = __('Invalid details.');
            $code = 404;
            $error = false;
        }
        $result = array('status'=>$code,'error'=>$error,'message'=>strval($code),'data'=>array($data));
        header("Content-Type: applicationn/json; charset=utf-8");
        $this->response = json_encode($result);
        print_r($this->response,false);
        die();
    }
}