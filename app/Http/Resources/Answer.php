<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Answer extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     */

    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
