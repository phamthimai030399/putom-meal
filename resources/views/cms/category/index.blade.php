@extends('cms.layout.index')
@section('content')

<div class="fade-in">
        <div class="card">
            <div class="card-header">
                Danh mục sản phẩm
                <div class="card-header-actions pr-1">
                    <a href="{{route('cms.category.add')}}"><button class="btn btn-primary btn-sm mr-3" type="button">Thêm mới</button></a>
                </div>
            </div>
            <div class="card-body">
                <form method="get" action="">
                    <div class="form-group row">
                        <div class="col-4">
                            <input type="text" value="{{Request::get('keyword') ?? ''}}" name="keyword" class="form-control" placeholder="Từ khóa">
                        </div>

                        <div class="col-3">
                            <select name="status" class="form-control">
                                <option value="">All</option>
                                <option {{ Request::get('status') == '1' ? 'selected' : '' }} value="1">Active</option>
                                <option {{ Request::get('status') == '0' ? 'selected' : '' }} value="0">Deactive</option>
                            </select>
                        </div>
                        <div class="col-2">
                            <input type="submit" class="btn btn-primary" value="Tìm kiếm">
                        </div>
                    </div>
                </form>
                <table class="table table-striped table-bordered datatable">
                    <thead>
                    <tr>
                        <th class="text-center w-5">ID</th>
                        <th>Tiêu đề</th>
                        <th class="text-center w-15">Trạng thái</th>
                        <th class="text-center w-15">Thao tác</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!empty($listItem)) @foreach($listItem as $item)
                    <tr>
                        <td class="text-center">{{$item->id}}</td>
                        <td><a target="_blank" rel="nofollow" href="{{route('web.category.detail', [$item->slug, $item->id])}}">{{$item->title}}</a></td>
                        <td class="action"> 
                            <a href="{{route('cms.category.changeStatus', ['id' => $item->id, 'status' => $item->status])}}" class="{{($item->status == '1') ? 'btn btn-add' : 'btn btn-danger'}}">{{($item->status == '1') ? 'Active' : 'Deactive'}}</a>
                        </td>
                        <td class="text-center">
                            <a class="btn btn-info" href="{{route('cms.category.update', ['id' => $item->id])}}">
                                <svg class="c-icon">
                                    <use xlink:href="/image/icon-svg/free.svg#cil-pencil"></use>
                                </svg>
                            </a>
                            <a  class="btn btn-danger" onclick="return confirm('Bạn có chắc muốn xóa bản ghi này không!');" href="{{route('cms.category.delete', ['id' => $item->id])}}">
                                <svg class="c-icon text-white">
                                    <use xlink:href="{{ asset('image/icon-svg/free.svg#cil-trash') }}"></use>
                                </svg>
                            </a>
                        </td>
                    </tr>
                    @endforeach @endif
                    </tbody>
                </table>
                {{ $listItem->appends($condition)->links('cms.layout.panigation') }}
            </div>
        </div>
    </div>

@endsection