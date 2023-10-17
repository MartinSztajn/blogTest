<?php

namespace App\Http\Controllers;

use App\Models\Adress;
use App\Models\Company;
use App\Models\Publications;
use App\Models\User;
use Illuminate\Http\Request;
Use Auth;
use Inertia\Inertia;

class IndexController extends Controller
{
    //

    public function product()
    {
        return Inertia::render('Product');
    }

    public function home()
    {
        return  view('home');
    }
    public function uploadFiles(){

        return Inertia::render('Files');
    }
    public function mypost(){
        $id = Auth::user()->id;
        $publications = Publications::where('userId', $id)->get();
        return Inertia::render('Mypost', ['publications' => $publications]);
    }
    public function index()
    {
        return Inertia::render('Index');
    }
    public function sendMessages(Request $request){
        $publication =  new Publications();
        $publication->userId = Auth::user()->id;
        $publication->title = $request->title;
        $publication->body = $request->body;
        $publication->save();

        return back();
    }

    public function importUsers(){
        $jsonFile = public_path('users.json');
        if (file_exists($jsonFile)) {
            // Leer el contenido del archivo JSON
            $jsonContents = file_get_contents($jsonFile);
            // Decodificar el JSON en un objeto PHP
            $data = json_decode($jsonContents);

            foreach ($data as $user){
                $adress = new Adress();
                $adress->street = $user->address->street;
                $adress->suite = $user->address->suite;
                $adress->city = $user->address->city;
                $adress->zipcode = $user->address->zipcode;
                $adress->lat = $user->address->geo->lat;
                $adress->lng = $user->address->geo->lng;
                $adress->save();

                $company = new Company();
                $company->name =  $user->company->name;
                $company->catchPhrase =  $user->company->catchPhrase;
                $company->bs =  $user->company->bs;
                $company->save();

                $newUser = new User();
                $newUser->name = $user->name;
                $newUser->username = $user->username;
                $newUser->email = $user->email;
                $newUser->id_adress = $adress->id;
                $newUser->phone = $user->phone;
                $newUser->website = $user->website;
                $newUser->id_company = $company->id;
                $newUser->password = '$2y$10$WfXfSgAyqetIUW1r.RS/nu2hUqWivRXsQ5glIOA/n0rKSG2BH79pa';
                $newUser->save();

                dump('Se guardo');



            }
        } else {
            // Manejar el caso en que el archivo no existe
            return response()->json(['error' => 'El archivo JSON no existe'], 404);
        }


    }
    public function importPublications(){
        $jsonFile = public_path('posts.json');
        if (file_exists($jsonFile)) {
            // Leer el contenido del archivo JSON
            $jsonContents = file_get_contents($jsonFile);
            // Decodificar el JSON en un objeto PHP
            $data = json_decode($jsonContents);

            foreach ($data as $post){
                $publication = new Publications();
                $publication->userId = $post->userId;
                $publication->title = $post->title;
                $publication->body = $post->body;
                $publication->save();
                dump('Se guardo');
            }
        } else {
            // Manejar el caso en que el archivo no existe
            return response()->json(['error' => 'El archivo JSON no existe'], 404);
        }
    }

    public function deletePost($id){
        $post = Publications::find($id);
        if ($post->userId == Auth::user()->id){
            $post->delete();
        }
        return back();
    }
    public function editPost($id){
        $post = Publications::find($id);
        return Inertia::render('Dashboard', ['post' => $post]);

    }

}
