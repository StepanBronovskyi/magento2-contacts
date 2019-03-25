<?php
namespace Vendor\Contacts\Ui\Component\DataProvider;

class Grid extends \Magento\Framework\View\Element\UiComponent\DataProvider\DataProvider {

    private $contactsCollectionFactory;

    public function __construct(
        $name,
        \Magento\Framework\Api\Search\ReportingInterface $reporting,
        \Magento\Framework\Api\Search\SearchCriteriaBuilder $searchCriteriaBuilder,
        \Magento\Framework\App\RequestInterface $request,
        \Magento\Framework\Api\FilterBuilder $filterBuilder,
        \Magento\Framework\UrlInterface $url,
        \Vendor\Contacts\Model\ContactFactory $contactsFactury
    ) {
        $this->contactsCollectionFactory = $contactsFactury;
        $primaryFieldName = 'id';
        $requestFieldName = 'id';
        $meta = [];
        $updateUrl = $url->getUrl('mui/index/render');
        $data = [
            'config' => [
                'component' => 'Magento_Ui/js/grid/provider',
                'update_url' => $updateUrl
            ]
        ];
        parent::__construct($name, $primaryFieldName, $requestFieldName, $reporting, $searchCriteriaBuilder, $request,
            $filterBuilder, $meta, $data);
    }

    public function getData()
    {
        $contactModel = $this->contactsCollectionFactory->create();
        $collection = $contactModel->getCollection()->setOrder('id','DESC');

        $result = [];
        foreach($collection as $item){
            $result['items'][] = $item->getData();
        }
        $result['totalRecords'] = 1;
        return $result;
    }

}