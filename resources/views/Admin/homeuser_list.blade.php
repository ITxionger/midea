@extends('Admin.Public.public')
@section('title','用户列表')
@section('admin')
<div class="mws-panel grid_8">
                    <div class="mws-panel-header">
                         <span><i class="icon-table"></i> Simple Table</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                        <table class="mws-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>NAME</th>
                                    <th>PASSWORD</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $key=>$value)
                                <tr>
                                    <td>{{$value->id}}</td>
                                    <td>{{$value->nickname}}</td>
                                    <td>{{$value->loginpwd}}</td>
                                    <td>
                                        <a href="/homeuser/{{$value->id}}" class="btn btn-info">查看用户详情</a>
                                        &nbsp&nbsp&nbsp | &nbsp&nbsp&nbsp
                                        <a href="#" class="btn btn-success">修改</a>
                                        &nbsp&nbsp&nbsp | &nbsp&nbsp&nbsp
                                        <a href="#" class="btn btn-danger">删除</a>

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
@endsection
 