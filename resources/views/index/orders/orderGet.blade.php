@extends('index.shops.base')

@section('content')
    <!-- @include('admin.public.error') -->


         @foreach($info as $v)
          <table  class="table table-striped table-bordered">

              <tr>
                <td width="111" height="23"><strong><font color="#CC0000">基本信息：</font></strong></td>
                  <td colspan="3">&nbsp;</td>
              </tr>
                <TR bgColor=#ffffff>
                <TD width=111 height="23" align=right class=black>
                    <DIV align=right>下单用户：</DIV></TD>

                <TD width=235>{{ $v->uid }}</TD>

                <TD width=87>
                  <div align="right">下单店铺：</div></TD>

                <TD width=163>{{ $v->s_name }}</TD>
                </TR>


                <TR bgColor=#ffffff>
                <TD width=111 height="23" align=right class=black>
                    <DIV align=right>收货地址：</DIV></TD>
                  <TD colspan="3" class=black><input id="goods" type="text" name="" value="{{ $v->addr }}" disabled="true"></TD>
                </TR>

          </table>
          <table border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td height="3" width=100></td>
            </tr>
          </table>

           <table  class="table table-striped table-bordered">

              <tr>
                <td colspan="4"><strong><font color="#CC0000">订单信息：</font></strong></td>

              </tr>
                <TR bgColor=#ffffff>
                <TD width=111 height="23" align=right class=black>
                    <DIV align=right>订单编号：</DIV></TD>

                <TD width=235>{{ $v->o_name }}</TD>

                <TD width=87>
                  <div align="right">下单时间：</div></TD>

                <TD width=163>{{ date('Y-m-d',$v->o_mtime) }}</TD>
                </TR>
                <TR bgColor=#ffffff>
                <TD width=111 height="23" align=right class=black>
                    <DIV align=right>付款时间：</DIV></TD>
                <TD width=235>{{ date('Y-m-d',$v->o_ptime) }}</TD>

                <TD width=87>
                  <div align="right">确认时间：</div></TD>
                <TD width=163>{{ date('Y-m-d',$v->o_otime) }}</TD>
                </TR>
                <TR bgColor=#ffffff>
                <TD width=111 height="23" align=right class=black>
                    <DIV align=right>快递公司：</DIV></TD>
                <TD width=235>{{ $v->express_id }}</TD>

                <TD width=87>
                  <div align="right">物流单号：</div></TD>
                <TD width=163>{{ $v->express_num }}</TD>
                </TR>
                <TR bgColor=#ffffff>
                <TD width=111 height="23" align=right class=black>
                    <DIV align=right>订单状态：</DIV></TD>
                <TD width=235><select id='stat' name="status">
                              <option value="0">未付款</option>
                              <option value="1">付款</option>
                              <option value="2">卖家待发货</option>
                              <option value="3">卖家已发货</option>
                              <option value="4">收货</option>
                </select></TD>

                <TD width=87>
                  <div align="right"></div></TD>
                <TD width=163></TD>
                </TR>

                <TR bgColor=#ffffff>
                <TD width=111 height="23" align=right class=black>
                    <DIV align=right>买家留言：</DIV></TD>
                  <TD colspan="3" class=black>{{ $v->uid }}</TD>
                </TR>

          </table>


              <table border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td height="3" width=100></td>
                </tr>
              </table>


            <table   class="table table-striped table-bordered" style=" table-layout:fixed;word-break : break-all;">
               <tr>
                  <td colspan="8"><strong><font color="#CC0000">商品信息：</font></strong></td>
              </tr>
              <tr bgcolor="#CCCCCC">
                <td width="35" height="23" > <div align="center"><strong>商品号</strong></div></td>
                <td width="66"> <div align="center">商品图</div></td>
                <td colspan="2" width="64"> <div align="center">商品</div></td>
                <td width="51"> <div align="center">单价</div></td>
                <td width="50"> <div align="center">数量</div></td>
                <td width="85"> <div align="center">总价</div></td>
                <td width="85"> <div align="center">运费</div></td>
              </tr>

              <tr bgcolor="#CCCCCC">
                <td width="35" height="23" > <div align="center">{{ $v->gid }}</div></td>
                <td width="64"> <div align="center">{{ $v->g_pic }}</div></td>
                <td colspan="2" width="166"> <div align="center"><strong>{{ $v->g_name }}</strong><br>{{ $v->g_spec }}</div></td>
                <td width="51"> <div align="center">{{ $v->g_price }}</div></td>
                <td width="50"> <div align="center">{{ $v->o_count }}</div></td>
                <td width="85"> <div id="o_prices" align="center">{{ $v->o_prices }}</div></td>
                <td width="85"> <div id="y_money" align="center">{{ $v->y_money }}</div></td>
              </tr>

              <tr bgcolor="#CCCCCC">
                <td height=25 colspan=7 align=right>实付款：</td>
                <td align=center><label id="total"></label></td>
              </tr>
            </table>
            <br /><br /><br />
            <table   class="table table-striped">


              <tr>
                <td align=right><a href="{{ url('index/ShopOrders') }}" class="btn btn-danger m-b-5">返回</a></td>
              </tr>
            </table>


      <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
      <script src="{{ asset('admin/js/jquery.js') }}"></script>
      <script>
        var o = document.getElementById('o_prices').innerHTML;
        var y = document.getElementById('y_money').innerHTML;
        var m = parseFloat(o) + parseFloat(y);

        var p = document.getElementById('total').innerHTML;
        p = m;
        // alert(p.toFixed(2));结果强制保留两位小数；
        document.getElementById('total').innerHTML = p.toFixed(2) ;

        //收货地址编辑
        $('#goods').mouseover(function(){
            $(this).attr('disabled',false);
        }).mouseout(function(){
            $(this).attr('disabled',true);
            if($(this).val() != ''){
               var addr = $(this).val();
               $.ajax({
                  
                  url : "{{ url('index/ShopOrders/update') }}",
                async : true,
                 data : {'id':"{{ $v->id }}",'addr':addr,'_token':'{{csrf_token()}}'},
                 type : 'post',
                error:function()                                      
                {
                    alert('ajax请求失败');
                }

               });
            }
        });

        $('option').each(function(){
            if($(this).val() == {{ $v->o_status }}){
                $(this).attr('selected',true);
            }
        });
        $('#stat').change(function(){
            var choose = $('#stat').val();
            $.ajax({
                  
                  url : "{{ url('index/ShopOrders/changeStatus') }}",
                async : true,
                 data : {'id':"{{ $v->id }}",'chs':choose ,'_token':'{{csrf_token()}}'},
                 type : 'post',
                error:function()                                      
                {
                    alert('ajax请求失败');
                }

              });
      
        });

      </script>



        @endforeach



 @endsection
