<?php

namespace App\Http\Resources;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin News
 */
class NewsResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'date' => $this->date->toDateString(),
            'description' => $this->description,
            'image' => $this->image ? asset($this->image) : null,
            'link' => legacy_link($this->link),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
