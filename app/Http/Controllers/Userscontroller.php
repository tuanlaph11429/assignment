<?php

namespace App\Http\Controllers;
use App\Model\User;

use Illuminate\Http\Request;

class Userscontroller extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // Tra ve danh sach cac ban ghi product
    public function index()
    {
        //Ellquent
        //all rất cả bản ghi
        $users = User::all();
        //get : lấy ra toàn bộ các bản ghi, kết hợp  được với câu điều kiện
        //get : sẽ nằm cuối
        $usersGet = User::select('*')
        
        // ->where('id', '>', 3 )
        // ->get();
        ->orderBy('id','desc')
        ->paginate(10);
        return view('users.index', ['users' =>  $usersGet]);
        // dd('danh sách category', $categories, $categoriesGet);
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // Tao ban ghi product moi
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // Tra ve thong tin ban ghi product theo id
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // Cap nhat thong tin cua 1 ban ghi
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // Xoa 1 ban ghi product
    public function destroy($id)
    {
        //
    }
    public function delete(User $pro) {
        // Neu muon su dung model binding
        // 1. Dinh nghia kieu tham so truyen vao la model tuong ung
        // 2. Tham so o route === ten tham so truyen vao ham
        if ($pro->delete()) {
            return redirect()->route('users.index');
        }

        // Cach 1: destroy, tra ve id cua thang duoc xoa
        // Chi ap dung khi nhan vao tham so la gia tri
        // Neu k xoa duoc thi tra ve 0
        $usersDelete = User::destroy($pro);
        if ($usersDelete !== 0) {
            return redirect()->route('users.index');
        }
        // dd($categoryDelete);

        // Cach 2: delete, tra ve true hoac false
        // $category = Category::find($id);
        // $category->delete();
    }
    public function create()
    {
        return view('users.create');
    }
    public function edit(User $id){
        return view('users.create', ['users' => $id]);
    }
    public function store(Request $request)
   
    {
        $request->validate([
            // nam nao se validate dieu kien gi
            'name'=>'required',
            
        ]);
        // neu co loi trong dieu kien truyen vao thi tu dong ket thuc
        // ham quay tro lai form kem bien $errors

        $usersRequest = $request->all();
        $users = new User();
        $users->name = $usersRequest['name'];
        $users->description = $usersRequest['description'];
        $users->status = $usersRequest['status'];
        $users->slug = Str::slug($usersRequest['name']) . '-' . uniqid();
        // use Illuminate\Support\Str;

        $users->save();

        return redirect()->route('users.index');
    }
}
