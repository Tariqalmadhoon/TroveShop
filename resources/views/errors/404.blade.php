@if (str_contains(request()->url(), 'admin'))
    <h1>Admin 404</h1>
    {{-- @extends('admin.master') --}}
@else
    <h1>Front 404</h1>
    {{-- @extends('front.master') --}}
@endif

