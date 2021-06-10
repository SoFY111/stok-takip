<?php

namespace App\View\Components;

use Illuminate\View\Component;

class StockLiItem extends Component
{

    public $inOrOut;
    public $stockProductDetailsSlug;
    public $stockProductDetailsName;
    public $stockSumProductCount;
    public $stockProductUnitDetailsName;
    public $stockSupplier;
    public $stockDate;
    public $type;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($inOrOut, $stockProductDetailsSlug, $stockProductDetailsName, $stockSumProductCount, $stockProductUnitDetailsName, $stockSupplier, $stockDate, $type = '')
    {
        $this->inOrOut = $inOrOut;
        $this->stockProductDetailsSlug = $stockProductDetailsSlug;
        $this->stockProductDetailsName = $stockProductDetailsName;
        $this->stockSumProductCount = $stockSumProductCount;
        $this->stockProductUnitDetailsName = $stockProductUnitDetailsName;
        $this->stockSupplier = $stockSupplier;
        $this->stockDate = $stockDate;
        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.stock-li-item');
    }
}
