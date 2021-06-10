<?php

namespace App\View\Components;

use Illuminate\View\Component;

//MODELS
use App\Models\Stock;

class StockMobility extends Component
{

    public $productId;
    public $type;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($productId, $type)
    {
        $this->productId = $productId;
        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        if($this->type === 'in') $stocks = Stock::where('productId', $this->productId)->where('isActive', 1)->where('inOrOut', 1)->orderByDesc('date')->paginate(9);
        elseif($this->type === 'out') $stocks = Stock::where('productId', $this->productId)->where('isActive', 1)->where('inOrOut', 0)->orderByDesc('date')->paginate(9);
        else $stocks = Stock::where('productId', $this->productId)->where('isActive', 1)->orderByDesc('date')->paginate(9);
        return view('components.stock-mobility', compact('stocks' ));
    }
}
