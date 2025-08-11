<?php

namespace App\Services\Delivery;

use App\Models\Advert\Advert;
use App\Services\Contracts\DeliveryService;
use Daaner\NovaPoshta\Models\Address;
use Daaner\NovaPoshta\Models\InternetDocument;

class NovaPostService implements DeliveryService
{
    private Address $address;
    private InternetDocument $intDoc;

    /**
     * @param InternetDocument $intDoc
     */
    public function __construct(InternetDocument $intDoc)
    {
        $this->intDoc = $intDoc;
        $this->address = new Address();
    }

    /**
     * Get warehouses in the specified city and warehouse type with pagination support.
     *
     * @param string $cityRef
     * @param int $page
     * @param string|null $warehouseRef
     * @return array
     */
    public function getWarehouses(string $cityRef, int $page = 1, string $warehouseRef = null): array
    {
        $this->address->setPage($page);

        if ($warehouseRef) {
            $this->address->setTypeOfWarehouseRef($warehouseRef);
        }

        return $this->address->getWarehouses($cityRef, false);
    }

    /**
     * Filter warehouses by allowed branch types.
     *
     * @param array $warehouses
     * @param
     * @return array
     */
    public function filterWarehousesByTypes(array $warehouses, $typeOfWarehouseCode): array
    {
        return $warehouses;
    }

    public function getDocumentPrice(Advert $advert, string $citySender, $cityRecipient)
    {
    }
}
