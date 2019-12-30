<?php

namespace Mollie\Api\Endpoints;

use Mollie\Api\Resources\BaseCollection;
use Mollie\Api\Resources\Customer;
use Mollie\Api\Resources\Mandate;
use Mollie\Api\Resources\MandateCollection;
class MandateEndpoint extends \Mollie\Api\Endpoints\EndpointAbstract
{
    protected $resourcePath = "customers_mandates";
    /**
     * Get the object that is used by this API endpoint. Every API endpoint uses one type of object.
     *
     * @return Mandate
     */
    protected function getResourceObject()
    {
        return new \Mollie\Api\Resources\Mandate($this->client);
    }
    /**
     * Get the collection object that is used by this API endpoint. Every API endpoint uses one type of collection object.
     *
     * @param int $count
     * @param object[] $_links
     *
     * @return MandateCollection
     */
    protected function getResourceCollectionObject($count, $_links)
    {
        return new \Mollie\Api\Resources\MandateCollection($this->client, $count, $_links);
    }
    /**
     * @param Customer $customer
     * @param array $options
     * @param array $filters
     *
     * @return Mandate
     */
    public function createFor(\Mollie\Api\Resources\Customer $customer, array $options = [], array $filters = [])
    {
        $this->parentId = $customer->id;
        return parent::rest_create($options, $filters);
    }
    /**
     * @param Customer $customer
     * @param string $mandateId
     * @param array $parameters
     *
     * @return Mandate
     */
    public function getFor(\Mollie\Api\Resources\Customer $customer, $mandateId, array $parameters = [])
    {
        $this->parentId = $customer->id;
        return parent::rest_read($mandateId, $parameters);
    }
    /**
     * @param Customer $customer
     * @param string $from The first resource ID you want to include in your list.
     * @param int $limit
     * @param array $parameters
     *
     * @return MandateCollection
     */
    public function listFor(\Mollie\Api\Resources\Customer $customer, $from = null, $limit = null, array $parameters = [])
    {
        $this->parentId = $customer->id;
        return parent::rest_list($from, $limit, $parameters);
    }
    /**
     * @param Customer $customer
     * @param string $mandateId
     *
     * @param array $data
     * @return null
     * @throws \Mollie\Api\Exceptions\ApiException
     */
    public function revokeFor(\Mollie\Api\Resources\Customer $customer, $mandateId, $data = [])
    {
        $this->parentId = $customer->id;
        return parent::rest_delete($mandateId, $data);
    }
}
