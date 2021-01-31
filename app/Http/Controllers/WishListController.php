<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\whishlist;
use App\User;
use DB;
use Validator;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;

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

        public function get_relation_data(){

           $user=whishlist::where('id',30)->first();
           $newDateFormat2 = date('d/m/Y', strtotime($user->created_at));
           $newDateFormat3 = date('y/m/d', strtotime($user->created_at));

           $change_format=str_replace('/','-',$newDateFormat3);
           $d=date('y-m-d');
            // echo $d;die();
           // $date=date('Y-M-D',strtotime($user->created_at));

           // $today=date('Y-M-D');
           // $st_date=strtotime('+2',strtotime($today));
           // $changed_date=date('Y-m-d',$st_date);
           // $user=User::with('wishes')->get();

           $user=User::whereHas('wishes',function($q){

           $q->where('created_at', '>=', date('Y-m-d').' 00:00:00');
           //$q->where('wishlist_name','www');

           })->get();

            
            //$user=whishlist::with('user')->get();

            echo "<pre>";
            print_r($user);die();
            
        }


    public function index()
    {
    
          // $wish= whishlist::where('id',auth()->user()->id)->where('deleted_at',null)->get();

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

            return redirect('user/wish')->with('su_status','Wishes has been added successfully');
        }

        //
    }

    public function ajax_create()
    {
        $user=User::get();

        return view("wish.create1",compact('user'));
    }

    public function wishy(Request $request){

        $input=$request->all();
         DB::table('whishlists')->insert([
                //'user_id' => $wish_data['user_id'],
                'user_id' => Auth::user()->id,
                'wishlist_name' => $input['wishlist_name'],
                 'created_at'=>new \DateTime(),
                 'updated_at'=>new \DateTime()
            ]);

        return response()->json(['ip'=>$input['wishlist_name'],'status'=>true,'url'=>url('user/wish')]);
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
                    return redirect('user/wish');


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

            /**
         * Displays datatables front end view
         *
         * @return \Illuminate\View\View
         */
        public function getIndex()
        {
            return view('datatables.index');
        }

        /**
         * Process datatables ajax request.
         *
         * @return \Illuminate\Http\JsonResponse
         */
        public function anyData()
        {
            return Datatables::of(User::query())->make(true);
        }
}
