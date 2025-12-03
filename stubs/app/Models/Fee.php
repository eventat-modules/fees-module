<?php

namespace App\Models;

use AhmedAliraqi\LaravelFilterable\Filterable;
use App\Http\Filters\FeeFilter;
use App\Support\Traits\Selectable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fee extends Model implements TranslatableContract
{
    use Filterable;
    use HasFactory;
    use Selectable;
    use SoftDeletes;
    use Translatable;

    /**
     * The filter class used for querying this model.
     *
     * @var class-string<FeeFilter>
     */
    protected string $filter = FeeFilter::class;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'price',
        'active',
    ];

    /**
     * The translated attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    public $translatedAttributes = ['name', 'description'];

    /**
     * The relations to eager load on every query.
     *
     * @var array<int, string>
     */
    protected $with = [
        'translations',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['select_text'];

    /**
     * Accessor for the formatted select text attribute.
     *
     * Example: "{name} - SAR {price} (Approx. USD {price_usd})"
     */
    public function getSelectTextAttribute(): string
    {
        if ((float) $this->price === 0.0) {
            return $this->name.' (Free)';
        }

        return $this->name.' (SAR '.$this->price.')';
    }

    public function toSelect2(): array
    {
        return [
            'id' => $this->id,
            'text' => $this->select_text,
        ];
    }

    /**
     * Get the entity unit price.
     */
    public function getPrice(): float
    {
        return $this->price;
    }
}
