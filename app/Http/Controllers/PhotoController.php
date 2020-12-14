<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Photo;
use Auth;
use DateTime;
use Debugbar;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    public function __construct()
    {
    }

    public function index($id){
        $photo = Photo::where('id', $id)->first();
        return View('photo-detail', ['photo'=> $photo]);

    }


    public function getFilteredPhotosList($category, $period){
        //$comments = Comment::where('photo_id', $id)->limit(5)->get();
        //$comments = Comment::all()->where('photo_id', $id)->take(5);
       /* $comments = Comment::where('photo_id', $id)->orderByDesc('date')->take(3)->get();
        return $comments;*/


        $time = new DateTime('now');
        switch ($period) {
            case "year":
                $periodLimit = $time->modify('-1 year')->format('Y-m-d H:i:s');
                break;
            case "month":
                $periodLimit = $time->modify('-1 month')->format('Y-m-d H:i:s');
                break;
            case "weak":
                $periodLimit = $time->modify('-1 weak')->format('Y-m-d H:i:s');
                break;
            case "day":
                $periodLimit = $time->modify('-1 day')->format('Y-m-d H:i:s');
                break;
            default:
                $periodLimit = 0;
        }


        if($category != "all"){
//            $photosList = Photo::where([["category_id", "=", $category], ["date", ">", $periodLimit]])->orderByDesc("date")->paginate(15);
            $photosList = Photo::where([["category_id", "=", $category], ["date", ">", $periodLimit]])->orderByDesc("date")->get();
        }
        else{
//            $photosList = Photo::where([ ["date", ">", $periodLimit]])->orderByDesc("date")->paginate(15);
            $photosList = Photo::where([ ["date", ">", $periodLimit]])->orderByDesc("date")->get();
        }

        return $photosList;
    }

    public function userPhotosView(){
        $photos = Photo::where('user_id', Auth::id())->orderByDesc("date")->get();
        return View("user-photos", ['photos'=> $photos]);
    }

    public function uploadPostImage(Request $request){
        /*$request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $imageName = time().'.'.$request->image->extension();

        $request->image->move(public_path('img'), $imageName);

        return back()->with('success','You have successfully upload image.');*/

        //----------------------------------------------------
        /*$validatedData = $request->validate([
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg',

        ]);

        $name = $request->file('image')->getClientOriginalName();

        $path = $request->file('image')->store('public/img');


        $newPhoto = new Photo;

        $newPhoto->name = $name;
        $newPhoto->path = $path;

        $newPhoto->save();

        return response()->json($path);*/

        $validatedData = $request->validate([
            'photo_file' => 'required|image|mimes:jpg,png,jpeg,gif,svg',

        ]);

        $userId = $_POST['userId'];
        $categoryId = $_POST['categoryId'];
        $fileName = time().'.'.$request->file('photo_file')->extension();
        $image_url = $request->file('photo_file')->storeAs('public/img', $fileName );
        $photoStory = $_POST['photoStory'];
        $photoLocation = $_POST['photoLocation'];
        $photoDescription = $_POST['photoDescription'];
        $photoName = $_POST['photoName'];
        $photoDate = $_POST['photoDate'];

        $newPhoto = new Photo;
        $newPhoto->category_id = $categoryId;
        $newPhoto->user_id = $userId;
        $newPhoto->story = $photoStory;
        $newPhoto->location = $photoLocation;
        $newPhoto->description = $photoDescription;
        $newPhoto->name = $photoName;
        $newPhoto->date = $photoDate;
        $newPhoto->photo_url = '/storage/img/'.$fileName;

        $newPhoto->save();

        header('Content-type: application/json');
        $data = (object)['photo' => $newPhoto, 'photo_url' => $image_url];
        echo json_encode($data);
    }


    public function showEditPhotoForm($id){
        $photo = Photo::find($id);
        $date = date('Y-m-d',strtotime($photo->date));
        return View('photo_edit', ['photo'=> $photo, 'date'=>$date]);
    }

    public function editPhoto(Request $request){

        $photoId = $_POST['photoId'];
        $userId = $_POST['userId'];
        $categoryId = $_POST['categoryId'];
        $photoStory = $_POST['photoStory'];
        $photoLocation = $_POST['photoLocation'];
        $photoDescription = $_POST['photoDescription'];
        $photoName = $_POST['photoName'];
        $photoDate = $_POST['photoDate'];

        $newPhoto = Photo::find($photoId);
        $newPhoto->category_id = $categoryId;
        $newPhoto->user_id = $userId;
        $newPhoto->story = $photoStory;
        $newPhoto->location = $photoLocation;
        $newPhoto->description = $photoDescription;
        $newPhoto->name = $photoName;
        $newPhoto->date = $photoDate;

        $newPhoto->save();

        echo json_encode(['data'=>'Фото изменено успешно!']);
    }

    public function deletePhoto(){
        $id = $_POST['photoId'];
        $photo = Photo::find($id);
        $photo->delete();
        echo json_encode(['data'=>'Фото удалено']);
    }

    public function showAllPhotos(){
        $photos = Photo::orderByDesc('date')->paginate(15);
        return View('photo-list-admin', ['photos'=>$photos]);
    }
}
