<?php

namespace App\Http\Controllers;

use App\Workplace;
use App\Product;
use App\User;
use App\UserProduct;
use App\WorkplaceUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($workplace_id)
    {
        $query['workplace'] = Workplace::with('users.user')->where('id',$workplace_id)->first();
        dd($query['workplace']);
        Session::put('workplace', $query['workplace']);
        $query['data'] = Product::where('workplace_id',$workplace_id)->get();
        return view('products.index', $query);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($workplace_id)
    {
        $query['workplace'] = Workplace::where('id', $workplace_id)->first();
        return view('products.add', $query);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'workplace_id' => 'required'
        ]);
        $product = Product::create($data);
        $save = new UserProduct;
        $save->user_id = Auth::user()->id; 
        $save->product_id = $product->id;
        $save->save();

        return redirect($request->workplace_id.'/products')->with('success', 'Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        
        $query['product'] = $product;
        $query['data'] = Product::where('id',$product->id)->with('users', 'workplace')->first();
        return view('products.single', $query);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Workplace  $workplace
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $query['data'] = $product;
        $query['workplace'] = Workplace::where('id', $product->workplace_id)->first();
        return view('products.add', $query);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $product->update([
            'title' => $request->title
        ]);
        return redirect('workplace/' . $request->workplace_id)->with('success', 'Edited Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return back()->with('success', 'Deleted Successfully');
    }

    public function invite_member(Request $request)
    {
        //check if user can be existed
        $user = User::where('email', $request->email)->first();
        //save in Users if new Email
        if (!$user) {
            $user = new User;
            $user->email = $request->email;
            $user->save();
        }
        //save in UserProduct
        $invite = new UserProduct;
        $invite->user_id = $user->id;
        $invite->product_id = $request->product_id;
        $invite->workplace_id = $request->workplace_id;
        $invite->save();

        $save = new WorkplaceUser;
        $save->workplace_id = $invite->workplace_id;
        $save->user_id = $invite->user_id;
        $save->status = 1;
        $save->save();

        //send invitation email
        $data['subject'] = 'CLOSOR Invitation';
        $data['email'] = $request->email;
        \Illuminate\Support\Facades\Mail::send('auth.email_invite', $data, function ($message) use ($data) {
            $message->from('info@closor.com', 'CLOSOR')->to($data['email'], 'CLOSOR')->subject($data['subject']);
        });
        return back()->with('success', 'Email invited Successfully');
    }
}
