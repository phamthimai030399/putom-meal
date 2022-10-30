@extends('cms.layout.index')
@section('content')

    <div class="fade-in">
        <div class="card">
            <div class="card-header">
                DANH SÁCH TÀI KHOẢN
                <div class="card-header-actions pr-1">
                    <a class="btn btn-add btn-sm mr-2" href="{{ route('cms.user.add') }}">
                        <svg class="c-icon">
                            <use xlink:href="{{ asset('image/icon-svg/free.svg#cil-plus') }}"></use>
                        </svg> Thêm
                        </button>
                        <a class="btn btn-info btn-sm" href="{{ url()->current() }}">
                            <svg class="c-icon">
                                <use xlink:href="{{ asset('image/icon-svg/free.svg#cil-reload') }}"></use>
                            </svg> Tải lại
                        </a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered datatable">
                    <thead>
                        <tr>
                            <th class="text-center w-5">ID</th>
                            <th>Username</th>
                            <th class="text-center w-15">Quyền</th>
                            <th class="text-center w-15">Trạng thái</th>
                            <th class="text-center w-15">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $item)
                            <tr>
                                <td class="text-center">{{ $item->id }}</td>
                                <td>{{ $item->username }}</td>
                                <td class="text-center">
                                    <?php
                                    echo empty($permission[$item->role]) ? '' : $permission[$item->role]['name'];
                                    ?>
                                </td>
                                <td class="action">
                                    <a href="{{ route('cms.user.changeStatus', [$item->id, $item->status]) }}"
                                        class="{{ $item->status == '1' ? 'btn btn-add' : 'btn btn-danger' }}">{{ $item->status == '1' ? 'active' : 'deactive' }}</a>
                                </td>

                                <td class="text-center">
                                    <a class="btn btn-info" href="{{ route('cms.user.update', $item->id) }}">
                                        <svg class="c-icon">
                                            <use xlink:href="/image/icon-svg/free.svg#cil-pencil"></use>
                                        </svg>
                                    </a>
                                    <a class="btn btn-danger" href="{{ route('cms.user.delete', $item->id) }}"
                                        onclick="return confirm('Bạn có chắc chắn muốn xóa người dùng này.')">
                                        <svg class="c-icon text-white">
                                            <use xlink:href="/image/icon-svg/free.svg#cil-trash"></use>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $users->links('cms.layout.panigation') }}
            </div>
        </div>
    </div>
@endsection
