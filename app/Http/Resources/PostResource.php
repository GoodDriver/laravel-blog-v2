<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class PostResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
	    return [
		    'id' => $this->id,
		    'title' => $this->title,
		    'image' => url('/default.jpg'),
		    'content' => $this->content,
		    'author' => 'Garish',
		    'posted_at' => Date($this->created_at),
		    'views' => mt_rand(1, 100000),
		    'votes' => mt_rand(1, 1000),
	    ];
    }
}
