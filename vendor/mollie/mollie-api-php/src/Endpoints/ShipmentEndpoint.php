<?php

namespace Mollie\Api\Endpoints;

use Mollie\Api\Resources\Order;
use Mollie\Api\Resources\Shipment;
use Mollie\Api\Resources\ShipmentCollection;

class ShipmentEndpoint extends EndpointAbstract
{
    protected $resourcePath = "orders_shipments";

    /**
     * @var string
     */
    const RESOURCE_ID_PREFIX = 'shp_';

    /**
     * Get the object that is used by this API endpoint. Every API endpoint uses one type of object.
     *
     * @return Shipment
     */
    protected function getResourceObject()
    {
        return new Shipment($this->api);
    }

    /**
     * Get the collection object that is used by this API endpoint. Every API
     * endpoint uses one type of collection object.
     *
     * @param int $count
     * @param object[] $_links
     *
     * @return ShipmentCollection
     */
    protected function getResourceCollectionObject($count, $_links)
    {
        return new ShipmentCollection($this->api, $count, $_links);
    }

    /**
     * Create a shipment for some order lines. You can provide an empty array for the
     * "lines" option to include all unshipped lines for this order.
     *
     * @param Order $order
     * @param array $options
     * @param array $filters
     *
     * @return Shipment
     */
    public function createFor(Order $order, array $options = [], array $filters = [])
    {
        $this->parentId = $order->id;
        return parent::rest_create($options, $filters);
    }

    /**
     * Retrieve a single shipment and the order lines shipped by a shipment’s ID.
     *
     * @param Order $order
     * @param string $shipmentId
     * @param array $parameters
     *
     * @return Shipment
     */
    public function getFor(Order $order, $shipmentId, array $parameters = [])
    {
        $this->parentId = $order->id;

        return parent::rest_read($shipmentId, $parameters);
    }

    /**
     * Return all shipments for the Order provided.
     *
     * @param Order $order
     * @param array $parameters
     *
     * @return ShipmentCollection
     */
    public function listFor(Order $order, array $parameters = [])
    {
        $this->parentId = $order->id;

        return parent::rest_list(null, null, $parameters);
    }
}
