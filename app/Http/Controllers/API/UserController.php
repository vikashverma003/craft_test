<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User; 
use Illuminate\Support\Facades\Auth; 
use Validator;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller 
{
public $successStatus = 200;
public $badRequestCode = 400;

/** 
     * login api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
	public function check(){
		return response()->json(['as'=>'jdgfdghfg']);
	}

    public function login(){ 
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){ 
            $user = Auth::user(); 
            $success['token'] =  $user->createToken('MyApp')-> accessToken; 
            return response()->json(['success' => $success], $this-> successStatus); 
        } 
        else{ 
            return response()->json(['error'=>'Unauthorised'], 401); 
        } 
    }
/** 
     * Register api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function register(Request $request) 
	    { 
	        $validator = Validator::make($request->all(), [ 
	            'name' => 'required', 
	            'email' => 'required|email', 
	            'password' => 'required', 
	            'c_password' => 'required|same:password', 
	        ]);
	if ($validator->fails()) { 
	            return response()->json(['error'=>$validator->errors()], 401);            
	        }
	$input = $request->all(); 
	        $input['password'] = bcrypt($input['password']); 
	        $user = User::create($input); 
	        $success['token'] =  $user->createToken('MyApp')-> accessToken; 
	        $success['name'] =  $user->name;
	return response()->json(['success'=>$success], $this-> successStatus); 
	    }
	/** 
	     * details api 
	     * 
	     * @return \Illuminate\Http\Response 
	     */ 
	    public function details() 
	    { 
	        $user = Auth::user(); 

	        return response()->json(['success' => $user], $this-> successStatus); 
	    } 

	    public function changePassword(Request $request){
	    	$validator = Validator::make($request->all(), [ 
			 'old_password'=>'required',
             'new_password'=>'min:5|required_with:confirm_password|same:confirm_password',
             'confirm_password'=>'min:5',
		]);
		if($validator->fails()) {
			return response()->json(['message'=>$validator->errors()->first(),'status'=>false], $this->badRequestCode);            
		}
		else{
			    $user = Auth::user();
			    if(\Hash::check($request->old_password,$user->password)){
			    	$user=User::where('id',$user->id)->update(['password'=>\Hash::make($request->new_password)]);
			    	//echo 232;
			    	return response()->json([ 
					'status' => true,
					'message' => 'Password has been changed successfully',
				], $this->successStatus);
			    }
			    else{
			    	return response()->json([ 
					'status' => false,
					'message' => 'No matching password',
				], $this->badRequestCode);
			    }
	    }
	}

	public function randomPasswordGenerator(){
		     $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
		     $arr_new=[];
		     $str_len=strlen($alphabet)-1;
		     for($i=0;$i<=8;$i++){

		     	$str=rand(0,$str_len);
		     	$arr_new[]=$alphabet[$str];
		     }
		     return implode($arr_new);
	}

	public function forgotPassword(Request $request){
	    $validator = Validator::make($request->all(), [ 
				 'email'=>'required',
			]);
			if($validator->fails()) {
				return response()->json(['message'=>$validator->errors()->first(),'status'=>false], $this->badRequestCode);            
			}
			else{
			        $user=User::where('email',$request->email)->first();
			        if(!empty($user)){
                    $pass=$this->randomPasswordGenerator();
					$pass_en=\Hash::make($pass);

                    $update_password=User::where('id',$user->id)->update(['password'=>$pass_en]);
                    if($update_password){
		            	$msg = [
		            		'name'=>$user->name,
		            		'email'=>$user->email,
		                    "new_password" => $pass
		                ];
		                $email = $request->email;
		                Mail::send('mail', $msg, function($message) use ($email) {
		                    $message->to($email);
		                    $message->subject('New Password - User');
		                });
		                return response()->json(['status'=>true,'message'=>'New Password has been mailed to you. Please check your email'], $this->successStatus);
		            }
			        }      
			}
	}

	public function editProfile(Request $request){
		$user =Auth::user();
		$req=$request->name;
		//echo $req;
		  $user->name=is_null($request->name)?$user->name:$request->name;
		  $url= \URL::to('/');
		  $user_image='';
		  if ($request->hasFile('image')) {
        	            $file = request()->file('image');
        	            $ext=$file->getClientOriginalExtension();
        	            $imagename = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
        	            $file->move('admin/images/users', $imagename);
        	            $user_image=$imagename;

        	            }
        	else{
                $user_image=$user->profile;
        	}
        	$user->profile=is_null($user_image)?NULL:$user_image;
        	  
		$user->save();
		return response()->json(['status'=>true,"message"=>"updation has been successfull"]);

	}

	public function logout(Request $request){
		$user = Auth::user()->token();
		$user->revoke();
		//return 'logged out'; // modify as per your need
	   return response()->json(['status'=>true,'message'=>'User has been logout successfully'], $this->successStatus);

   //         $request->user()->device_token=null;
			// $request->user()->save();
   //        $request->user()->token()->revoke();

	}

	public function change_mid_data(Request $request){

				$user =Auth::user();
				echo $user;


	}



}
