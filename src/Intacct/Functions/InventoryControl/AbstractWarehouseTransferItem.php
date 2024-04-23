<?php

namespace Intacct\Functions\InventoryControl;

use Intacct\Functions\AbstractFunction;

abstract class AbstractWarehouseTransferItem extends AbstractFunction
{
    protected string $inOut;
    protected string $itemId;
    protected string $warehouseId;
    protected string $memo;
    protected int $quantity;
    protected string $unit;
    protected string $locationId;
    protected string $departmentId;
    protected string $projectId;
    protected string $customerId;
    protected string $vendorId;
    protected string $employeeId;
    protected string $classId;

    public function getInOut(): string
    {
        return $this->inOut;
    }

    public function setInOut(string $inOut): void
    {
        $this->inOut = $inOut;
    }

    public function getItemId(): string
    {
        return $this->itemId;
    }

    public function setItemId(string $itemId): void
    {
        $this->itemId = $itemId;
    }

    public function getWarehouseId(): string
    {
        return $this->warehouseId;
    }

    public function setWarehouseId(string $warehouseId): void
    {
        $this->warehouseId = $warehouseId;
    }

    public function getMemo(): string
    {
        return $this->memo;
    }

    public function setMemo(string $memo): void
    {
        $this->memo = $memo;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

    public function getUnit(): string
    {
        return $this->unit;
    }

    public function setUnit(string $unit): void
    {
        $this->unit = $unit;
    }

    public function getLocationId(): string
    {
        return $this->locationId;
    }

    public function setLocationId(string $locationId): void
    {
        $this->locationId = $locationId;
    }

    public function getProjectId(): string
    {
        return $this->projectId;
    }

    public function setProjectId(string $projectId): void
    {
        $this->projectId = $projectId;
    }

    public function getDepartmentId(): string
    {
        return $this->departmentId;
    }

    public function setDepartmentId(string $departmentId): void
    {
        $this->departmentId = $departmentId;
    }

    public function getCustomerId(): string
    {
        return $this->customerId;
    }

    public function setCustomerId(string $customerId): void
    {
        $this->customerId = $customerId;
    }

    public function getVendorId(): string
    {
        return $this->vendorId;
    }

    public function setVendorId(string $vendorId): void
    {
        $this->vendorId = $vendorId;
    }

    public function getEmployeeId(): string
    {
        return $this->employeeId;
    }

    public function setEmployeeId(string $employeeId): void
    {
        $this->employeeId = $employeeId;
    }

    public function getClassId(): string
    {
        return $this->classId;
    }

    public function setClassId(string $classId): void
    {
        $this->classId = $classId;
    }
}