<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.admin');
    }

    /**
     * 订单列表
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $params = $request->all();
        $list = Order::getData($params);
        return view('admin.order.index',[
           'list' => $list,
           'params' => $params
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.order.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * 展示订单信息
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $order = (new Order())->find($id);
            $data['order'] = $order->order_num;
            $data['mobile'] = $order->getUser->mobile;
            $data['money'] = $order->price;
            $data['created_at'] = $order->created_at;
            if ($order->type == 1){
                $data['type'] = 'MCN机构';
                $data['name'] = $order->getMcn->name;
                $data['price'] = $order->getMcn->price;
                $data['cover'] = $order->getMcn->cover;
            } else {
                $data['type'] = 'MCN机构套餐';
                $data['name'] = $order->getMcnMeal->name;
                $data['price'] = $order->getMcnMeal->price;
                $data['cover'] = $order->getMcnMeal->cover;
            }
            $result = ['status' => 1, 'data' => $data];
        }catch(\Exception $e) {
            $result = ['status' => 0, 'data' => ''];
        }
        return response()->json($result);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
