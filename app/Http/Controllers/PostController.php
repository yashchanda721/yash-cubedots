<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Post;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
// use Mail;

class PostController extends Controller
{

    public function signIn()
    {
        return view('login');
    }

    public function signOut(Request $request)
    {
        // auth()->logout();
        $request->session()->forget('userSession');
        return redirect('api/auth/signIn');
        //return response()->json(['message' => 'Successfully logged out']);
    }

    public function store(Request $request)
    {
        // try {
        //     $token = JWTAuth::getToken();
        //     $user = JWTAuth::toUser($token);
        $user = $request->session()->get('userSession');
        try {

            $post = new Post;
            $post->user_id = $user->id;
            $post->title = $request->input('title');
            $post->slug  = $this->createSlug($request->input('title'));
            $post->description = $request->input('description');
            if ($file = $request->hasFile('image')) {
                $file = $request->file('image');
                $extension = $file->getClientOriginalName();
                $username = $user->name;
                $thumb = Image::make($file->getRealPath())->resize(100, 100, function ($constraint) {
                    $constraint->aspectRatio(); //maintain image ratio
                });
                $destinationPath = public_path('/uploads/products/');
                $file->move($destinationPath, $extension);
                $thumb->save($destinationPath . '/thumb_' . $extension);
                $imagePath = '/uploads/products/' . $extension;
                $thumbnail = '/uploads/products/thumb_' . $extension;
            }
            $post->featured_image = $imagePath;
            $post->thumbnail_image = $thumbnail;
            $post->status = 1;
            $post->save();
            return redirect('api/auth/posts/show');
            //return response()->json(['posts' => $post, 'message' => 'Post stored Successfully!'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
        // } catch (JWTException $e) {
        //     return response()->json(['message' => $e->getMessage(), 'status_code' => 400]);
        // }
    }

    public function createSlug($title, $id = 0)
    {
        $slug = Str::slug($title);
        $allSlugs = $this->getRelatedSlugs($slug, $id);
        if (!$allSlugs->contains('slug', $slug)) {
            return $slug;
        }

        $i = 1;
        $is_contain = true;
        do {
            $newSlug = $slug . '-' . $i;
            if (!$allSlugs->contains('slug', $newSlug)) {
                $is_contain = false;
                return $newSlug;
            }
            $i++;
        } while ($is_contain);
    }

    protected function getRelatedSlugs($slug, $id = 0)
    {
        return Post::select('slug')->where('slug', 'like', $slug . '%')
            ->where('id', '<>', $id)
            ->get();
    }

    public function allPosts(Request $request)
    {
        $posts = Post::all();
        $user = $request->session()->get('userSession');
        return datatables()->of($posts)->addColumn('slugs', function ($post) {

            $btn = ' <a href="' . url('api/auth/post') . '/' . $post->slug . '" >' . $post->slug . '</a>';
            return $btn;
        })->addColumn('options', function ($post) {

            $btn = ' <a id="delete" post_id="' . $post->id . '" >Delete</a>';
            return $btn;
        })->addColumn('thumb_image', function ($post) {
            $thumb_img = '<img src="' . url($post->thumbnail_image) . '" >';
            return $thumb_img;
        })->rawColumns(['options', 'thumb_image', 'slugs'])->make(true);
    }

    public function edit(Request $request)
    {
        try {

            $user = $request->session()->get('userSession');
            if ($user->user_type != 3) {
                try {
                    $post = Post::find($request->input('post_id'));
                    $post->user_id = $user->id;
                    $post->title = $request->input('title');
                    $post->slug = $this->createSlug($post->title);
                    $post->description = $request->input('description');
                    if ($file = $request->hasFile('image')) {
                        $file = $request->file('image');
                        $extension = $file->getClientOriginalName();

                        $thumb = Image::make($file->getRealPath())->resize(100, 100, function ($constraint) {
                            $constraint->aspectRatio(); //maintain image ratio
                        });
                        $destinationPath = public_path('/uploads/products');
                        $file->move($destinationPath, $extension);
                        $thumb->save($destinationPath . '/thumb_' . $extension);
                        $imagePath = '/uploads/products/' . $extension;
                        $thumbnail = '/uploads/products/thumb_' . $extension;
                    }
                    $post->featured_image = $imagePath;
                    $post->thumbnail_image = $thumbnail;
                    $post->status = 1;
                    $post->save();
                    return redirect('api/auth/posts/show');
                    // return response()->json(['posts' => $post, 'message' => 'Post stored Successfully!'], 200);
                } catch (\Exception $e) {
                    return response()->json(['message' => $e->getMessage()], 400);
                }
            }else{
                return redirect('api/auth/posts/show');
            }
        } catch (JWTException $e) {
            return response()->json(['message' => $e->getMessage(), 'status_code' => 400]);
        }
    }

    public function editPost(Request $request, $slug)
    {
        $post = Post::where('slug', $slug)->first();

        return view('editPost', compact('post'));
    }

    public function delete(Request $request, $id)
    {
        $posts = Post::find($id);
        $posts->delete();
        return redirect('api/auth/posts/show');
    }

    public function addPost(Request $request)
    {
        return view('addPost');
    }

    public function show(Request $request)
    {
        $user = $request->session()->get('userSession');
        return view('post', compact('user'));
    }
}
