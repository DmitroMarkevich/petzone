<?php

namespace App\Services\Profile;

use Daaner\NovaPoshta\Models\Address;

class AddressService
{
    private Address $address;

    public function __construct(Address $address)
    {
        $this->address = $address;
        $this->address->setLimit(20);
    }

    /**
     * Search for cities based on the provided term.
     */
    public function searchCities(string $searchTerm): array
    {
        return $this->address->searchSettlements($searchTerm);
    }

    /**
     * Search for streets in the specified city.
     */
    public function searchStreets(string $cityRef, string $searchTerm): array
    {
        return $this->address->getStreet($cityRef, $searchTerm);
    }
}
