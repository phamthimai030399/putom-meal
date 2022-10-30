@extends('cms.layout.index')
@section('content')
    <div class="fade-in">
        <form method="post" action="{{ route('cms.post.add') }}">

            <div class="row add-new">
                <div class="col-sm-7">
                    <div class="card">
                        <div class="card-header"><strong>Thêm mới</strong></div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Tiêu đề bài viết <span class="text-danger">(*)</span></label>
                                        <input class="form-control" required name="title" value="{{ old('title') }}"
                                            type="text" placeholder="Tiêu đề">
                                    </div>
                                    <div class="form-group">
                                        <label>Nội dung bài viết <span class="text-danger">(*)</span></label>
                                        <textarea class="form-control content" rows="6"
                                            name="content">{{ old('content') }}</textarea>
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
                                <input class="form-control" name="slug" value="{{ old('slug') }}" type="text"
                                    placeholder="Slug">
                            </div>
                            <div class="form-group">
                                <label>Trạng thái <span class="text-danger">(*)</span></label>
                                <select name="status" class="form-control">
                                    <option value="1" selected="">active</option>
                                    <option value="0">deactive</option>
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
    <script src="{{ url('cms/js/post.js') }}"></script>
@endsection
