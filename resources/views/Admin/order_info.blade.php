@extends('Admin.Public.public')
@section('title','订单详情')
@section('admin')
<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
    .logistics {
        width: 50%;
        height: 50%;
        position: fixed;
        top: 15%;
        left: 25%;
        right: 25%;
        display: none;
    }
    #logistics {
        width: 90%;
        height: 300px;
        background: #ddd;
        margin: 20px auto;
        overflow:auto;
    }
    #logistics td {
        vertical-align: top;
        padding-bottom: 10px;
    }
    #logistics td:nth-child(1) {
        width: 120px;
    }
    #logistics tr:nth-child(1) td {
        color: #ff6700;
    }
</style>
<div class="mws-panel grid_8">
    <div class="mws-panel-header">
         <span><i class="icon-table"></i> 订单信息
         @if ($orders->status < 1)
         <a class="btn btn-info" id="addr" style="float: right;cursor: pointer;">修改发货信息</a>
         @endif
         </span>
    </div>
    <div class="mws-panel-body no-padding">
        <table class="mws-table">
            <tr>
                <td width="100">订单号</td>
                <td>{{$orders->order_id}}</td>
                <th width="20%">买家留言</th>
            </tr>
            <tr>
                <td>收货人</td>
                <td id="name">{{$orders->name}}</td>
                <td rowspan="3">{{$orders->message}}</td>
            </tr>
            <tr>
                <td>手机号</td>
                <td id="call">{{$orders->call}}</td>
            </tr>
            <tr>
                <td>收货地址</td>
                <td id="address">{{$orders->address}}</td>
            </tr>
            <tr>
                <td>运费</td>
                <td id="freight">{{$orders->freight}}</td>
                <th>商家备注</th>
            </tr>
            <tr>
                <td>下单时间</td>
                <td>{{date('Y年m月d日 H:i:s',$orders->order_time)}}</td>
                <td rowspan="3" id="memo">{{$orders->memo}}</td>
            </tr>
            <tr>
                <td>支付时间</td>
                <td>
                    @if (!empty($orders->pay_time))
                        {{date('Y年m月d日 H:i:s',$orders->pay_time)}}
                    @else
                        该订单未支付
                    @endif
                </td>
            </tr>
            <tr>
                <td>完成时间</td>
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
                <td style="text-align: center;"><a href="javascript:void(0)" id="memo_btn" " class="btn btn-info">修改</a></td>
            </tr>
        </table>
    </div>
    <br>
    <div class="mws-panel-header">
        <span><i class="icon-table"></i> 订单商品
        <div style="float: right">
            @if ($orders->status == 1)
                <form action="/admin/ordersexpress">
                <input type="hidden" name="id" value="{{$orders->id}}">
                <select name="express" style="width: 160px"><option value="">--请选择快递公司--</option></select>
                &nbsp;&nbsp;&nbsp;
                <input name="logistics_num" type="text" placeholder="请填写快递单号">
                &nbsp;&nbsp;&nbsp;
                <button class="btn btn-info" style="cursor: pointer;">填写物流信息</button>
                </form>
            @elseif ($orders->status > 1)
                <a class="btn btn-info" href="javascript:void(0)" id="showlogistics" style="cursor: pointer;">查看物流</a>
            @endif
        </div>
        </span>
    </div>
    <div class="mws-panel-body no-padding">
        <table class="mws-table">
             <thead>
                <tr>
                    <th width="30">序号</th>
                    <th>商品</th>
                    <th>属性</th>
                    <th width="20%">单价</th>
                    <th width="30">数量</th>
                </tr>
            </thead>
            <tbody>
                <span style="display: none;">{{$meney = 0}}{{$count = 0}}</span>
                @foreach ($order_info as $val)
                <tr>
                    <td>{{$val->id}}</td>
                    <td>{{$val->goods_name}}</td>
                    <td>{{$val->goods_sku}}</td>
                    <td>
                        <span>{{$val->goods_price}}</span>
                        <a href="javascript:void(0)" class="pull-right" title="edit_price">改价</a>
                    </td>
                    <td>{{$val->goods_num}}</td>
                </tr>
                <span style="display: none;">{{$meney += $val->goods_price*$val->goods_num}}{{$count += $val->goods_num}}</span>
                @endforeach
                <tr><td colspan="6" style="text-align: right;">
                    商品总数：<span style="color: #E21918;font-size: 30px">{{$count}}</span>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    订单总价：<span style="color: #E21918;font-size: 30px">{{$meney}}</span>元
                </td></tr>
            </tbody>
        </table>
    </div>
</div>
@if ($orders->status > 1)
    <div class="mws-panel grid_8 logistics">
        <div class="mws-panel-header">
             <span><i class="icon-table"></i> 物流信息
                <span style="color: red;float: right;font-size: 50px;cursor: pointer;">×</span>
             </span>
        </div>
        <div class="mws-panel-body no-padding">
            <ul>
                <br>
                <li>快递公司：<span id="expressname"></span></li>
                <li>快递单号：{{$orders->logistics_num}}</li>
            </ul>
            <div id="logistics">
                <table></table>
            </div>
        </div>
    </div>
@endif
<script>
// csrf请求头
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
// 修改商家备注
$('#memo_btn').toggle(function() {
    $(this).html('保存');
    $('#memo').html($('<textarea style="width: 100%;">'+$('#memo').html()+'</textarea>'));
},function() {
    id = "{{$orders->id}}";
    val = $('textarea').val();
    $.get('/admin/ordersmemo',{id:id,val:val});
    $(this).html('修改');
    $('#memo').html(val);
});

// 发货前可修改  收货信息
if ("{{$orders->status}}" < 2) {
    $('#addr').toggle(function() {
        $(this).html('　　保存　　');
        $('#name').html($('<input type="text" value="'+$('#name').html()+'" />'));
        $('#call').html($('<input type="text" value="'+$('#call').html()+'" />'));
        $('#address').html($('<input type="text" style="width:100%" value="'+$('#address').html()+'" />'));
        if ("{{$orders->status}}" == 0) {
            // 运费付款前才能改
            $('#freight').html($('<input type="text" value="'+$('#freight').html()+'" />'));
        }
    },function() {
        id = "{{$orders->id}}";
        name = $('#name input').val();
        call = $('#call input').val();
        address = $('#address input').val();
        if ("{{$orders->status}}" == 0) {
            // 运费付款前才能改
            freight = $('#freight input').val();
        }
        $.get('/admin/ordersaddr',{id:id,name:name,call:call,address:address,freight:freight});
        $(this).html('修改发货信息');
        $('#name').html(name);
        $('#call').html(call);
        $('#address').html(address);
        if ("{{$orders->status}}" == 0) {
            // 运费付款前才能改
            $('#freight').html(freight);
        }
    });
}

// 付款前可修改  订单商品价格
if ("{{$orders->status}}" == 0) {
    $('[title=edit_price]').toggle(function() {

        $(this).prev().html($('<input type="text" style="width:100px" value="'+$(this).prev().html()+'" />'));
        $(this).html('确定');
        $(this).addClass('btn btn-info');
    },function(){
        id = $(this).parent().parent().children(0).html();
        price = $(this).prev().children(0).val();
        $.get('/admin/ordersprice',{id:id,price:price});
        $(this).prev().html($(this).prev().children().val());
        $(this).html('改价');
        $(this).removeClass('btn btn-info');
    });
}

// 获取快递公司列表
$.get('/static/express/express.json',function(data) {
    for (var i = 0; i < data.length; i++) {
        if ("{{$orders->status}}" == 1) {
            // 把快递公司名称推到下拉框  发货前
            express = $('<option value="'+data[i].expresskey+'">'+data[i].expressname+'</option>');
            $('select').append(express);
        } else if ("{{$orders->status}}" > 1) {
            // 获取当前订单物流公司   发货后
            if (data[i].expresskey == "{{$orders->express}}") {
               $('#expressname').html(data[i].expressname);
            }
        }
    }
},'json');

// 弹出物流信息表
$('#showlogistics').click(function() {
    $('.logistics').css('display','block');
});
$('.logistics div span span').click(function() {
    $('.logistics').css('display','none');
});


// 获取当前订单物流信息
$.get('/admin/orderslogistics',{id:"{{$orders->express}}",order:"{{$orders->logistics_num}}"},function(data) {
    $('#logistics table').html(data);
});


</script>
@endsection
 