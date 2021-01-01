<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\whishlist;
use App\User;
use DB;
use Validator;
use Illuminate\Support\Facades\Auth;

class WishListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
        {
          $this->middleware('auth');
        }


    public function index()
    {
    
       $wish= whishlist::where('deleted_at',null)->get();
       return view('wish.list',compact('wish'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user=User::get();

        return view("wish.create",compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

            $messages = [
                'wishlist_name.required' => 'wishlist name is required.',
            ];

            $validator = Validator::make($request->all(), [
               
                'wishlist_name' => 'required',
            ], $messages);
      
            if ($validator->fails()) {
                  return redirect()->back()->withErrors($validator)->withInput();
            } else {

            $wish_data=$request->all();
            DB::table('whishlists')->insert([
                //'user_id' => $wish_data['user_id'],
                'user_id' => Auth::user()->id,
                'wishlist_name' => $wish_data['wishlist_name'],
                 'created_at'=>new \DateTime(),
                 'updated_at'=>new \DateTime()
            ]);
            return redirect('wish')->with('su_status','Wishes has been added successfully');
        }

        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $wish=whishlist::find($id);
        return view('wish.edit',compact('wish'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
         $updatedData = [
                          'wishlist_name' => $request->input('wishlist_name'),
                          'user_id'=>Auth::user()->id,
                          
                        ];
                   $update =  whishlist::where(['id'=>$id])->update($updatedData);
                    return redirect('wish');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // return response()->json(['success' => true, 'id'=>$id, 'message' => 'Department Deleted Successfully']);

        $delete_whishlist=whishlist::where('id','=', $id)->delete();
        //return redirect('wish')->with('su_status','Wishes has been deleted successfully');
        if($delete_whishlist){
         return response()->json(['success' => true,'message' => 'Wish has been Deleted Successfully']);
      }

    }
}
