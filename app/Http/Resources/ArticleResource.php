<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'article_id' => $this->article_id,
            'title'      => $this->title,
            'slug'       => $this->slug,
            'image'      => $this->image,
            'content'    => $this->content,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'image_url'  => $this->image_url,
            'tags'       => TagResource::collection($this->tags),
            'comments'   => CommentResource::collection($this->comments),
        ];
    }
}
