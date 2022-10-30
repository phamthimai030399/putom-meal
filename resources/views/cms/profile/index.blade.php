@extends('cms.layout.index')
@section('content')

    <div class="fade-in">
        <div class="card">
            <div class="card-header">
                Thông tin khách hàng
                <div class="card-header-actions pr-1">
                </div>
            </div>
            <div class="card-body">
                <form method="get" action="">
                    <div class="form-group row">
                        <div class="col-8">
                            <input type="text" value="{{ Request::get('keyword') ?? '' }}" name="keyword"
                                class="form-control" placeholder="Từ khóa">
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
                            <th class="text-center">Họ và tên</th>
                            <th class="text-center">Số điện thoại</th>
                            <th class="text-center">Địa chỉ</th>
                            <th class="text-center w-15">Trạng thái</th>
                            <th class="text-center w-15">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($listItem))
                            @foreach ($listItem as $item)
                                <tr>
                                    <td class="text-center">{{ $item->id }}</td>
                                    <td>
                                        <a href="{{ route('cms.profile.detail', [$item->id]) }}">
                                            {{ $item->full_name }}
                                        </a>
                                    </td>
                                    <td>{{ $item->phone_number }}</td>
                                    <td>{{ $item->address }}</td>
                                    <td class="action">
                                        <a href="{{ route('cms.user.changeStatus', ['id' => $item->account->id, 'status' => $item->account->status]) }}"
                                            class="{{ $item->account->status == '1' ? 'btn btn-add' : 'btn btn-danger' }}">{{ $item->account->status == '1' ? 'Active' : 'Deactive' }}</a>
                                    </td>
                                    <td class="text-center">
                                        <a class="btn btn-info"
                                            href="{{ route('cms.profile.update', ['id' => $item->id]) }}">
                                            <svg class="c-icon">
                                                <use xlink:href="/image/icon-svg/free.svg#cil-pencil"></use>
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
                {{ $listItem->appends($condition)->links('cms.layout.panigation') }}
            </div>
        </div>
    </div>

@endsection
