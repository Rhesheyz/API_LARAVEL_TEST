<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'news_content'=> $this->news_content,
            'created_at' => date('d-m-Y H:i:s', strtotime($this->created_at )),
            'author' => $this->author,
            'writer' => $this->whenLoaded('writer'),
        ];
    }
}
