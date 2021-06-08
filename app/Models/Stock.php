<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use function Symfony\Component\Translation\t;

/**
 * App\Models\Stock
 *
 * @property int $id
 * @property string $transactionNumber
 * @property int $productId
 * @property float $sumProductCount
 * @property float $sumTradingVolume
 * @property int $inOrOut
 * @property string|null $supplier
 * @property string|null $adress
 * @property string|null $date işlem tarihi
 * @property string|null $desription
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Stock newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Stock newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Stock query()
 * @method static \Illuminate\Database\Eloquent\Builder|Stock whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stock whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stock whereInOrOut($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stock whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stock whereSumProductCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stock whereSumTradingVolume($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stock whereTransactionNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stock whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stock whereAdress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stock whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stock whereDesription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stock whereSupplier($value)
 * @mixin \Eloquent
 */
class Stock extends Model
{
    use HasFactory;

    protected $fillable = [
        'transactionNumber',
        'productId',
        'sumProductCount',
        'sumTradingVolume',
        'inOrOut',
        'supplier',
        'adress',
        'date',
        'desription',
    ];

    public function productDetails(){
        return $this->hasOne('App\Models\Product', 'id', 'productId');
    }
}
