<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserStoreRequest;

class UserController extends Controller
{
    public function index()
    {
    	$users = User::all();

    	//return json response
    	return response()->json([
    		'results' => $users
    	],200);
    }
    public function store(UserStoreRequest $Request)
    {
    	try{
    		//create user
    		User::create([
    			'name' => $Request->name,
    			'email' => $Request->email,
    			'password' => $Request->password
    		]);

    		//Return Json Response
    		return response()->json([
   			'message' => "succesfully"
 		],200);

   	} catch (\Exception $e){
    		//Return Json Response
   		return response()->json([
   			'message' => "something went really wrong!"
   		],500);
   	}
   }



    public function show($id)
    {
    	//user detail
    	$users = User::find($id);
    	if(!$users){
    		return response()->json([
    			'message'=>'User Not Found.'
    		],404);
    	}

    	//Return Json Response
    	return response()->json([
    		'users' => $users
    	],200);
    }

    public function update(Request $request, $id)
    {
        try{
            //find user
            $users = User::find($id);
             if(!$users){
            return $users()->json([
                'message'=>'User Not Found.'
            ],404);
        }

        $users->name = $request->name;
        $users->email = $request->email;
        $users->password = $request->password;

        //update
        $users->save();

        //return json response
        return response()->json([
                'message'=>"succes"
        ],200);
            
        } catch (\Exception $e) {
            return response()->json([
                'message'=>"cobalagi."
            ],500);
        }
    }

    public function destroy($id)
    {
        //detail
        $users = user::find($id);
        if(!$users){
            return response()->json([
                'message' => 'user not found'
            ],404);
        }

        //delete
        $users->delete();

        //return json
        return response()->json([
            'message' => "succes"
        ],200);
    }
}
