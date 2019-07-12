<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Article;
use App\Http\Resources\PostResource;

class PostController extends Controller
{
    //
	public function index(Request $request)
	{

		$articles = Article::where('is_hidden', 0)->orderBy('is_top', 'desc')->orderBy('created_at', 'desc')->simplePaginate(10);

		$items = [];

		foreach ($articles as $post) {
			$item['id'] = $post->id;
			$item['title'] = $post->title;
			$item['summary'] = strip_tags($post->content);
			$item['thumb'] = url('/default.jpg');
			$item['posted_at'] = Date($post->created_at);
			$item['views'] = mt_rand(1, 10000); // 暂时没有实现文章浏览数逻辑，返回随机数
			$items[] = $item;
		}

		$data = [
			'message' => 'success',
			'articles' => $items
		];

		return response()->json($data);
	}

	public function detail($id)
	{
		$post = Article::findOrFail($id);
		return new PostResource($post);
	}
}
