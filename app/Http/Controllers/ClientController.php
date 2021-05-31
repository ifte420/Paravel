<?php

namespace App\Http\Controllers;

use App\Models\client;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Image;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('client.index', [
            'clients' => client::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'client_says' => 'required',
            'client_name' => 'required',
            'client_title' => 'required',
            'client_image' => 'required | mimes:jpg,jpeg,png,bmp,gif,svg,webp',
        ]);
        // catch file
        $photo_select = $request->file('client_image');
        // random name
        $random_name = str::random(10).time().'.'.$request->client_image->getClientOriginalExtension();
        // upload your file
        Image::make($photo_select)->resize(135, 105)->save(public_path('uploads/client/').$random_name, 80);

        client::insert($request->except('_token', 'client_image')+[
            'client_image' => $random_name,
        ]);

        return back()->with('insert_success','Your Data Insert Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(client $client)
    {
        return view('client.edit',[
            'client' => $client,
        ]);
    }

    function client_edit($client_id){
        echo $client = Crypt::decryptString($client_id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, client $client)
    {
        $request->validate([
            'client_says' => 'required',
            'client_name' => 'required',
            'client_title' => 'required',
            'client_image' => 'mimes:jpg,jpeg,png,bmp,gif,svg,webp',
        ]);
        if($request->client_image){
            $path = Public_path('uploads/client/').$client->client_image;
            unlink($path);
            // catch file
            $photo_select = $request->file('client_image');
            // random name
            $random_name = str::random(10).time().'.'.$request->client_image->getClientOriginalExtension();
            // upload your file
            Image::make($photo_select)->resize(135, 105)->save(public_path('uploads/client/').$random_name, 80);

            $client->update($request->except('_token', 'client_image')+[
                'client_image' => $random_name,
            ]);
            return redirect('client')->with('update','Update Successfully');
        }
            $client->update($request->except('_token', 'client_image'));
            return redirect('client')->with('update','Update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(client $client)
    {
        // $client->delete();
        // return back()->with('soft_delete', 'Single Soft Delete Successfully');
    }

    function client_delete($client_id){
        return $path = Public_path('uploads/client/').client::find($client_id)->client_image;
        unlink($path);
        client::findOrFail($client_id)->delete();
        return back()->with('soft_delete', 'Single Soft Delete Successfully');
    }

    function soft_delete_all(){
        client::whereNull('deleted_at')->delete();
        return back()->with('soft_all', 'All Client Says Deleted Successfully');
    }

    function check_soft_delete(Request $request){
        $request->validate([
            'delete_checked_id' => 'required',
        ]);
        foreach($request->delete_checked_id as $single_id){
            $path = Public_path('uploads/client/').client::find($single_id)->client_image;
            unlink($path);
            client::findOrFail($single_id)->delete();
        }
        return back()->with('soft_all', 'All Client Says Deleted Successfully');
    }

}
