<?php

	session_start();

	require __DIR__.'/vendor/autoload.php';
	use phpish\shopify;
	require __DIR__.'/conf.php';
	
	function updateTracking($ref,$trakingId){

		$shopify = shopify\client(SHOPIFY_SHOP, SHOPIFY_APP_API_KEY, SHOPIFY_APP_PASSWORD, true);
		
			try{
				
				 $orderId = $shopify('GET /admin/orders.json?name='.$ref);
				 $checkoutOrderId=$orderId[0]['id'];
				if($checkoutOrderId!='')
				{
					$updateTrakingId = $shopify('POST /admin/orders/'.$checkoutOrderId.'/fulfillments.json',array(),array
					('fulfillment'=>array
						(
						'tracking_number'=>$trakingId
						
						)
		
					));
				
			
				}
				
				
			}
				catch (shopify\ApiException $e)
			{
			try{
		 	$shopify = shopify\client($_GET['shop'], SHOPIFY_APP_API_KEY, $oauth_token );
		 	$orderId = $shopify('GET /admin/orders.json?name=1002');
			$checkoutOrderId=$orderId[0]['id'];
			if($checkoutOrderId!=''){
			$updateTrakingId = $shopify('POST /admin/orders/'.$checkoutOrderId.'/fulfillments.json',array(),array
			('fulfillment'=>array
				(
					'tracking_number'=>'1234567890'
					
				)
	
			));
			
			
			}
				
				
				}
				catch (shopify\ApiException $e)
			{
				# HTTP status code was >= 400 or response contained the key 'errors'
				//echo $e;
				print_r($e->getRequest());
				print_r($e->getResponse());
				echo '{"code":100,"msg":"Something went wrong. please try after some time."}';
				exit;
			}
			catch (shopify\CurlException $e)
			{
				# cURL error
				//echo $e;
				//print_r($e->getRequest());
				print_r($e->getResponse());
				echo '{"code":100,"msg":"Something went wrong. please try after some time."}';
				exit;
			}
	
				# HTTP status code was >= 400 or response contained the key 'errors'
				//echo $e;
				print_r($e->getRequest());
				print_r($e->getResponse());
				echo '{"code":100,"msg":"Something went wrong. please try after some time."}';
				exit;
			}
			catch (shopify\CurlException $e)
			{
				# cURL error
				//echo $e;
				//print_r($e->getRequest());
				print_r($e->getResponse());
				echo '{"code":100,"msg":"Something went wrong. please try after some time."}';
				exit;
			}

	
	}

	$content = file_get_contents("php://input");
	$datas = json_decode($content, true);
	//Fetch Tracking ID
	$tracking_ids = $datas['data']['tracking_numbers'][0];
	$tracking_id = '';
	foreach ($tracking_ids as $value) {
		# code...
		$tracking_id .= $value.' , ';
	}

	//Check For canpar
	//$is_canpar = $datas['data']['rate']['shipper_account']['slug'];
	$ref = $datas['data']['references'][0];
	
	updateTracking($ref,$tracking_ids);
	//updateTracking('1004','TestOne146554');

?>