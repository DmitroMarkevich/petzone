<?php

namespace App\Services\Delivery;

use App\Models\Advert\Advert;
use App\Services\Delivery\Contracts\DeliveryService;
use Daaner\NovaPoshta\Models\Address;
use Daaner\NovaPoshta\Models\InternetDocument;

class NovaPostService implements DeliveryService
{
    private Address $address;
    private InternetDocument $intDoc;

    public function __construct(InternetDocument $intDoc)
    {
        $this->intDoc = $intDoc;
        $this->address = new Address();
    }

    public function getWarehouses(string $cityRef, int $page = 1, string $warehouseRef = null): array
    {
        $this->address->setPage($page);

        if ($warehouseRef) {
            $this->address->setTypeOfWarehouseRef($warehouseRef);
        }

        return $this->address->getWarehouses($cityRef, false);
    }

    public function filterWarehousesByTypes(array $warehouses, $typeOfWarehouseCode): array
    {
        return $warehouses;
    }

    public function getDocumentPrice(Advert $advert, string $citySender, $cityRecipient)
    {
    }
}
