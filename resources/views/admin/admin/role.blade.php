@extends('admin.layout.layout')
@section('content')
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h1 class="page-header">
                    设置角色 <small></small>
                </h1>
            </div>
        </div>
        @foreach($role as $k=>$v)
        <div class="col-sm-11" id="permission_list">
            <label class="inputLabel" style="">
                <input type="radio" class="role" name="role" value="{{$v->id}}">{{$v->name}}
            </label>
        </div>
        @endforeach
        <hr>
        <br>
        <div class="col-sm-11" id="permission_list">
            <a href="javascript:;" onclick="confim()" class="btn btn-success">设置</a>
            <a href="/admin/admin" class="btn btn-default">返回</a>
        </div>
    </div>
    <script>
        function confim() {
            var role = $('input:radio:checked').val();
            $.post('{{url("admin/admin/role/$id")}}', {
                _token: "{{csrf_token()}}",
                role: role,
            }, function (res) {
                if (res.status == 0){
                    layer.msg(res.msg);
                } else {
                    layer.msg(res.msg,{
                        offset:['50%'],
                        time: 2000
                    },function(){
                        window.location.href = '/admin/admin'
                    });
                }
            }, 'json');
        }
    </script>
@endsection