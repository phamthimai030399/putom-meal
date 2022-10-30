@extends('cms.layout.index')
@section('content')
<link rel="stylesheet" href="{{url('cms/css/menu.css')}}">
    <div class="fade-in">
        <div class="card">
            <div class="card-header">
                <h5>Quản lý Menu</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="mb-4 text-center bg-success text-white ">Thêm menu</h5>
                        <form action="{{ route('cms.menu.add') }}" method="post">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" name="title" class="form-control" value="{{ old('title')}}">
                                    </div>
                                    <div class="form-group">
                                        <label>Link</label>
                                        <input type="text" name="link" class="form-control" value="{{ old('link')}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row d-none">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Menu cha</label>
                                        <select class="form-control" name="parent_id">
                                            <option value="0">Chọn menu cha</option>
                                            @foreach ($allMenus as $key => $value)
                                                <option value="{{ $key }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <button class="btn btn-success">Lưu</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <h5 class="text-center mb-4 bg-info text-white">Menu List</h5>
                        <ul id="treeMenu">
                            @foreach ($menus as $key => $menu)
                                <li>
                                    {{ $menu->title }}
                                    @include('cms.menu.manageChild', ['childs' => $menu->childs, '_this' => $menu, 'key' => $key])
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{url('cms/js/menu.js')}}"></script>
@endsection
