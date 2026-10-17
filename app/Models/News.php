<?php

namespace App\Models;

use App\Casts\DateOnly;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class News extends Model
{
    use HasFactory;

    protected $table = 'news';

    protected $fillable = [
        'title',
        'date',
        'image',
        'description',
        'link',
        'published',
    ];

    protected function casts(): array
    {
        return [
            'date' => DateOnly::class,
            'published' => 'boolean',
        ];
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('published', true);
    }

    public function scopeLatestFirst(Builder $query): Builder
    {
        return $query->orderByDesc('date');
    }

    /**
     * Public URL for the image, whether it is a bundled legacy asset in
     * public/ or a file uploaded to the public disk under news/.
     */
    protected function imageUrl(): Attribute
    {
        return Attribute::make(
            get: function (): ?string {
                if ($this->image === null) {
                    return null;
                }

                return str_contains($this->image, '/')
                    ? Storage::disk('public')->url($this->image)
                    : asset($this->image);
            },
        );
    }
}
