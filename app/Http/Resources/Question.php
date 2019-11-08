<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Question extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     */

    public function toArray($request)
    {
        return parent::toArray($request);
    }

    /**
     * Get additional data that should be returned with the resource array.
     */
    // public function with($request)
    // {
    //     return [
    //         'meta' => [
    //             'type' => 'textarea',
    //         ],
    //     ];
    // }
}
