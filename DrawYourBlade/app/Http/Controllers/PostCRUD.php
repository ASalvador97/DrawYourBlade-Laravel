<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use App\Post;
use App\User;
use App\Comment;
use Auth;
use App;
use Redirect;
use Illuminate\Http\Request;
use Validator;
use Session;
use Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class PostCRUD extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['showAllPosts', 'showSinglePost']]);
    }

    //calls the page where the new post information is input
    public function createView(){
        return view('newPost');
    }

    //create a new post
    public function create(){
		$file = Input::file('image');
		
		$toValidate = ['image' => $file,
				 'title' => Input::get('postTitle')];
				 
		$rules = ['image' => 'required',
				  'image' => 'mimes:jpeg,bmp,png',
				  'title' => 'unique:posts,title'];
				  
		$validator = Validator::make($toValidate, $rules);
		
		if ($validator->fails()) {
			return Redirect::to('changeAvatar')->withInput()->withErrors($validator);
		} else {
			if ($file->isValid()) {
				File::exists(storage_path('app/public/userContent/'.Auth::user()->id)) or
					File::makeDirectory(storage_path('app/public/userContent/'.Auth::user()->id));
				File::exists(storage_path('app/public/userContent/'.Auth::user()->id.'/posts')) or
					File::makeDirectory(storage_path('app/public/userContent/'.Auth::user()->id.'/posts'));	
				File::exists(storage_path('app/public/userContent/'.Auth::user()->id.'/posts/circled')) or
					File::makeDirectory(storage_path('app/public/userContent/'.Auth::user()->id.'/posts/circled'));	
				File::exists(storage_path('app/public/userContent/'.Auth::user()->id.'/posts/pixelated')) or
					File::makeDirectory(storage_path('app/public/userContent/'.Auth::user()->id.'/posts/pixelated'));	
				
				
				$imageName = time().'.'.$file->getClientOriginalExtension();	
				$path = 'userContent/'.Auth::user()->id.'/posts/';

				//saves the image with a resize to 1080 on its bigger size
				$image = Image::make($file->getRealPath());
				if($image->getHeight() > $image->getWidth()){
					$image->heighten(1080, function ($constraint) {
						$constraint->upsize();
					});
				} else {
					$image->widen(1080, function ($constraint) {
						$constraint->upsize();		
					});
				}
				
				$image->insert(storage_path('app/public/watermark.png'), 'bottom-left', 10, 10);
				$image->save(storage_path('app/public/'.$path.$imageName));
				
				//Creates a pixelated version of the image
				$image->pixelate(5);
				$image->save(storage_path('app/public/'.$path.'pixelated/'.$imageName));
				$image = Image::make($file->getRealPath());
				
				//Crops the image to a 200x200 circle
				if($image->getHeight() < $image->getWidth()){
					$image->heighten(203);
				} else {
					$image->widen(203);
				}
				
				$image->crop(200, 200);
				$mask = Image::canvas(200, 200);
				$mask->circle(200, 100, 100, function($draw) {
					$draw->background('#fff');
				});
				$image->mask($mask, false);
				
				$image->save(storage_path('app/public/'.$path.'circled/'.$imageName));
				
				
				$post = new Post;

				$post->title = Input::get('postTitle');
				$post->type = Input::get('postType');
				$post->content = Input::get('cont');
				$post->description = Input::get('shortDescr');
				$post->creatorID = Auth::id();
				$post->fileDir = $path.$imageName;
				$post->circledDir = $path.'/circled/'.$imageName;
				$post->pixelatedDir = $path.'/pixelated/'.$imageName;

				$post->save();
		
				Session::flash('success', 'Upload successful!');
				return Redirect::route('showPost', ['postID'=>$post->id]);
			}
			else {
				// sending back with error message.
				Session::flash('error', 'Uploaded file is not valid.');
				return Redirect::to('newPost');
			}
		}		
    }

    //shows all the posts
    public function showAllPosts(){
        $allPosts = Post::all(); //DB::select('select * from posts');
        return view('postsOverview',['submissions'=>$allPosts]);
    }

    //shows information about a single post
    public function showSinglePost($postID){
        //$entry = Post::where('id', '=', $postID)->get()->first();//DB::select('select * from posts where title=$postTitle');
        $entry = Post::find($postID);
        $user = User::find($entry->creatorID);
        return view('singlePost', ['entry'=>$entry,
            'user'=>$user,
            'comments'=>DB::table('comments')->where('postID',$postID)->get()]);
    }


    //calls the page for editing an already existing post
    // using middleware('PostPossession')
    public function editView($postID){
        $post = Post::find($postID);
		$this->authorize('update', $post);

        return view('editPost', compact('post'));
    }


    //does the actual editing of the already existing post
    // using middleware('PostPossession')
    public function edit($postID){

        $entry = Post::find($postID);

		$this->authorize('update', $entry);
		
        $entry->title = Input::get('postTitle');
        $entry->type = Input::get('postType');
        $entry->content = Input::get('cont');
        $entry->description = Input::get('shortDescr');

        $entry->save();

        return Redirect::route('showPost', ['postID'=>$postID]);
    }

    // using middleware('PostPossession')
    public function removeView($postID){

        $entry = Post::find($postID);

        $this->authorize('delete', $entry);

        $user = User::find($entry->creatorID);
        return view('deletePost', ['entry'=>$entry, 'user'=>$user]);
    }

    // using middleware('PostPossession')
    public function remove($postID){

        $entry = Post::find($postID);

        $this->authorize('delete', $entry);

		$post = Post::find($postID);
		if(File::exists(storage_path('app/public/'.$post->fileDir)))
			File::delete(storage_path('app/public/'.$post->fileDir));
		
		if(File::exists(storage_path('app/public/'.$post->circledDir)))
			File::delete(storage_path('app/public/'.$post->circledDir));
	
		if(File::exists(storage_path('app/public/'.$post->pixelatedDir)))
			File::delete(storage_path('app/public/'.$post->pixelatedDir));
		
        Post::destroy($postID);

        return Redirect::route('index');
    }
}