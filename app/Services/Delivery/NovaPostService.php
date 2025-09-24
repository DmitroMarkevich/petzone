<?php

namespace App\Services\Delivery;

use App\Models\Order\Order;
use App\Models\Order\OrderRecipient;
use App\Services\Delivery\Contracts\DeliveryService;
use Daaner\NovaPoshta\Models\Address;
use Daaner\NovaPoshta\Models\InternetDocument;

class NovaPostService implements DeliveryService
{
    protected Address $address;
    private InternetDocument $intDoc;

    public function __construct(Address $address, InternetDocument $intDoc)
    {
        $this->intDoc = $intDoc;
        $this->intDoc->setAPI(config('novaposhta.api_key'));

        $this->address = $address;
    }

    // todo
    public function createTTN(Order $order, OrderRecipient $recipient): array
    {
        return [];
    }

    public function getWarehouses(string $city, int $page = 1, ?string $warehouseRef = null): array
    {
        $this->address->setPage($page);

        if ($warehouseRef) {
            $this->address->setTypeOfWarehouseRef($warehouseRef);
        }

        $isUuid = preg_match('/^[0-9a-fA-F-]{36}$/', $city) === 1;

        return $this->address->getWarehouses($city, !$isUuid);
    }

    // todo
    public function calculatePrice(Order $order, OrderRecipient $recipient): float
    {
        return 0;
    }
}
