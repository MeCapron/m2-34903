<?php

namespace M2test\CustomerExt\Controller\Account;

use M2test\CustomerExt\Model\AttributeTestingBlah;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Customer\Api\Data\CustomerInterface;
use Magento\Customer\Model\Session;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Reflection\DataObjectProcessor;
use Magento\Framework\View\Result\PageFactory;

class Edit extends \Magento\Customer\Controller\Account\Edit
{
    /**
     * @var DataObjectProcessor
     */
    protected $dataObjectProcessor;

    public function __construct(
        Context $context,
        Session $customerSession,
        PageFactory $resultPageFactory,
        CustomerRepositoryInterface $customerRepository,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor
    ) {
        parent::__construct($context, $customerSession, $resultPageFactory, $customerRepository, $dataObjectHelper);
        $this->dataObjectProcessor = $dataObjectProcessor;
    }

    public function execute()
    {
        /** @var \Magento\Framework\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();

        $block = $resultPage->getLayout()->getBlock('customer_edit');
        if ($block) {
            $block->setRefererUrl($this->_redirect->getRefererUrl());
        }

        $data = $this->session->getCustomerFormData(true);
        $customerId = $this->session->getCustomerId();
        $customerDataObject = $this->customerRepository->getById($customerId);

        $extension = $customerDataObject->getExtensionAttributes();
        $extension->setMyObj((new \M2test\CustomerExt\Model\Response())->setAttribute(new AttributeTestingBlah()));
        print_r($extension->getMyObj());

        $this->dataObjectProcessor->buildOutputDataArray($customerDataObject, CustomerInterface::class);

        die;
        if (!empty($data)) {
            $this->dataObjectHelper->populateWithArray(
                $customerDataObject,
                $data,
                \Magento\Customer\Api\Data\CustomerInterface::class
            );
        }
        $this->session->setCustomerData($customerDataObject);
        $this->session->setChangePassword($this->getRequest()->getParam('changepass') == 1);

        $resultPage->getConfig()->getTitle()->set(__('Account Information'));

        return $resultPage;
    }
}
