{{-- Home sẽ kế thừ viiew master --}}
@extends('layout.master')
{{-- section sẽ thay đổi phần yeild trong master --}}
@section('title', 'Parant Category Page')
@section('content-title', 'Parent Category Page')
@section('content')
<div>
    <a href="{{route('parent-cate.add')}}">
        <button class="btn btn-primary">Create</button>
    </a>
</div>

<table class="table table-hover">
    
    <thead>
        <th>ID</th>
        <th>Name</th>
        <th>Status</th>
        <th>Created at</th>
        <th>Updated at</th>
        <th>Actions</th>
        
    </thead>
    <tbody>
     @foreach ($data as $item) 
              
        <tr>
            <td>{{$item->id}}</td>
            <td>{{$item->name}}</td>
            <td>{{$item->status == 1 ?  'Active' : 'Deactive'}} </td>
            <td>{{$item->created_at ?: 'N/A'}}</td>
            <td>{{$item->updated_at ?: 'N/A'}}</td>  
            <td>
                <a href="{{route('parent-cate.edit', $item->id)}}" class="btn btn-warning">
                    Edit
                </a>
                <a href="{{route('parent-cate.delete', $item->id)}}" onclick="return confirm('Are you sure?')"class="btn btn-danger">
                    Delete
                </a>
        
                </td>       
        </tr>             
     @endforeach          
    </tbody>
</table>
 {{ $data->links() }}

@endsection
