@extends('admin.layout.layout')
@section('content')
    {{--<script src="https://cdn.bootcss.com/jquery/3.4.1/core.js"></script--}}
    <style>
        .mediaName{
            width: 100%;
            background-color: #98cbe8;
        }
    </style>
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h1 class="page-header">
                    订单管理 <small></small>
                </h1>
            </div>
        </div>
        <!-- /. ROW  -->

        <div class="row">
            <div class="col-md-12">
                <!-- Advanced Tables -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        订单列表
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline" role="grid">
                                <div class="row">
                                    <div class="col-sm-5" id="sandbox-container">
                                        <form action="" name="search" class="my-form">
                                            <label>订单编号:<input type="text" class="form-control input-sm" name="order_num" value="{{$params['order_num'] or ''}}" aria-controls="dataTables-example"></label>
                                            <label>手机号:<input type="text"   class="form-control input-sm" name="mobile" value="{{$params['mobile'] or ''}}" aria-controls="dataTables-example"></label>
                                            <label>购买时间：</label>
                                            <div class="input-daterange input-group" id="datepicker">
                                                <input type="text" class="input-sm form-control" style="width: 187px" id="start" name="start" autocomplete="off" value="{{$params['start'] or ''}}">
                                                <span class="input-group-add" >~</span>
                                                <input type="text" class="input-sm form-control"style="width: 187px" id="end" name="end" autocomplete="off" value="{{$params['end'] or ''}}">
                                            </div>
                                            <button type="submit" class="btn btn-default btn-sm">提交</button>
                                        </form>
                                    </div>
                                </div>
                                <table class="table table-striped table-bordered table-hover dataTable no-footer" id="dataTables-example" aria-describedby="dataTables-example_info">
                                    <thead>
                                    <tr role="row">
                                        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">ID</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">订单编号</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">手机号</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">商品名</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">实付金额</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">购买类型</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">购买时间</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width:120px;">操作</th></tr>
                                    </thead>
                                    <tbody>
                                    @foreach($list as $k=>$v)
                                        <tr class="gradeA odd">
                                            <td class="">{{$v->id}}</td>
                                            <td class=" ">{{$v->order_num}}</td>
                                            <td class=" ">{{$v->getUser->mobile}}</td>
                                            <td class=" ">
                                                @if($v->type == 1)
                                                    {{$v->getMcn->name}}
                                                @else
                                                    {{$v->getMcnMeal->name}}
                                                @endif
                                            </td>
                                            <td class=" ">{{$v->price}}</td>
                                            <td class=" ">
                                                @if($v->type == 1)
                                                    MCN机构
                                                @else
                                                    MCN机构套餐
                                                @endif
                                            </td>
                                            <td class=" ">{{$v->created_at}}</td>
                                            <td class="center ">
                                                <button class="btn btn-info btn-sm" onclick="watchDetail({{$v->id}})">查看详情</button>
                                            </td></tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="row">
                                    @if (!empty($list))
                                        {{ $list->links() }}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--End Advanced Tables -->
            </div>
        </div>
    </div>

    <div class="dialog">
        <div class="dia"></div>
        <div class="log">
            <span class="closes" onclick="closesThis()">×</span>
            <div class="yigou">
                <p>订单详情: </p>
                <div class="lists"></div>
            </div>
        </div>
    </div>
    <script>
        $(function () {
            $('#datepicker').datepicker({
                format: "yyyy-mm-dd",
                language: "zh-CN"
            });
        });

        //点击查看账户购买数据
        function watchDetail(id){
            $.ajax({
                type:'get',
                url:'/admin/order/'+id,
                data:{
                    _token: "{{csrf_token()}}"
                },
                dataType:"json",
                async:false,
                success: function (res) {
                    if (res.status == 1){
                        var html = '<div><span class="mediaName">订单编号：'+ res.data.order +'</span></div>'
                            +'<div><span class="mediaName">手机号：'+ res.data.mobile +'</span></div>'
                            +'<div><span class="mediaName">商品类型：'+ res.data.type +'</span></div>'
                            +'<div><span class="mediaName">商品名：'+ res.data.name +'</span></div>'
                            +'<div><span class="mediaName">商品单价：'+ res.data.price +'</span></div>'
                            +'<div><span class="mediaName">实付金额：'+ res.data.money +'</span></div>'
                            +'<div><span class="mediaName">购买时间：'+ res.data.created_at.date +'</span></div>'
                            +'<div><span class="mediaName">商品图片：</span></div>'
                            +'<img id="img_cover" src=/'+ res.data.cover +'>';
                        $('.lists').html(html);
                        $('.log').removeClass('zoomOut');
                        $('.dia,.log').show();
                        $('.log').addClass('animated zoomIn');
                    } else {
                        layer.msg('拉取失败请稍后重试');
                    }
                }
            });
        }
        //关闭
        function closesThis(){
            $('.log').removeClass('zoomIn')
            $('.dia').hide()
            $('.log').addClass('animated zoomOut')
        }

        //改变状态
        function change(id,state) {
            $.ajax({
                type:'post',
                url:'/admin/mcn/change',
                data:{
                    _token: "{{csrf_token()}}",
                    id: id,
                    state: state
                },
                dataType:"json",
                async:false,
                success: function (res) {
                    if (res.status == 0){
                        layer.msg(res.msg);
                    } else {
                        layer.msg(res.msg,{
                            offset:['50%'],
                            time: 2000
                        },function(){
                            window.location.reload();
                        });
                    }
                }
            });
        }

        function check(type) {
            if (type == 'start') {
                if (($('#start').val() > $('#end').val()) && ($('#end').val())) {
                    layer.msg('开始时间不得大于结束时间',{
                        offset:['50%'],
                        time: 2000
                    },function(){
                        $('#start').val('');
                    });
                }
            } else {
                if (($('#start').val() > $('#end').val()) && ($('#start').val())) {
                    layer.msg('结束时间不得大于开始时间',{
                        offset:['50%'],
                        time: 2000
                    },function(){
                        $('#end').val('');
                    });
                }
            }
        }
        
    </script>
@endsection