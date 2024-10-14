<?php

namespace Intacct\Functions\InventoryControl;

use Intacct\Xml\XMLWriter;
use InvalidArgumentException;

class WarehouseTransferDelete extends AbstractWarehouseTransfer
{

    public function writeXml(XMLWriter &$xml)
    {
        $xml->startElement('function');
        $xml->writeAttribute('controlid', $this->getControlId());

        $xml->startElement('delete');
        $xml->writeElement('object', 'ICTRANSFER');
        if (!$this->recordNo) {
            throw new InvalidArgumentException('Record Number required for delete.');
        } else {
            $xml->writeElement('keys', $this->getRecordNo());
        }
        $xml->endElement();

        $xml->endElement();
    }
}