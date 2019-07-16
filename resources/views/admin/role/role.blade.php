@extends('admin.layout.layout')
@section('content')
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h1 class="page-header">
                    设置权限 <small></small>
                </h1>
            </div>
        </div>
        @foreach($menu as $k=>$v)
        <div class="col-sm-11" id="permission_list">
            <label class="inputLabel" style="">
                <input type="checkbox" class="menu" name="menu[]"@if(in_array($v->id,$menu_ids)) checked @endif value="{{$v->id}}">{{$v->menu_name}}
            </label>
        </div>
        @endforeach
        <hr>
        <br>
        <div class="col-sm-11" id="permission_list">
            <a href="javascript:;" onclick="confim()" class="btn btn-success">设置</a>
            <button type="reset" class="btn btn-default" onclick="javascript:history.go(-1);">返回</button>
        </div>
    </div>
    <script>
        function confim() {
            var menu = '';
            $(".menu:checkbox").each(function() {
                if($(this).is(":checked")) {
                    menu += $(this).attr("value")+",";
                }
            });
            menu=menu.substring(0,menu.length-1);
            $.post('{{url('admin/role/auth')}}', {
                _token: "{{csrf_token()}}",
                id: "{{$id}}",
                menu: menu,
            }, function (res) {
                if (res.status == 0){
                    layer.msg(res.msg);
                } else {
                    layer.msg(res.msg,{
                        offset:['50%'],
                        time: 2000
                    },function(){
                        window.location.href = '/admin/role'
                    });
                }
            }, 'json');
        }
    </script>
@endsection