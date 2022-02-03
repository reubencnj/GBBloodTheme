<html>
<head>
<style>
	body{
		font-family:arial;
	}
	body>table{
		margin:30px 0;
	}
	table{
		border-collapse:collapse;
		width:100%;
	}
	table table{
		margin-bottom:30px;
	}
	table td,table th{
		border:1px solid #000000;
		padding:5px 10px;
	}
	tr.state-completed{
		background-color:#c7ffc7;
	}
	tr.state-cancelled	{
		background-color:#ffc7c7;
	}
	th{
		background-color:#000000;
		color:#ffffff;
	}
</style>
<script type="text/javascript">
  setTimeout(function(){
	location.reload();
  },60000)
</script>
</head>
<body>
	<h1>Goodbody Store Orders</h1>
	<h3>Last Loaded: <?=date('d/m/Y h:i:s');?></h3>
    <table>
    <thead>
		<tr>
			<th>Order ID</th>
			<th>Order Status</th>
			<th>Billing Name</th>
			<th>Shipping Name</th>
			<th>Order Lines</th>
        </tr>
    </thead>
    <tbody>
	<?php foreach($orders AS $os => $s):?>
		<?php foreach($s AS $id => $o):?>
		<tr class="state-<?=$os;?>"> 
			<td><?=$id;?></td>
			<td><?=$os;?></td>
			<td><?=$o['billing']['first_name'];?> <?=$o['billing']['last_name'];?></td>			
			<td><?=$o['shipping']['first_name'];?> <?=$o['shipping']['last_name'];?></td>
			<td>
				<table>
					<tbody>
						<?php foreach($o['order_lines'] AS $l):?>
							<tr>
								<td style="width:10%;"><?=$l['id'];?></td><td style="width:80%;"><?=$l['name'];?></td><td style="width:10%;">x<?=$l['qty'];?></td>
							</tr>
						<?php endforeach;?>
					</tbody>
				</table>
			</td>

        </tr>
		<?php endforeach;?>
		<?php endforeach;?>
    </tbody>
    </table>

</body>


</html>
<?php


$orders=get_orders();
echo print_r($orders);
 function get_orders(){
    //  echo 'Fetching data...<br/>';
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, "https://goodbodystore.com/wp-json/wc/v3/orders?per_page=100&status=processing");
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
      curl_setopt($ch, CURLOPT_USERPWD, "ck_e4f41ec41b3b2d136472c730087726b9fec56ef0" . ":" . "cs_150eb88494eac1a4681e164dbf2f1b8e322462f6");
      //curl_setopt($ch, CURLOPT_POSTFIELDS, 'status=processing');
      $result = curl_exec($ch);
      if (curl_errno($ch)) {
          echo 'Error:' . curl_error($ch);
          die();
      }else{
       //   echo 'Done<br/>';
      }
      curl_close ($ch);
      echo '<pre>'.print_r($result, true).'</pre>';

      $orders = json_decode($result, true);
      $output = array();
      foreach($orders AS $o){
          if(!isset($output[$o['status']][$o['id']])){
              $output[$o['status']][$o['id']]=array('billing'=>$o['billing'], 'shipping'=>$o['shipping'], 'order_lines'=>array());
          } 
          foreach($o['line_items'] AS $l){
              $output[$o['status']][$o['id']]['order_lines'][]=array('id'=>$l['product_id'], 'name'=>$l['name'], 'qty'=>$l['quantity']);
          }
      }
      return $output;
  }

?>