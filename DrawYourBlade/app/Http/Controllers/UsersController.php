<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Auth;
use Illuminate\Support\Facades\Input;
use App;
use Excel;
use Validator;
use File;
use Image;
use Redirect;

class UsersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function Profile($id) {
        $user = User::find($id);
        return view('profile', compact('user'));
    }
	
	public function AllProfiles(){
        $allUsers = User::all();
		$allPosts = Post::all();
		
        return view('usersOverview',['users'=>$allUsers, 'posts'=> $allPosts]);
		}

    public function EditProfileView($id) {
        $user = User::find($id);
        return view('editProfile', compact('user'));
    }

    public function EditProfileData($user_id) {
        $newEmail = Input::get('newEmail');
        $newName = Input::get('newName');
		
		$user = User::find($user_id);
		$user->email = $newEmail;
		$user->name = $newName;
		$user->save();
	
        return App::call('App\Http\Controllers\UsersController@Profile', ['id' => $user_id]);
    }
	
	public function EditUserType($user_id){
		$user = User::find($user_id);
		
		$user->type = Input::get('userType');
		$user->save();
		
		return Redirect::route('profile', ['id' => $user_id]);
	}
	
	public function ChangeAvatarView($id){
		$user = User::find($id);
        return view('changeAvatar', ['user' => $user]);
	}
	
	public function ChangeAvatar($id){
		$user = User::find($id);
		
		if($user->avatarDir != 'userContent/defaultAvatars/boy.png' && $user->avatarDir != 'userContent/defaultAvatars/grill.png'){
			if(File::exists(storage_path('app/public/'.$user->avatarDir))){
				File::delete(storage_path('app/public/'.$user->avatarDir));
			}
		}
		
		if(Input::get('source') == 's1'){
			$user->avatarDir = 'userContent/defaultAvatars/boy.png';
		} else if (Input::get('source') == 's2'){
			$user->avatarDir = 'userContent/defaultAvatars/grill.png';
		} else if (Input::get('source') == 's3'){
			$file = Input::file('image');
			
			$toValidate = ['image' => $file];
					 
			$rules = ['image' => 'required',
					  'image' => 'mimes:jpeg,bmp,png'];
					  
			$validator = Validator::make($toValidate, $rules);
			
			if ($validator->fails()) {
				return Redirect::to('newPost')->withInput()->withErrors($validator);
			} else {
				File::exists(storage_path('app/public/userContent/'.$user->id)) or
						File::makeDirectory(storage_path('app/public/userContent/'.$user->id));
				File::exists(storage_path('app/public/userContent/'.$user->id.'/avatars')) or
						File::makeDirectory(storage_path('app/public/userContent/'.$user->id.'/avatars'));

						$imageName = time().'.'.$file->getClientOriginalExtension();	
				$path = 'userContent/'.$user->id.'/avatars/';

				$image = Image::make($file->getRealPath());

				//Crops the image to 200x200 a circle
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
				
				$image->insert(storage_path("app/public/watermarkProf.png"), 'right', 10);
				
				$image->save(storage_path('app/public/'.$path.$imageName));
				
				$user->avatarDir = $path.$imageName;
			}
		}
	
		$user->save();
		
		return Redirect::route('profile', ['id' => $id]);
	}
	
	public function getDataView(){
		
		return view('getData');
	}
	
	public function getData(){
		$data = User::get()->toArray();
		Excel::create('List of Users', function($excel) use ($data){
			$excel->sheet('Sheet 1', function($sheet) use ($data){

				$sheet->fromArray($data);

			});
		})->download('xlsx');
		
		return view('getData');
	}
	
	public function GetRemoveView($userID){
		$user = User::find($userID);
		$allPosts = Post::all();
		
        return view('deleteUser',['user'=>$user, 'posts'=> $allPosts]);
	}
	
	public function RemoveUser($userID){
		$user = User::find($userID);
		
		$posts = Post::where('creatorID', '=', $userID)->get();
		
		foreach($posts as $post){
			app('App\Http\Controllers\PostCRUD')->remove($post->postID);
		}
		
		if($user->avatarDir != 'userContent/defaultAvatars/boy.png' && $user->avatarDir != 'userContent/defaultAvatars/grill.png'){
			if(File::exists(storage_path('app/public/'.$user->avatarDir))){
				File::delete(storage_path('app/public/'.$user->avatarDir));
			}
		}
		
		User::destroy($userID);
		
		return Redirect::route('index');
	}
}
