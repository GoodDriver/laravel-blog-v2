<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Article;

class PostController extends Controller
{
    //
	public function index(Request $request)
	{

		$articles = Article::where('is_hidden', 0)->orderBy('is_top', 'desc')->orderBy('created_at', 'desc')->simplePaginate(15);

		$items = [];

		foreach ($articles as $post) {
			$item['id'] = $post->id;
			$item['title'] = $post->title;
			$item['summary'] = $post->content;
			// $item['thumb'] = url(config('blog.uploads.webpath') . '/' . $post->page_image);
			$item['posted_at'] = $post->created_at;
			$item['views'] = mt_rand(1, 10000); // 暂时没有实现文章浏览数逻辑，返回随机数
			$items[] = $item;
		}

		$data = [
			'message' => 'success',
			'articles' => $items
		];

		return response()->json($data);
	}
}
