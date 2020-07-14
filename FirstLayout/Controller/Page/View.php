<?php

declare(strict_types=1);

namespace Neptune\FirstLayout\Controller\Page;

use Magento\Framework\App\Action\Action;
use Magento\Framework\View\Result\Page;
use Magento\Framework\Controller\ResultFactory;

class View extends Action{
    public function execute()
    {
       return $this->resultFactory->create(ResultFactory::TYPE_PAGE);
    }
}