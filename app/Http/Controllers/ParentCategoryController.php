<?php

namespace App\Http\Controllers;

use App\Models\ParentCategory;
use Illuminate\Http\Request;

class ParentCategoryController extends Controller
{
    public function index()
    {
        $data = ParentCategory::paginate(10);
        return view('parent_category.index', compact('data'));
    }

    public function add()
    {
        return view('parent_category.form-data');
    }

    public function save(Request $request)
    {
        $validatedData = $request->validate(
            [
                'name' => 'required|unique:parent_category|max:50',
                'status' => 'required',
            ],
            [
                'name.required' => 'Tên không được để trống',
                'name.unique' => 'Tên đã tồn tại',
                'name.max' => 'Tên không được quá 50 ký tự',
                'status.required' => 'Trạng thái không được để trống'
            ]
        );
        if($request->has('id')){
            $model = ParentCategory::find($request->id);
        }else{
            $model = new ParentCategory();
        }
        $model->fill($request->all());
        $model->save();

        return redirect()->route('parent-cate.index');
    }

    public function edit($id){
        $data = ParentCategory::find($id);
        return view('parent_category.form-data',compact('data'));
    }

    public function delete($id){
        ParentCategory::destroy($id);
        return redirect()->route('parent-cate.index');
    }
}
