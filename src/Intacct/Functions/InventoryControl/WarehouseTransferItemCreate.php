<?php

namespace Intacct\Functions\InventoryControl;

use Intacct\Xml\XMLWriter;
use InvalidArgumentException;

class WarehouseTransferItemCreate extends AbstractWarehouseTransferItem
{

    public function writeXml(XMLWriter &$xml)
    {
        $xml->startElement('ICTRANSFERITEM');

        if (!$this->inOut) {
            throw new InvalidArgumentException('IN_OUT is required');
        } else {
            $xml->writeElement('IN_OUT', $this->getInOut());
        }
        if (!$this->itemId) {
            throw new InvalidArgumentException('Item ID is required.');
        } else {
            $xml->writeElement('ITEMID', $this->getItemId());
        }
        if (!$this->warehouseId) {
            throw new InvalidArgumentException('Warehouse ID is required.');
        } else {
            $xml->writeElement('WAREHOUSEID', $this->getWarehouseId());
        }
        $xml->writeElement('MEMO', $this->getMemo());
        if (!$this->quantity) {
            throw new InvalidArgumentException('Quantity is required.');
        } else {
            $xml->writeElement('QUANTITY', $this->getQuantity());
        }
        if (!$this->unit) {
            throw new InvalidArgumentException('Unit is required');
        } else {
            $xml->writeElement('UNIT', $this->getUnit());
        }
        $xml->writeElement('LOCATIONID', $this->getLocationId());
        $xml->writeElement('DEPARTMETNID', $this->getDepartmentId());
        $xml->writeElement('PROJECTID', $this->getProjectId());
        $xml->writeElement('CUSTOMERID', $this->getCustomerId());
        $xml->writeElement('VENDORID', $this->getVendorId());
        $xml->writeElement('EMPLOYEEID', $this->getEmployeeId());
        $xml->writeElement('CLASSID', $this->getClassId());

        $xml->endElement();
    }
}