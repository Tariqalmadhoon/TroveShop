@extends('admin.master')

@section('content')
@section('title' ,'Add New Roles')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Add new Permissions</h1>

<form action="{{ route('admin.roles.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    @include('admin.roles._form')

    <button class="btn btn-success"><i class="fas fa-save"></i> Add</button>
</form>

@endsection

@section('title', 'Dashboard')

@section('js')
<script>
    function showImg(e) {
        const [file] = e.target.files
        if (file) {
            preview.src = URL.createObjectURL(file)
        }
    }
</script>
@endsection
