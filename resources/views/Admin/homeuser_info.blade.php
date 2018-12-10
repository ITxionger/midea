@extends('Admin.Public.public')
@section('title','用户详情列表')
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
                                    <th>HEADPIC</th>
                                    <th>NAME</th>
                                    <th>PASSWORD</th>
                                    <th>PHONE</th>
                                    <th>SEX</th>
                                    <th>Birthday</th>
                                    <th>Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{$data->id}}</td>
                                    <td>{{$data->headpic}}</td>
                                    <td>{{$data->nickname}}</td>
                                    <td>{{$data->loginpwd}}</td>
                                    <td>{{$data->phone}}</td>
                                    <td>{{$data->sex}}</td>
                                    <td>{{$data->birthday}}</td>
                                    <td>{{$data->email}}</td>
                            </tbody>
                        </table>
                    </div>
                </div>
@endsection
 