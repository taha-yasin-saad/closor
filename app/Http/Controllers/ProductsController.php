<?php

namespace App\Http\Controllers;

use App\Workplace;
use App\Product;
use App\User;
use App\UserProduct;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query['data'] = Product::all();
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
        Product::create($data);

        return redirect('workplace/' . $request->workplace_id)->with('success', 'Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
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
        $invite->save();
        //send invitation email
        $data['subject'] = 'CLOSOR Invitation';
        $data['email'] = $request->email;
        \Illuminate\Support\Facades\Mail::send('auth.email_invite', $data, function ($message) use ($data) {
            $message->from('info@closor.com', 'CLOSOR')->to($data['email'], 'CLOSOR')->subject($data['subject']);
        });
        return back()->with('success', 'Email invited Successfully');
    }
}
