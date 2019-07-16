@extends('admin.layout.layout')
@section('content')
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h1 class="page-header">
                    菜单管理 <small></small>
                </h1>
            </div>
        </div>
        <!-- /. ROW  -->

        <div class="row">
            <div class="col-md-12">
                <!-- Advanced Tables -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        菜单列表
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
                                        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">菜单名称</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">菜单描述</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">菜单链接</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTables-example" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">创建时间</th></tr>
                                    </thead>
                                    <tbody>
                                    @foreach($list as $k=>$v)
                                        <tr class="gradeA odd">
                                            <td class="sorting_1">{{$v->id}}</td>
                                            <td class=" ">{{$v->menu_name}}</td>
                                            <td class=" ">{{$v->describe}}</td>
                                            <td class=" ">{{$v->menu_url}}</td>
                                            <td class="center ">{{$v->created_at}}</td></tr>
                                    </tbody>
                                    @endforeach
                                </table>
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