<?php

namespace Intacct\Functions\InventoryControl;

use Intacct\Xml\XMLWriter;
use InvalidArgumentException;

class WarehouseTransferUpdate extends AbstractWarehouseTransfer
{

    public function writeXml(XMLWriter &$xml)
    {
        $xml->startElement('function');
        $xml->startElement('update');

        $xml->startElement('ICTRANSFER');
        if (!$this->recordNo) {
            throw new InvalidArgumentException('Record Number required for update');
        } else {
            $xml->writeElement('RECORDNO', $this->getRecordNo());
        }
        $xml->writeElement('ACTION', $this->getAction());
        $xml->writeElement('TRANSACTIONDATE', $this->getTransactionDate());
        $xml->writeElement('OUTDATE', $this->getOutDate());
        $xml->writeElement('INDATE', $this->getInDate());
        $xml->writeElement('REFERENCENO', $this->getReferenceNo());
        $xml->writeElement('DESCRIPTION', $this->getDescription());
        if ($this->exchRateTypeId && $this->exchangeRate) {
            throw new InvalidArgumentException('Cannot use both Exchange Rate Type ID and Exchange rate.');
        }
        $xml->writeElement('EXCH_RATE_TYPE_ID', $this->getExchRateTypeId());
        $xml->writeElement('EXCH_RATE_DATE', $this->getExchRateDate());
        $xml->writeElement('EXCHANGE_RATE', $this->getExchangeRate());
        $xml->startElement('ICTRANFERITEMS');
        if (count($this->getItems()) > 0) {
            foreach ($this->getItems() as $item) {
                $item->writeXml($xml);
            }
        }
        $xml->endElement();
        $xml->endElement();

        $xml->endElement();
        $xml->endElement();
    }
}