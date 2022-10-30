<div class="menu-action">
    @if (count($childs))
    <svg class="c-icon mr-2">
        <use xlink:href="{{ asset('image/icon-svg/free.svg#cil-plus') }}"></use>
    </svg>
    @endif
    @if ($key > 0)
    <a href="{{ route('cms.menu.up', $_this->id) }}" title="Đẩy lên">
        <svg class="c-icon mr-2">
            <use xlink:href="{{ asset('image/icon-svg/free.svg#cil-chevron-circle-up-alt') }}"></use>
        </svg>
    </a>
    @endif
    <a href="{{ route('cms.menu.update', $_this->id) }}"  title="Sửa">
        <svg class="c-icon mr-2">
            <use xlink:href="{{ asset('image/icon-svg/free.svg#cil-pen') }}"></use>
        </svg>
    </a>
    <a href="{{ route('cms.menu.delete', $_this->id) }}" onclick="return confirm('Bạn có chắc chắn muốn xóa menu này không?')"  title="Xóa">
        <svg class="c-icon mr-2">
            <use xlink:href="{{ asset('image/icon-svg/free.svg#cil-trash') }}"></use>
        </svg>
    </a>
</div>
<ul>
    @foreach ($childs as $key => $child)
        <li>
            {{ $child->title }}
            @include('cms.menu.manageChild', ['childs' => $child->childs, '_this' => $child, 'key' => $key])
        </li>
    @endforeach
</ul>
