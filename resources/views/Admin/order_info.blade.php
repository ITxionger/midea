@extends('Admin.Public.public')
@section('title','订单详情')
@section('admin')
<div class="mws-panel grid_8">
    <div class="mws-panel-header">
         <span><i class="icon-table"></i> 订单信息</span>
    </div>
    <div class="mws-panel-body no-padding">
        <table class="mws-table">
            <tr>
                <td width="100">订单号</td>
                <td>{{$orders->order_id}}</td>
            </tr>
            <tr>
                <td width="100">收货人</td>
                <td>{{$orders->name}}</td>
            </tr>
            <tr>
                <td width="100">手机号</td>
                <td>{{$orders->call}}</td>
            </tr>
            <tr>
                <td width="100">收货地址</td>
                <td>{{$orders->address}}</td>
            </tr>
            <tr>
                <td width="100">下单时间</td>
                <td>{{date('Y年m月d日 H:i:s',$orders->order_time)}}</td>
            </tr>
            <tr>
                <td width="100">支付时间</td>
                <td>
                    @if (!empty($orders->pay_time))
                        {{date('Y年m月d日 H:i:s',$orders->pay_time)}}
                    @else
                        该订单未支付
                    @endif
                </td>
            </tr>
            <tr>
                <td width="100">完成时间</td>
                <td>
                    @if (!empty($orders->end_time))
                        {{date('Y年m月d日 H:i:s',$orders->end_time)}}
                    @else
                        该订单交易中
                    @endif
                </td>
            </tr>
            <tr>
                <td>订单状态</td>
                <td style="color: red">
                    @if ($orders->status == 0) 
                        未支付
                    @elseif ($orders->status == 1)
                        待发货
                    @elseif ($orders->status == 2)
                        已发货
                    @elseif ($orders->status == 3)
                        待评价
                    @elseif ($orders->status == 4)
                        <span style="color:gray">已成交</span>
                    @elseif ($orders->status == 5)
                        退款中
                    @elseif ($orders->status == 6)
                        <span style="color:gray">已关闭</span>
                    @endif
                </td>
            </tr>
        </table>
    </div>
    <br>
    <div class="mws-panel-header">
         <span><i class="icon-table"></i> 订单商品
         @if ($orders->status == 1)
         <a class="btn btn-info" style="float: right;cursor: pointer;">填写发货信息</a>
         @endif
         </span>
    </div>
    <div class="mws-panel-body no-padding">
        <table class="mws-table">
             <thead>
                <tr>
                    <th width="30">序号</th>
                    <th>商品</th>
                    <th>属性</th>
                    <th width="80">单价</th>
                    <th width="30">数量</th>
                    <th width="130">操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order_info as $val)
                <tr>
                    <td>{{++$i}}</td>
                    <td>{{$val->goods_name}}</td>
                    <td>{{$val->goods_sku}}</td>
                    <td>{{$val->goods_price}}</td>
                    <td>{{$val->goods_num}}</td>
                    <td>
                        <a href="#" class="btn btn-info">修改</a>
                        &nbsp;&nbsp;|&nbsp;&nbsp;
                        <a href="#" class="btn btn-danger">删除</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
 