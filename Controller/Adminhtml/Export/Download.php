<?php

namespace DarshilTech\Bestsellers\Controller\Adminhtml\Export;

use Magento\Backend\App\Action;
use Magento\Framework\App\Response\Http\FileFactory;
use DarshilTech\Bestsellers\Model\BestSellerExport;

class Download extends Action
{
    protected $bestSellerExport;
    protected $fileFactory;

    public function __construct(
        Action\Context $context,
        BestSellerExport $bestSellerExport,
        FileFactory $fileFactory
    ) {
        parent::__construct($context);
        $this->bestSellerExport = $bestSellerExport;
        $this->fileFactory = $fileFactory;
    }

    public function execute()
    {
        $startDate = $this->getRequest()->getParam('start_date');
        $endDate = $this->getRequest()->getParam('end_date');

        if ($startDate && $endDate) {
            $fileName = 'bestsellers_' . date('Ymd_His') . '.csv';
            $filePath = $this->bestSellerExport->exportBestSellers($startDate, $endDate, $fileName);

            return $this->fileFactory->create(
                $fileName,
                ['type' => 'filename', 'value' => $filePath],
                \Magento\Framework\App\Filesystem\DirectoryList::VAR_DIR,
                'application/octet-stream'
            );
        } else {
            $this->messageManager->addErrorMessage(__('Please provide both start and end dates.'));
            return $this->_redirect('adminhtml/dashboard/index');
        }
    }
}