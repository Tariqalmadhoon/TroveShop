@extends('admin.master')

@section('title' , 'Roles ')
@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">All Roles</h1>
@if (session()->has('msg'))
<div class="alert alert-{{ session('type') }} alert-dismissible fade show" role="alert">
    {{ session('msg') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
@endif
<table class="table table-bordered table-hover" >
    <tr class="bg-dark text-white">
        <th>#</th>
        <th>Name</th>
        <th>Actions</th>
    </tr>
    @forelse ($roles as $role)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $role->name }}</td>

        <td>
            <a class="btn btn-sm btn-primary" href="{{ route('admin.categories.edit', $role->id) }}"><i class="fas fa-edit"></i></a>
            <form class="d-inline" action="{{ route('admin.categories.destroy', $role->id) }}" method="POST">
                @csrf
                @method('delete')
                <button onclick="return confirm('Are you sure?!')" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
            </form>
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="5" class="text-center">No Data Found</td>
    </tr>
    @endforelse

</table>
{{ $roles->links() }}
@endsection

@section('title', 'Dashboard')
