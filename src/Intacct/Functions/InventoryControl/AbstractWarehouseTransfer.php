<?php

namespace Intacct\Functions\InventoryControl;

use InvalidArgumentException;
use Intacct\Functions\AbstractFunction;

abstract class AbstractWarehouseTransfer extends AbstractFunction
{
    const STATE_DRAFT        = 'Draft';
    const STATE_POST         = 'Post';
    const STATE_TRANSFER_OUT = 'Transfer Out';
    const STATE_TRANSFER_IN  = 'Transfer In';

    /** @var string */
    protected $recordNo;
    /** @var string */
    protected $transactionDate;
    /** @var string */
    protected $referenceNo;
    /** @var string */
    protected $description;
    /** @var string */
    protected $transferType;
    /** @var string */
    protected $action;
    /** @var string */
    protected $outDate;
    /** @var string */
    protected $inDate;
    protected ?string $exchRateTypeId = null;
    protected ?string $exchRateDate = null;
    protected ?string $exchangeRate = null;
    /** @var AbstractWarehouseTransferItem[] */
    protected $icTransferItems = [];

    public function getRecordNo(): string
    {
        return $this->recordNo;
    }

    public function setRecordNo(string $recordNo): void
    {
        $this->recordNo = $recordNo;
    }



    public function getTransactionDate(): string
    {
        return $this->transactionDate;
    }

    public function setTransactionDate(string $transactionDate): void
    {
        $this->transactionDate = $transactionDate;
    }

    public function getReferenceNo(): string
    {
        return $this->referenceNo;
    }

    public function setReferenceNo(string $referenceNo): void
    {
        $this->referenceNo = $referenceNo;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getTransferType(): string
    {
        return $this->transferType;
    }

    public function setTransferType(string $transferType): void
    {
        if (!in_array($transferType, ['Immediate', 'In transit'])) {
            throw new InvalidArgumentException('Transfer type must be "Immediate", or "In transit"');
        }
        $this->transferType = $transferType;
    }

    public function getAction(): string
    {
        return $this->action;
    }

    public function setAction(string $action): void
    {
        if ($this->transferType === 'Immediate') {
            if (!in_array($action, ['Draft', 'Post'])) {
                throw new InvalidArgumentException(
                    'When Transfer type is Immediate action must be "Draft", or "Post".'
                );
            }
        }

        if ($this->transferType === 'In transit') {
            if (!in_array($action, ['Draft', 'Transfer out', 'Transfer in'])) {
                $msg = 'When Transfer type is "In transit" action must be "Draft", "Transfer out", or "Transfer in".';
                throw new InvalidArgumentException($msg);
            }
        }

        $this->action = $action;
    }

    public function getOutDate(): string
    {
        return $this->outDate;
    }

    public function setOutDate(string $outDate): void
    {
        $this->outDate = $outDate;
    }

    public function getInDate(): string
    {
        return $this->inDate;
    }

    public function setInDate(string $inDate): void
    {
        $this->inDate = $inDate;
    }

    public function getExchRateTypeId(): string|null
    {
        return $this->exchRateTypeId;
    }

    public function setExchRateTypeId(string $exchRateTypeId): void
    {
        if ($this->exchangeRate) {
            throw new InvalidArgumentException('Cannot use both Exchange Rate Type ID and Exchange rate.');
        }
        $this->exchRateTypeId = $exchRateTypeId;
    }

    public function getExchRateDate(): string|null
    {
        return $this->exchRateDate;
    }

    public function setExchRateDate(string $exchRateDate): void
    {
        $this->exchRateDate = $exchRateDate;
    }

    public function getExchangeRate(): string|null
    {
        return $this->exchangeRate;
    }

    public function setExchangeRate(string $exchangeRate): void
    {
        if ($this->exchRateTypeId) {
            throw new InvalidArgumentException('Cannot use both Exchange Rate Type ID and Exchange rate.');
        }
        $this->exchangeRate = $exchangeRate;
    }

    public function getItems(): array
    {
        return $this->icTransferItems;
    }

    /**
     * @param  AbstractWarehouseTransferItem[] $items
     * @return void
     */
    public function setItems(array $items): void
    {
        $this->icTransferItems = $items;
    }
}