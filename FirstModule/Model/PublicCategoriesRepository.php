<?php

namespace Neptune\FirstModule\Model;

use Magento\Framework\Exception\NoSuchEntityException;
use Neptune\FirstModule\Api\PublicCategoriesRepositoryInterface;
use Magento\Catalog\Model\ResourceModel\Category\CollectionFactory;
use Magento\Catalog\Helper\Category;


class PublicCategoriesRepository implements PublicCategoriesRepositoryInterface{

	/**
	 * @var CollectionFactory
	 */
	protected $_categoryCollectionFactory;

	/**
	 * @var Category
	 */
	protected $_categoryHelper;


	/**
	 * PublicCatRepository constructor.
	 * @param CollectionFactory $categoryCollectionFactory
	 * @param Category $categoryHelper
	 */
	public function __construct(
		CollectionFactory $categoryCollectionFactory,
		Category $categoryHelper
	){
		$this->_categoryCollectionFactory = $categoryCollectionFactory;
		$this->_categoryHelper = $categoryHelper;
	}

	/**
	 * Get Product by its ID
	 * @return \Neptune\FirstModule\Api\Data\PublicCategoriesInterface
	 * @throws NoSuchEntityException
	 */

	public function getPublicCategories(){
		// /** @var \Neptune\FirstModule\Api\Data\PublicCategoriesInterface $publicCategoriesInterface*/
		$collections = $this->_categoryCollectionFactory->create();
		$final_collections = array();
		try {
			$collections->addAttributeToSelect('*');
			$collections->addIsActiveFilter();
			$code = 200;
			$error = false;
			foreach($collections as $categories){
				if($categories->getLevel()>2){
					//$publicCategoriesInterface->setId($categories->getId());
					$collections = array(
						'id'=>$categories->getId(),
						'name'=>$categories->getName(),
						'parent_id'=>$categories->getParentId(),
						'path'=>$categories->getPath(),
						'position'=>$categories->getPosition(),
						'level'=>$categories->getLevel(),
						'children_count'=>$categories->getChildrenCount()

					);
				}	
				array_push($final_collections,$collections);
			}

			
			
			$result = array('status'=>$code,'error'=>$error,'message'=>strval($code),'data'=> array('data'=>$final_collections));
			header("Content-Type: applicationn/json; charset=utf-8");
			$this->response = json_encode($result);
			print_r($this->response,false);
			die();
		}catch(NoSuchEntityException $e){
			echo $e;
		}
	}


}