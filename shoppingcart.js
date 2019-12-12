$(document).ready(function()
{
	var note; var totalamount =0; var noti=0;
	var today; var invoiceno;
	
	cartnoti();
	showtable();


	// Add Item To localStorage
	$('.addtocart').on('click', function()
	{
		var id = $(this).data('id');
		var name = $(this).data('name');
		var price = $(this).data('price');
		var image = $(this).data('image');
		var qty = 1;

		var cart = localStorage.getItem('cart');

		if (!cart) 
		{
			var cart = '{"mycart":[]}';
		}

		cart = JSON.parse(cart);

		var mycart = cart.mycart;
		length = mycart.length;

		// increase id when id will same
		for(var i=0; i<length; i++)
		{
			if(id == mycart[i].id)
			{
				var exit = 1;
				mycart[i].qty += 1;
			}
		}

		var mylist = {id:id, name:name, price:price, image:image, qty:qty};	

		if(!exit)
		{
			cart.mycart.push(mylist);
		}
							
		cart = JSON.stringify(cart);
		localStorage.setItem('cart',cart);
		cartnoti();

	});

	function cartnoti()
	{
		var cart = localStorage.getItem('cart');
		
		// shopping cart noti
		if (cart) 
		{
			var cartobj = JSON.parse(cart);
			noti = cartobj.mycart.length;

			$('.badge-notify').html(noti);
				
		}
	}

	function showtable()
	{
		// Voucher
		$("#order_div").hide();


		var localstorageitem = localStorage.getItem('cart');
		if (localstorageitem) 
		{
			var localstorageitem = JSON.parse(localstorageitem);
			var mycart = localstorageitem.mycart;

			var mytable ='';
			var subtotal =0; var total=0; var total_tax =0;
			var tax = 25;
			var j=1;
			var count;

			$.each(mycart,function (i,v) 
			{
				if (v) 
				{
					var id = v.id;
					var name = v.name;
					var price = v.price;
					var photo = v.image;
					var qty = v.qty;

					var eachtotal = price * qty;

					mytable +='<tr>'+
					'<td>'+j+'</td>'+
					'<td> <img src='+photo+' class="img-fluid" width="70px" height="70px"> </td>'+
					'<td>'+name+'</td>'+
					'<td>'+
						'<button class="plus_btn btn btn-success btn-sm d-inline" data-id='+i+'> <i class="fas fa-plus fa-sm qty-fa"></i> </button>'+
						'<p id="qty" class="d-inline ml-2 mr-2"> '+ qty +' </p>'+
						'<button class="minus_btn btn btn-success btn-sm d-inline" data-id='+i+'> <i class="fas fa-minus fa-sm qty-fa"></i> </button>'+
					'</td>'+
					'<td>'+price+'</td>'+
					'<td>'+eachtotal+'</td>'+
					'<td> <a href="javascript:void(0)" data-id='+i+' class="remove"> <i class="fas fa-times-circle fa-lg" style="color: red"></i> </a> </td>'+
					'</tr>';
					subtotal += (price*qty);

					total_tax = parseInt(subtotal) + parseInt(tax);

					j++;
				}

			})

			totalamount += total_tax;

			console.log(totalamount);

			mytable +='<tr>'+
							'<td colspan="5" style="text-align: right;"> Subtotal </td>'+
							'<td colspan="5" style="text-align: left;"> '+ subtotal +' </td>'+
					   '</tr>';

			mytable +='<tr>'+
							'<td colspan="5" style="text-align: right;"> Tax </td>'+
							'<td colspan="5" style="text-align: left;"> 5% </td>'+
					   '</tr>';

			mytable +='<tr>'+
							'<td colspan="5" style="text-align: right; font-weight: bolder; color: red; font-size:20px;"> Total Amount:</td>'+
							'<td colspan="2" style="font-weight: bolder; color: red; font-size:20px; text-align:left">'+totalamount+'</td>'+
						'</tr>';

			mytable +='<tr>'+
							'<td colspan="5" class="checkout-tbl">'+
							'<textarea placeholder="Comment..." class="form-control" id="notes" ></textarea>'+
							'</td>'+
							'<td colspan="2" class="checkout-tbl">'+
								'<a href="javascript:void(0)" class="btn btn-success btn-lg" data-tax="5%" data-total="'+total+'" id="checkoutbtn">'+
									'<i class="fas fa-cash-register fa-lg"></i> &nbsp; Check Out' +
								'</a>'+
							'</td>'+
					  '</tr>';

			$('#shoppingcart_table').html(mytable);
		}
	}

	// Add Quantity
	$('#shoppingcart_table').on('click','.plus_btn', function()
	{
		var id = $(this).data('id');
		var localstorageitem = localStorage.getItem('cart');

		var localstorageitem = JSON.parse(localstorageitem);
		var mycart = localstorageitem.mycart;
		
		$.each(mycart,function (i,v) 
		{
			if (i == id) 
			{
				v.qty++;
			}
		})
		
		cart = JSON.stringify(localstorageitem);
		localStorage.setItem('cart',cart);
		showtable();
		cartnoti();

	});

	// Sub Quantity
	$('#shoppingcart_table').on('click','.minus_btn', function()
	{
		var id = $(this).data('id');
		var localstorageitem = localStorage.getItem('cart');

		var localstorageitem = JSON.parse(localstorageitem);
		var mycart = localstorageitem.mycart;
		
		$.each(mycart,function (i,v) 
		{
			if (i == id) 
			{
				v.qty--;
				if (v.qty == 0) 
				{
					mycart.splice(id,1);
				}
			}
		})
		
		cart = JSON.stringify(localstorageitem);
		localStorage.setItem('cart',cart);
		showtable();
		cartnoti();

	});

	// Remove Item
	$('#shoppingcart_table').on('click','.remove', function()
	{
		var id = $(this).data('id');
		var localstorageitem = localStorage.getItem('cart');

		var localstorageitem = JSON.parse(localstorageitem);
		var mycart = localstorageitem.mycart;
		
		$.each(mycart,function (i,v) 
		{
			if (i == id) 
			{
				mycart.splice(id,1);
			}
		})
		
		cart = JSON.stringify(localstorageitem);
		localStorage.setItem('cart',cart);
		showtable();
		cartnoti();

	});


	// Check Out Button
	$('#shoppingcart_table').on('click','#checkoutbtn', function()
	{
		note=$('#notes').val();
		var tax = $(this).data('tax');
		var total = $(this).data('total');

		// alert(note+shipping+tax+total);

		// Voucher
		$("#order_div").show();
		$("#shoppingcart_div").hide();

		datefn();
		vouchertable();

	});

	// Date
	function datefn()
	{
		var now = new Date();
		var months = new Array('January','February','March','April','May','June','July','August','September','October','November','December');
		var date = ((now.getDate()<10) ? "0" : "")+ now.getDate();
		
		function fourdigits(number) 
		{
	    	return (number < 1000) ? number + 1900 : number;
	  	}
	  	today =  months[now.getMonth()] + " " + date + ", " + (fourdigits(now.getYear()));
	  	invoiceno = Date.now();

	  	$('#invoice_number').text(invoiceno);
	  	$('#invoice_date').text(today);
	}

	// Display Voucher with Item From localStroage
	function vouchertable()
	{
		var localstorageitem = localStorage.getItem('cart');
		// var notes = note;

		if (localstorageitem) 
		{
			var localstorageitem = JSON.parse(localstorageitem);
			var mycart = localstorageitem.mycart;

			var tbodytable =''; var foottable='';
			var subtotal =0; var total=0; 
			var tax=25; var total_tax =0;
			var shipping = 2500;
			var j=1;

			$.each(mycart,function (i,v) 
			{
				if (v) 
				{
					var id = v.id;
					var name = v.name;
					var price = v.price;
					var photo = v.image;
					var qty = v.qty;

					console.log("voucherqty - "+qty);

					var eachtotal = price * qty;

					tbodytable +='<tr>'+
					'<td>'+j+'</td>'+
					'<td>'+name+'</td>'+
					'<td>'+price+'</td>'+
					'<td>'+qty +'</td>'+
					'<td>'+eachtotal+'</td>'+
					'</tr>';
					subtotal += (price*qty);

					total_tax = parseInt(subtotal) + parseInt(tax);
					j++;
				}

			})

			total += total_tax;

			console.log(total);

			foottable +='<tr>'+
							'<td colspan="2" rowspan="4">'+
								'<p> NOTES : </p>'+
								'<p> '+note+' </p>'+
							'</td>'+
							'<td colspan="2">'+
								'<p> Subtotal </p>'+
							'</td>'+
							'<td colspan="2">'+
								'<p> '+subtotal+' </p>'+
							'</td>'+
						'</tr>';

			foottable +='<tr>'+
							'<td colspan="2"> Tax </td>'+
							'<td> 5% </td>'+
					   '</tr>';

			foottable +='<tr>'+
							'<td colspan="2" style="color: red; font-size:20px;"> Total Amount:</td>'+
							'<td>'+total+'</td>'+
						'</tr>';

			$('#voucher_tbody').html(tbodytable);
			$('tfoot').html(foottable);

		}

	}


	// Order Confirm
	$('#order').on('click',function()
	{

		console.log("Totalamount "+totalamount);
		console.log("Noti"+noti);

		// var order = confirm('Are You Sure to order? \n Your Total Amount is: '+totalamount);
		swal({
			title: "Are you sure want to order!",   
    		text: "Your Total Amount is:"+totalamount+ "\n Only "+noti+" item(s) in stock",
    		icon: "success",
    		showCancelButton:true,
    		confirmButttonColor : "#32CD32",
    		confirmButttonText : "YES",
    		cancelButtonColor :"#FF0000",
    		cancelButtonText : "NO",
    		closeOnConfirm : false,
    		closeOnCancel : false,
    		buttons: true,
  			dangerMode: true}).then((willDelete)=>{
  				if (willDelete) 
  				{
        			swal("SUCCESS", "Your order has been recorded successfully", "success",{
        				buttons: false,
        				timer : 1500
        			}).then(
	        			function()
	        			{
        					var cart = localStorage.getItem('cart');

        					if (cart) 
        					{
        						var cartobj=JSON.parse(cart);
          						var countitem= cartobj.mycart.length;

          						if(countitem)
          						{
          							var cartarr = cartobj.mycart;
          							var store_date = today;
          							var store_invoiceno = invoiceno;
          							var store_note = note;
          							$.post('storeorder.php',{cartarr:cartarr, invoiceno:store_invoiceno, note:store_note, total:totalamount},function (response) 
          							{
          								localStorage.clear();
										window.location.href='menu';
          							})
          						}
          						else
          						{
          							localStorage.clear();
									window.location.href='menu';
          						}
        					}

        					else
      						{
      							localStorage.clear();
								window.location.href='menu';
      						}
	        				

	        				
	        			}
        			);
  					
  				}
  				else
  				{
            		swal("SORRY", "See you again!", "error",{
        				buttons: false,
        				timer : 1500
        			}).then(
	        				function()
	        				{
		        				localStorage.clear();
								window.location.href='menu';
	        				}
        				);
					
  				}
    		})

    		
			
			
	});










});