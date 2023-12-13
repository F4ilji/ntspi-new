<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Http\Resources\UserDetailResource;
use App\Models\Post;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class LinkToolController extends Controller
{
    public function main(Request $request)
    {
        if ($request->input('url') == \route('client.person.show', ['userDetail' => substr($request->input('url'), -1)])) {
            $userDetail = UserDetail::find(substr($request->input('url'), -1));
            return response()->json([
                'success' => 1,
                'link' => Str($request->input('url')),
                'meta' => [
                    'title' => $userDetail->surname . ' '. $userDetail->name . ' '. $userDetail->middleName,
                    'description' => $userDetail->administrativePosition,
                    'image' => [
                        'url' => $userDetail->photo
                    ],
                    'type' => 'person',
                    'data' => new UserDetailResource($userDetail),
                ]
            ]);
        }
        if ($request->input('url') == \route('client.post.show', ['slug' => $this->getSlugFromUrl($request->input('url')) ])) {
            $post = Post::query()->where('slug', '=', $this->getSlugFromUrl($request->input('url')))->first();
            $content = json_decode($post->content);
            foreach ($content->blocks as $data) {
                if ($data->type === 'paragraph') {
                    return response()->json([
                        'success' => 1,
                        'link' => Str($request->input('url')),
                        'meta' => [
                            'title' => $post->title,
                            'description' => $data->data->text,
                            'type' => 'post',
                            'data' => new PostResource($post),
                        ]
                    ]);
                }
            }

        }
        return false;
    }

    private function getSlugFromUrl($url)
    {
        $path = parse_url($url, PHP_URL_PATH);
        $segments = explode('/', $path);
        $lastSegment = end($segments);
        return $lastSegment;
    }

}
