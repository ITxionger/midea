<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 加载订单列表
        $orders = DB::table('orders')->select('id','order_id','user_id','status')->get();
        return view('Admin.orders_list',['orders'=>$orders]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // 加载订单详情
        $orders = DB::table('orders')->where('id','=',$id)->first();
        $order_info = DB::table('order_detail')->where('order_id','=',$orders->order_id)->get();
        return view('Admin.order_info',['orders'=>$orders,'order_info'=>$order_info]);
    }

    /**
     * 修改商家备注.
     *
     * @param  int  $id    订单表id
     * @param  str  $val   要修改的'商家备注'
     * @return \Illuminate\Http\Response
     */
    public function memo()
    {
        $id = $_GET['id'];
        $val = $_GET['val'];
        DB::table('orders')->where('id','=',$id)->update(['memo'=>$val]);
    }

    /**
     * 修改订单商品单价.
     *
     * @param  int  $id    订单表id
     * @param  str  $val   要修改的'商家备注'
     * @return \Illuminate\Http\Response
     */
    public function editprice()
    {
        $goods_id = $_GET['id'];
        $goods_price = $_GET['price'];
        // echo $goods_id.$goods_price;
        DB::table('order_detail')->where('id','=',$goods_id)->update(['goods_price'=>$goods_price]);
    }

    /**
     * 修改发货信息.
     *
     * @param  int  $id    订单表id
     * @param  str  $val   要修改的'发货信息'
     * @return \Illuminate\Http\Response
     */
    public function addr()
    {
        $id = $_GET['id'];
        unset($_GET['id']);
        $val = $_GET;
        DB::table('orders')->where('id','=',$id)->update($val);
    }

    /**
     * 添加物流信息.
     *
     * @param  int  $id               订单表id
     * @param  str  $val              要添加的物流信息
     * @return \Illuminate\Http\Response
     */
    public function express()
    {
        $id = $_GET['id'];
        unset($_GET['id']);
        $_GET['status'] = 2;
        $val = $_GET;
        DB::table('orders')->where('id','=',$id)->update($val);
        return $this->show($id);
        // echo "<script>location.href='/admin/orders/'".$id."</script>";
    }


    public function showlogistics(){
        $data = json_decode(file_get_contents('http://www.kuaidiapi.cn/rest/?uid=106930&key=116451c4958c47d387637380d4809cf6&order='.$_GET['order'].'&id='.$_GET['id']));
        $data = array_reverse($data->data);
        foreach ($data as $val) {
            echo "<tr><td>".($val->time)."</td><td>-</td><td>".($val->content)."</td></tr>";
        }
    }
}
