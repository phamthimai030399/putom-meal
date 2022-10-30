@extends('cms.layout.index')
@section('content')
    <div class="fade-in">
        <form method="post" action="{{ route('cms.product.add') }}">

            <div class="row add-new">
                <div class="col-sm-7">
                    <div class="card">
                        <div class="card-header"><strong>Thêm mới</strong></div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Tên sản phẩm <span class="text-danger">(*)</span></label>
                                        <input class="form-control" required name="title" value="{{ old('title') }}"
                                            type="text" placeholder="Tiêu đề">
                                    </div>
                                    <div class="form-group">
                                        <label>Danh mục sản phẩm<span class="text-danger">(*)</span></label>
                                        <select class="form-control select2 category" name="category_id">
                                            @if (!empty($allCategory))
                                                @foreach ($allCategory as $item)
                                                    @if (!empty(old('category_id')))
                                                        <option value="{{ $item->id }}" selected="selected">
                                                            {{ $item->title }}</option>
                                                    @else
                                                        <option value="{{ $item->id }}">{{ $item->title }}</option>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Nhà cung cấp<span class="text-danger">(*)</span></label>
                                        <select class="form-control select2 category" name="supplier_id">
                                            @if (!empty($allSupplier))
                                                @foreach ($allSupplier as $item)
                                                    @if (!empty(old('supplier_id')))
                                                        <option value="{{ $item->id }}" selected="selected">
                                                            {{ $item->title }}</option>
                                                    @else
                                                        <option value="{{ $item->id }}">{{ $item->title }}</option>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Mô tả <span class="text-danger">(*)</span></label>
                                        <textarea class="form-control content" rows="6"
                                            name="description">{{ old('description') }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Giá gốc</label>
                                        <input class="form-control" name="price_origin"
                                            value="{{ old('price_origin') }}" type="text" placeholder="Giá gốc">
                                    </div>
                                    <div class="form-group">
                                        <label>Giá bán <span class="text-danger">(*)</span></label>
                                        <input class="form-control" required name="price_sell"
                                            value="{{ old('price_sell') }}" type="text" placeholder="Giá bán">
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
                                <label>Đơn vị bán<span class="text-danger">(*)</span></label>
                                <select name="unit_of_sell" class="form-control">
                                    @foreach (UNIT as $item)
                                        <option value="{{ $item }}">{{ $item }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Đơn vị tính<span class="text-danger">(*)</span></label>
                                <select name="unit_of_measure" class="form-control">
                                    @foreach (UNIT as $item)
                                        <option value="{{ $item }}">{{ $item }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Khối lượng mặc định<span class="text-danger">(*)</span></label>
                                <input class="form-control" required name="mass_default"
                                    value="{{ empty(old('mass_default')) ? 1 : old('mass_default') }}" type="text"
                                    placeholder="Khối lượng mặc định">
                            </div>
                            <div class="form-group">
                                <label>Trạng thái <span class="text-danger">(*)</span></label>
                                <select name="status" class="form-control">
                                    <option value="1" selected="">active</option>
                                    <option value="0">deactive</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Ảnh đại diện <span class="text-danger">(*)</span></label>
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <a href="#" id="lfm" data-input="thumbnail" data-preview="holder"
                                            class="btn btn-primary">
                                            <i class="fa fa-picture-o"></i> Chọn ảnh
                                        </a>
                                    </span>
                                    <input id="thumbnail" class="form-control" type="text" name="thumbnail"
                                        value="{{ old('thumbnail') }}">
                                </div>
                                <div id="holder" style="margin-top:15px;max-height:100px;">
                                    @if (!empty(old('thumbnail')))
                                        <img src="{{ old('thumbnail') }}" class="img-fluid d-block" width="100px">
                                    @endif
                                </div>
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
