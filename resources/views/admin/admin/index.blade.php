@extends('admin.layout.layout')
@section('content')
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h1 class="page-header">
                    管理员管理 <small></small>
                </h1>
            </div>
        </div>
        <!-- /. ROW  -->

        <div class="row">
            <div class="col-md-12">
                <!-- Advanced Tables -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        管理员列表
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline" role="grid">
                                <div class="row">
                                    <div class="col-sm-6">

                                    </div>

                                </div>
                                <table class="table table-striped table-bordered table-hover dataTable no-footer" id="dataTables-example" aria-describedby="dataTables-example_info">
                                    <thead>
                                    <tr role="row">
                                        <th class="sorting_asc" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column ascending">ID</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">用户名</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">创建时间</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">角色</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width:360px;">操作</th></tr>
                                    </thead>
                                    <tbody>
                                    @foreach($list as $k=>$v)
                                    <tr class="gradeA odd">
                                        <td class="sorting_1">{{$v->id}}</td>
                                        <td class=" ">{{$v->username}}</td>
                                        <td class=" ">{{$v->created_at}}</td>
                                        <td class="center ">A</td>
                                        <td class="center ">
                                            <a href="#" class="btn btn-success">设置角色</a>
                                            <a href="/admin/{{$v->id}}/edit" class="btn btn-info btn-sm">编辑</a>
                                            {{--<a href="#" class="btn btn-primary">primary</a>--}}
                                            <a href="#" class="btn btn-danger">删除</a>
                                        </td></tr>
                                    </tbody>
                                    @endforeach
                                </table>
                                <div class="row">
                                    <!--<div class="col-sm-6">
                                        <div class="dataTables_paginate paging_simple_numbers" id="dataTables-example_paginate">
                                            <ul class="pagination">
                                                <li class="paginate_button previous disabled" aria-controls="dataTables-example" tabindex="0" id="dataTables-example_previous">
                                                    <a href="#">Previous</a></li>
                                                <li class="paginate_button active" aria-controls="dataTables-example" tabindex="0">
                                                    <a href="#">1</a></li>
                                                <li class="paginate_button " aria-controls="dataTables-example" tabindex="0">
                                                    <a href="#">2</a></li>
                                                <li class="paginate_button " aria-controls="dataTables-example" tabindex="0">
                                                    <a href="#">3</a></li>
                                                <li class="paginate_button " aria-controls="dataTables-example" tabindex="0">
                                                    <a href="#">4</a></li>
                                                <li class="paginate_button " aria-controls="dataTables-example" tabindex="0">
                                                    <a href="#">5</a></li>
                                                <li class="paginate_button " aria-controls="dataTables-example" tabindex="0">
                                                    <a href="#">6</a></li>
                                                <li class="paginate_button next" aria-controls="dataTables-example" tabindex="0" id="dataTables-example_next">
                                                    <a href="#">Next</a></li>
                                            </ul>
                                        </div>
                                    </div>-->

                                </div>
                                @if (!empty($list))
                                    {{ $list->links() }}
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
                <!--End Advanced Tables -->
            </div>
        </div>
    </div>
@endsection