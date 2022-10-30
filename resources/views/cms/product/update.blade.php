@extends('cms.layout.index')
@section('content')
    <div class="fade-in">
        <form method="post" action="{{ route('cms.product.update', ['id' => $oneItem->id]) }}">
            <div class="row">
                <div class="col-sm-7">
                    <div class="card">
                        <div class="card-header">
                            <strong>{{ !empty($oneItem) ? 'Chỉnh sửa' : 'Thêm mới' }}</strong>{!! !empty($oneItem) ? ' - <a rel="nofollow" target="_blank" href="javascript:void(0);">' . $oneItem->title . '</a>' : '' !!}
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Tiêu đề <span class="text-danger">(*)</span></label>
                                        <input class="form-control" required name="title"
                                            value="{{ old('title', $oneItem->title) }}" type="text" placeholder="Tiêu đề">
                                    </div>
                                    <div class="form-group">
                                        <label>Danh mục <span class="text-danger">(*)</span></label>
                                        <select class="form-control select2 category" name="category_id">
                                            @if (!empty($allCategory))
                                                @foreach ($allCategory as $item)
                                                    @if (!empty(old('category_id')) && $item->id == old('category_id'))
                                                        <option value="{{ $item->id }}" selected="selected">
                                                            {{ $item->title }}</option>
                                                    @elseif ($item->id == $oneItem->category_id)
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
                                        <label>Nhà cung cấp <span class="text-danger">(*)</span></label>
                                        <select class="form-control select2 category" name="supplier_id">
                                            @if (!empty($allSupplier))
                                                @foreach ($allSupplier as $item)
                                                    @if (!empty(old('supplier_id')) && $item->id == old('supplier_id'))
                                                        <option value="{{ $item->id }}" selected="selected">
                                                            {{ $item->title }}</option>
                                                    @elseif ($item->id == $oneItem->supplier_id)
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
                                            name="description">{{ old('description', $oneItem->description) }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Giá gốc</label>
                                        <input class="form-control" name="price_origin"
                                            value="{{ old('price_origin', $oneItem->price_origin) }}" type="text"
                                            placeholder="Giá gốc">
                                    </div>
                                    <div class="form-group">
                                        <label>Giá bán <span class="text-danger">(*)</span></label>
                                        <input class="form-control" required name="price_sell"
                                            value="{{ old('price_sell', $oneItem->price_sell) }}" type="text"
                                            placeholder="Giá bán">
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
                                <label>Đơn vị bán</label>
                                <select name="unit_of_sell" class="form-control">
                                    @foreach (UNIT as $item)
                                        <option
                                            {{ isset($oneItem->unit_of_measure) && $oneItem->unit_of_measure == $item ? 'selected' : '' }}
                                            value="{{ $item }}">{{ $item }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Đơn vị tính</label>
                                <select name="unit_of_measure" class="form-control">
                                    @foreach (UNIT as $item)
                                        <option
                                            {{ isset($oneItem->unit_of_measure) && $oneItem->unit_of_measure == $item ? 'selected' : '' }}
                                            value="{{ $item }}">{{ $item }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Khối lượng mặc định</label>
                                <input class="form-control" name="mass_default"
                                    value="{{ old('mass_default', $oneItem->mass_default) }}" type="text"
                                    placeholder="Khối lượng mặc định">
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
                                        value="{{ !empty(old('thumbnail')) ? old('thumbnail') : $oneItem->thumbnail }}">
                                </div>
                                <div id="holder" style="margin-top:15px;max-height:100px;">
                                    <img src="{{ old('thumbnail') ?? $oneItem->thumbnail }}" class="img-fluid d-block"
                                        id="lbl_img" width="100px">
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
