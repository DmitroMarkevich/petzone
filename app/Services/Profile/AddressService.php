<?php

namespace App\Services\Profile;

use Daaner\NovaPoshta\Models\Address;

class AddressService
{
    protected Address $address;

    public function __construct()
    {
        $this->address = new Address();
        $this->address->setLimit(20);
    }

    /**
     * Search for cities based on the provided term.
     *
     * @param string $searchTerm
     * @return array
     */
    public function searchCities(string $searchTerm): array
    {
        return $this->address->searchSettlements($searchTerm);
    }

    /**
     * Search for streets in the specified city.
     *
     * @param string $cityRef
     * @param string $searchTerm
     * @return array
     */
    public function searchStreets(string $cityRef, string $searchTerm): array
    {
        return $this->address->getStreet($cityRef, $searchTerm);
    }
}
