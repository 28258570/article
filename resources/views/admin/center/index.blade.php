@extends('admin.layout.layout')
@section('content')
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h1 class="page-header">
                    个人中心 <small></small>
                </h1>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                用户名：{{session('username')}}
            </div>
            @foreach($role as $k=>$v)
                <div class="col-sm-11" id="permission_list" style="background-color: white;width: 100%;height: 50px;line-height: 50px">
                    <label class="inputLabel" style="">
                        <span>{{$v->name}}</span>@if($v->id == $role_id) <i class="layui-icon layui-icon-note"></i> @endif
                    </label>
                </div>
            @endforeach
        </div>
    </div>
@endsection