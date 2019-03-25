<?php
namespace Vendor\Contacts\Ui\Component\Listing\Column;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\UrlInterface;

class Accept extends Column
{
    /** Url path */
    const URL_PATH_ACCEPT = 'contact/accept/index';

    /** @var UrlBuilder */
    protected $actionUrlBuilder;

    /** @var UrlInterface */
    protected $urlBuilder;

    /**
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param UrlBuilder $actionUrlBuilder
     * @param UrlInterface $urlBuilder
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        array $components = [],
        array $data = []
    ) {
        $this->urlBuilder = $urlBuilder;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }
    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                $name = $this->getData('name');
                if (isset($item['id'])) {
                    $item[$name]['accept'] = [
                        'href' => $this->urlBuilder->getUrl(self::URL_PATH_ACCEPT, ['id' => $item['id']]),
                        'label' => __('Accept'),
                        'confirm' => [
                            'title' => __('Accept ${ $.$data.first_name } ${ $.$data.last_name }'),
                            'message' => __('Are you sure you wan\'t to accept a ${ $.$data.first_name } ${ $.$data.last_name } contact?')
                        ]
                    ];
                }
            }
        }
        return $dataSource;
    }
}