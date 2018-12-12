<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'products';

    
    /**
     * The Primary Key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';
    
    
    /**
     * Important: Decide which columns are editable in the table
     * @var array 
     */
    protected $fillable = ['title', 'quantity', 'price', 'content', 'product_sku', 'created_by'];
    
    /**
     * Important: Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    
    /**
     * Important: Appends additional.
     *
     * @var bool
     */
    protected $appends = ['created_date_formatted'];

    //relationships
    public function createdBy() {
        return $this->belongsTo(User::class, 'created_by');
    }
    
    public function getCreatedDateFormattedAttribute() {
        return Carbon::parse($this->created_at)->format('d-m-Y');
    }

    public function scopeId($query, $id)
    {
        return $query->where('id', $id);
    }
    
}
