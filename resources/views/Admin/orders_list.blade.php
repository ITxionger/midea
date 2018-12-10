@extends('Admin.Public.public')
@section('title','订单列表')
@section('admin')
<div class="mws-panel grid_8">
    <div class="mws-panel-header">
         <span><i class="icon-table"></i>订单列表</span>
    </div>
    <div class="mws-panel-body no-padding">
        <table class="mws-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>订单号</th>
                    <th>用户名</th>
                    <th>订单状态</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
            @foreach($orders as $key=>$value)
                
                <tr>
                    <td>{{$value->id}}</td>
                    <td>{{$value->order_id}}</td>
                    <td>{{$value->user_id}}</td>
                    <td>
                        @if ($value->status == 0) 
                            未支付
                        @elseif ($value->status == 1)
                            待发货
                        @elseif ($value->status == 2)
                            已发货
                        @elseif ($value->status == 3)
                            待评价
                        @elseif ($value->status == 4)
                            已成交
                        @elseif ($value->status == 5)
                            退款中
                        @elseif ($value->status == 6)
                            已关闭
                        @endif
                    </td>
                    <td>
                        <a href="/admin/orders/{{$value->id}}" class="btn btn-info">详情</a>
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
 