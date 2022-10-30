@extends('cms.layout.index')
@section('content')
    <main class="c-main">
        <div class="container-fluid">
            <div class="fade-in">  
                <div class="row">
                    <iframe src="/admin/laravel-filemanager" style="width: 100%; height: 500px; overflow: hidden; border: none;"></iframe>
                </div>
            </div>
        </div>
    </main>
@endsection

