@extends('cms.layout.index')
@section('content')
    <div class="fade-in">
        <!-- view này action đến admin/category/form -->
        <form method="post" action="{{route('cms.category.add')}}">
            <div class="row add-new">
                <div class="col-sm-7">
                    <div class="card">
                        <div class="card-header"><p>THÊM MỚI DANH MỤC</p></div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Tiêu đề <span class="text-danger">(*)</span></label>
                                        <input class="form-control" required name="title" type="text" placeholder="Tên danh mục" value="{{old('title')}}">
                                    </div>

                                    <div class="form-group">
                                        <label>Danh mục cha<span class="text-danger">(*)</span></label>
                                        <select class="form-control select2 category" name="category_parent_id">
                                            <option value="0">------ Lựa chọn danh mục cha ------</option>
                                            @if (!empty($allCategoryTree)) 
                                                @foreach($allCategoryTree as $item)
                                                    @if (!empty(old('category_parent_id')) && old('category_parent_id') == $item->id)
                                                        <option value="{{$item->id}}" selected>{{$item->title}}</option>
                                                    @else
                                                        <option value="{{$item->id}}">{{$item->title}}</option>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </select> 
                                    </div>

                                    <div class="form-group">
                                        <label>Mô tả <span class="text-danger">(*)</span></label>
                                        <textarea class="form-control content" rows="6" name="description">{{old('description')}}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="card">
                        <div class="card-header"><strong>Thông tin khác</strong></div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Slug <span class="text-danger">(*)</span></label>
                                <input class="form-control" name="slug" value="{{old('slug')}}" type="text" placeholder="Slug">
                            </div>
                            <div class="form-group">
                                <label>Trạng thái</label>
                                <select name="status" class="form-control">
                                    <option {{old('status', 1) == 1 ? 'selected' : ''}} value="1">Active</option>
                                    <option {{old('status', 1) == 0 ? 'selected' : ''}} value="0">Deactive</option>
                                </select>
                            </div>
                            <div class="form-group float-right">
                                <button type="submit" class="btn btn-primary">Lưu lại</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script type="text/javascript">
        var url_ajax_load_category = "{{route('cms.category.loadAjax')}}";
    </script>
    <script src="{{url('cms/js/category.js')}}"></script>
@endsection

