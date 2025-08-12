<?php

namespace Intacct\Functions\InventoryControl;

use Intacct\Functions\AbstractFunction;
use Intacct\Xml\XMLWriter;
use InvalidArgumentException;

/**
 * Create a new item record
 */
class ProductLineCreate extends AbstractFunction
{

    /** @var string */
    protected string|null $lineDescription = null;
    protected string|null $lineId = null;

    /**
     * @return string|null
     */
    public function getLineDescription(): string|null
    {
        return $this->lineDescription;
    }
    /*
     * @return string|null
     */
    public function getLineId()
    {
        return $this->lineId;
    }


    public function setLineId(string|null $lineId): void {
        $this->lineId = $lineId;
    }
    public function setLineDescription(string|null $lineDescription): void {
        $this->lineDescription = $lineDescription;
    }

    /**
     * Write the function block XML
     *
     * @param XMLWriter $xml
     * @throw InvalidArgumentException
     */
    public function writeXml(XMLWriter &$xml)
    {
        $xml->startElement('function');
        $xml->writeAttribute('controlid', $this->getControlId());

        $xml->startElement('create');
        $xml->startElement('PRODUCTLINE');

        if (!$this->getLineId()) {
            throw new InvalidArgumentException('Line ID is required for creating a product line.');
        }
        $xml->writeElement('PRODUCTLINEID', $this->getLineId(), true);

        if ($this->getLineDescription()) {
            $xml->writeElement('DESCRIPTION', $this->getLineDescription(), true);
        }

        $xml->endElement(); //PRODUCTLINE
        $xml->endElement(); //create

        $xml->endElement(); //function
    }
}
