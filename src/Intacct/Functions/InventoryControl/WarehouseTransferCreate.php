<?php

namespace Intacct\Functions\InventoryControl;

use Intacct\Xml\XMLWriter;
use InvalidArgumentException;

class WarehouseTransferCreate extends AbstractWarehouseTransfer
{

    public function writeXml(XMLWriter &$xml)
    {
        $xml->startElement('function');

        $xml->writeAttribute('controlid', $this->getControlId());

        $xml->startElement('create');
        $xml->startElement('ICTRANSFER');

        if (!$this->transactionDate) {
            throw new InvalidArgumentException('Transaction Date is required.');
        } else {
            $xml->writeElement('TRANSACTIONDATE', $this->getTransactionDate());
        }
        $xml->writeElement('REFERENCENO', $this->getReferenceNo());
        $xml->writeElement('DESCRIPTION', $this->description);
        $xml->writeElement('TRANSFERTYPE', $this->getTransferType());
        $xml->writeElement('ACTION', $this->getAction());
        $xml->writeElement('OUTDATE', $this->getOutDate());
        $xml->writeElement('INDATE', $this->getInDate());
        if ($this->exchRateTypeId && $this->exchangeRate) {
            throw new InvalidArgumentException('Cannot use both Exchange Rate Type ID and Exchange rate.');
        }
        if ($this->getExchRateTypeId() && $this->getExchRateDate()) {
            $xml->writeElement('EXCH_RATE_TYPE_ID', $this->getExchRateTypeId());
            $xml->writeElement('EXCH_RATE_DATE', $this->getExchRateDate());
        } else if ($this->getExchangeRate()) {
            $xml->writeElement('EXCHANGE_RATE', $this->getExchangeRate());
        }

        $xml->startElement('ICTRANSFERITEMS');
        if (count($this->getItems()) > 0) {
            foreach ($this->getItems() as $item) {
                $item->writeXml($xml);
            }
        } else {
            throw new InvalidArgumentException('Warehouse Transfer must have at least 1 Item.');
        }
        $xml->endElement();//ICTRANFERITEMS

        $xml->endElement();//icTransfer
        $xml->endElement();//create

        $xml->endElement(); //function
    }
}