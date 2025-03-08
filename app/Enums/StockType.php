<?php

namespace App\Enums;

enum StockType: string
{
    case StockItem = 'stock';
    case NonStockItem = 'non_stock';
    case Process = 'process';

    public function label(): string
    {
        return match ($this) {
            self::StockItem => 'Stock Item',
            self::NonStockItem => 'Non Stock Item',
            self::Process => 'Process',
        };
    }
}
