<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes,HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'products';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'image',
        // 'category_id', // jika nanti menggunakan kategori
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'price' => 'decimal:2',
    ];

    // Jika nanti menggunakan relasi dengan kategori
    // public function category()
    // {
    //     return $this->belongsTo(Category::class);
    // }
    public function sizes()
    {
        return $this->hasMany(ProductSize::class);
    }
    public function hasEnoughStock($quantity)
    {
        return $this->stock >= $quantity;
    }

    public function decreaseStock($quantity)
    {
        if ($this->hasEnoughStock($quantity)) {
            $this->stock -= $quantity;
            $this->save();
            return true;
        }
        return false;
    }
    public function canBeDeleted()
    {
        return !$this->invoiceItems()->exists();
    }

    public function invoiceItems()
    {
        return $this->hasMany(InvoiceItem::class);
    }

}
