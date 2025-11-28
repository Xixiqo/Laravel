<?php

namespace App\Filament\Pages;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Widgets\Widget;

class Dashboard extends BaseDashboard
{
    protected static ?int $navigationSort = -2;

    public function getColumns(): array | int
    {
        return 2;
    }

    public function getHeaderWidgets(): array
    {
        return [
            // Stats will appear at the top
        ];
    }

    public function getFooterWidgets(): array
    {
        return [
            // Additional widgets can go here
        ];
    }

    public function getWidgets(): array
    {
        return [
            // Widgets from AdminPanelProvider are automatically loaded
        ];
    }
}
