<?php

namespace Mollie\Api\Endpoints;

use Mollie\Api\Exceptions\ApiException;
use Mollie\Api\Resources\Order;
use Mollie\Api\Resources\OrderLine;
use Mollie\Api\Resources\OrderLineCollection;
use Mollie\Api\Resources\ResourceFactory;
class OrderLineEndpoint extends \Mollie\Api\Endpoints\EndpointAbstract
{
    protected $resourcePath = "orders_lines";
    /**
     * @var string
     */
    const RESOURCE_ID_PREFIX = 'odl_';
    /**
     * Get the object that is used by this API endpoint. Every API endpoint uses one
     * type of object.
     *
     * @return OrderLine
     */
    protected function getResourceObject()
    {
        return new \Mollie\Api\Resources\OrderLine($this->client);
    }
    /**
     * Get the collection object that is used by this API endpoint. Every API
     * endpoint uses one type of collection object.
     *
     * @param int $count
     * @param object[] $_links
     *
     * @return OrderLineCollection
     */
    protected function getResourceCollectionObject($count, $_links)
    {
        return new \Mollie\Api\Resources\OrderLineCollection($count, $_links);
    }
    /**
     * Cancel lines for the provided order.
     * The data array must contain a lines array.
     * You can pass an empty lines array if you want to cancel all eligible lines.
     * Returns null if successful.
     *
     * @param Order $order
     * @param array $data
     *
     * @return null
     * @throws ApiException
     */
    public function cancelFor(\Mollie\Api\Resources\Order $order, array $data)
    {
        if (!isset($data, $data['lines']) || !\is_array($data['lines'])) {
            throw new \Mollie\Api\Exceptions\ApiException("A lines array is required.");
        }
        $this->parentId = $order->id;
        $this->client->performHttpCall(self::REST_DELETE, "{$this->getResourcePath()}", $this->parseRequestBody($data));
        return null;
    }
}
