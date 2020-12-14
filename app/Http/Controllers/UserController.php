<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Comment;
use App\Models\Photo;
use App\Models\User;
use Auth;
use Debugbar;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
    }


    public function showProfile(){

        $user = User::find(Auth::id());
        return View('profile', ['user'=>$user]);
    }

    public function showProfileById($id){

        $user = User::find($id);
        return View('profile', ['user'=>$user]);
    }

    public function editProfile(Request $request)
    {

        $userId = $_POST['userId'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        //$password = $_POST['password'];

        $user = User::find($userId);
        $user->firstname = $firstname;
        $user->lastname = $lastname;
        $user->name = $name;
        $user->email = $email;
        //$user->password = bcrypt($password);
        $user->save();

        return json_encode(['response'=>'Профиль сохранён']);
    }

    public function showAllUsers(){
        $users = User::paginate(15);
        return View('users-list-admin', ['users'=>$users]);
    }

    public function deleteUser(Request $request)
    {

        $userId = $_POST['userId'];
        $user = User::find($userId);
        $user->delete();

        return json_encode(['response'=>'Профиль удалён']);
    }
}
