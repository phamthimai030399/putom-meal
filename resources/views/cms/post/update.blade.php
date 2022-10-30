@extends('cms.layout.index')
@section('content')
    <div class="fade-in">
        <form method="post" action="{{ route('cms.post.update', ['id' => $oneItem->id]) }}">
            <div class="row">
                <div class="col-sm-7">
                    <div class="card">
                        <div class="card-header">
                            <strong>{{ !empty($oneItem) ? 'Chỉnh sửa' : 'Thêm mới' }}</strong>{!! !empty($oneItem) ? ' - <a rel="nofollow" target="_blank" href="javascript:void(0);">' . $oneItem->title . '</a>' : '' !!}</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Tiêu đề <span class="text-danger">(*)</span></label>
                                        <input class="form-control" required name="title"
                                            value="{{ old('title', $oneItem->title) }}" type="text" placeholder="Tiêu đề">
                                    </div>
                                    <div class="form-group">
                                        <label>Nội dung <span class="text-danger">(*)</span></label>
                                        <textarea class="form-control content" rows="6"
                                            name="content">{{ old('content', $oneItem->content) }}</textarea>
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
                                <input class="form-control" name="slug" value="{{ old('slug', $oneItem->slug) }}"
                                    type="text" placeholder="Slug">
                            </div>
                            <div class="form-group">
                                <label>Trạng thái</label>
                                <select name="status" class="form-control">
                                    <option {{ isset($oneItem->status) && $oneItem->status == 1 ? 'selected' : '' }}
                                        value="1">active</option>
                                    <option {{ isset($oneItem->status) && $oneItem->status == 0 ? 'selected' : '' }}
                                        value="0">deactive</option>
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
