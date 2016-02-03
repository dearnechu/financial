<?php 
	include("includes/initialize.php");
 	include(DIR_CLASSES . "order.php");
	require(DIR_CLASSES . "search.php");
	require(DIR_CLASSES . "splitresults.php");

	$perm = array('access_admin','add_order', 'update_order_status');
	checkpermission($perm);
	$tpl = new template();
	$order = new Order();
 	$tpl -> Load(TEMPLATE_PATH . "list_orders.tpl");
	
        if(isset($_GET['action']) AND $_GET['action'] == 1)
        {
            messages(ORDER_DELETE_SUCCESS);
        }
        
	if(isset($_SESSION['message'])) {
		$tpl -> AssignValue("message", $_SESSION['message']);	
	}	

        
        // Delete Order 
        if(isset($_POST['mode']) AND $_POST['mode'] == '_delete_order')
        {
            header('Content-type: application/json');
            
            Query("DELETE FROM `order` WHERE id = '".$_POST['id']."'");
            Query("DELETE FROM order_status WHERE order_id = '".$_POST['id']."'");
            Query("DELETE FROM product_order WHERE order_id = '".$_POST['id']."'");
            
            $data = array('success' => 'yes');
            $output = json_encode($data);
            echo $output;
            exit();           
        }
        
	//hide business associate name
	$bavisibility = '';
	if($_SESSION['utype'] != 'BA') {
		$tpl -> Zone("ba", "enabled");
	}else{
		$tpl -> Zone("ba", "disabled");
		$bavisibility = "AND ba_visibility=1";
	}
	
	//get all status depending on usertype
 	$statusquery = Query("SELECT * FROM `[x]status` where complaint=0 " . $bavisibility);	
	$statusoptions[] = '---Select---';
	while($statusresults = FetchAssoc($statusquery)) {
		$statusoptions[$statusresults["id"]] = $statusresults["status"];
	}
	if(isset($_GET['status']) && $_GET['status'] !='') {
 		$tpl -> AssignValue("select_status", createSelect("status", $statusoptions, $_GET['status'],'class="listmenus" style="width:155px;"'));
	} else {
		$tpl -> AssignValue("select_status", createSelect("status", $statusoptions,'','class="listmenus" style="width:155px;"'));
	}
	
	//Get BA
	$q_user = Query("SELECT u.*, t.* FROM user u, user_roles t WHERE t.roleID REGEXP '^2$' AND u.status REGEXP '1' AND u.id=t.userID");	
	$ba[''] ='Select BA';	
	while($r_user = FetchAssoc($q_user)) {
		$ba[$r_user["id"]] = $r_user["first_name"].' '.$r_user["last_name"];
	}
	if(isset($_GET['ba'])) {
		$tpl -> AssignValue("select_ba", createSelect("ba", $ba, $_GET['ba'], 'class="listmenus" style="width:155px;"'));
	}else{
		$tpl -> AssignValue("select_ba", createSelect("ba", $ba, '', 'class="listmenus" style="width:155px;"'));
	}
	
	if($_SESSION['utype'] != 'BA'){
		$tpl -> Zone("balist", "enabled");
	}

	//conditions based on login
	$extra ='';
	$condition = array();
 	if($_SESSION['utype'] == 'BA') {
		 $condition['o.created_by'] =$_SESSION['id'];	
		 $extra =" AND o.created_by = {$_SESSION['id']}";		
	}else if($_SESSION['utype'] == 'AM'){
		 $condition['u.area_id'] =$_SESSION['areaid'];
		 $extra =" AND u.area_id = {$_SESSION['areaid']}";
	}else if($_SESSION['utype'] == 'ZH'){
		 $condition['u.zone_id'] =$_SESSION['zoneid'];	
		 $extra =" AND u.zone_id = {$_SESSION['zoneid']}";		
	}
	
        $statusflag = '';
	
	if(isset($_GET['submit'])) {
	//search case	
		$extracondition = '';
		if(isset($_GET['q'])) {
			$tpl -> AssignValue("name", $_GET['q']);
		}	
		$searchFields = "o.order_no";
		
		if($_GET['from']!='' && $_GET['to'] !='') {
			$tpl -> AssignValue("from", $_GET['from']);
			$tpl -> AssignValue("to", $_GET['to']);
			$from = date('Y-m-d', strtotime($_GET['from']));
 			$to = date('Y-m-d', strtotime($_GET['to']));
 			$extracondition .=" DATE_FORMAT(o.created_date, '%Y-%m-%d') >=  '".$from."' AND DATE_FORMAT(o.created_date, '%Y-%m-%d') <=  '".$to."'";
		}
		
		$condition['u.status'] =1; 		
		
		if($_GET['status']!='' && $_GET['status']!=0) {
			 $condition['os.status'] = '^' .  $_GET['status'] . '$';	
		}
 		if(isset($_GET['ba']) && $_GET['ba']!=0) {
			 $condition['u.id'] = '^' .  $_GET['ba'] . '$';	
		}
		if(isset($_GET['type']) && $_GET['type']=='all'){
			$extracondition .= " AND os.status !=11";
		}
		if(isset($_GET['type']) && $_GET['type']=='fulfilled'){
			$extracondition .= " AND os.status >=8 AND os.status <=10 AND os.status !=11";
		}
		//search query
	  
          $statusCondition = ' and o.status = 1';         
          if($_SESSION['rid'] == 2)
          {
              $statusCondition = '';
              $statusflag = ' o.status, ';
          }
	  $s = new search($searchFields, $condition, $extracondition);		
	  $query = "Select o.id, o.order_no,$statusflag u.first_name, DATE_FORMAT(o.created_date , ".SHORT_DATE_WITHTIME." ) as order_date,o.credit, o.created_by From (Select order_id,MAX(current_status) as status from order_status group by order_id) os INNER JOIN `order` o ON o.id = os.order_id INNER JOIN `user` u ON u.id=o.created_by". $s->query. " $statusCondition ORDER BY o.id desc";
	  
	$tpl -> AssignValue("qry",$query);	
	} else {	
	//else case	 
         $statusCondition = 'and o.status = 1';
         if($_SESSION['rid'] == 2)
         {
             $statusCondition = '';
             $statusflag = ' o.status, ';
         }         
	 $query= "SELECT o.id, o.order_no,$statusflag u.first_name, DATE_FORMAT(o.created_date , ".SHORT_DATE_WITHTIME." ) as order_date,o.credit, o.created_by FROM `[x]order` o ,`[x]user` u  WHERE o.created_by = u.id " . $extra . " $statusCondition ORDER BY o.id desc";
	
         $tpl -> AssignValue("qry",$query);
	}
	

 	$q = new splitResults($query);
	$orders []= '';
	if(isset($_GET['page']) && $_GET['page'] !=1) {
		$i=(($_GET['page']-1)*10)+1;
	}else{
		$i=1;
	}
        $count = 0;
	if(Num($q->out)) {
		$tpl -> Zone("export", "enabled");
		while($r=FetchAssoc($q->out)){
			$r['slno'] = $i;
			if($i%2 ==0) {
				$r['class'] = "two";
			}else {
				$r['class'] = "one";
			}
                        
			$r['fname'] = $order->getordermadeby($r['id'],'name');
			$status = $order->getstatusname($order->getcurrentorderstatus($r['id']));
			$order_status =$order->getcurrentorderstatus($r['id']);
			if($order_status==8||$order_status==9||$order_status==10){
			$r['display'] = "block";
			}else{
			$r['display'] = "none";
			}
			$r['currentstatus'] = $status['status'];
                        
                        $r['statusflag'] = '';
                        //$tpl -> Zone("editoption", "disabled");
                        if($_SESSION['rid'] == 2)
                        {
                            //$tpl -> Zone("editoption", "enabled");
                            $count++;
                            $r['statusflag'] = '&a=1';
                            if($r['status'] == 0)
                            {
                                //$r['class'] = "inactive";
                                $r['currentstatus'] = 'Draft';
                                $r['statusflag'] = '&a=0';
                                
                                $r['edit'] = '<a href="edit_order.php?id='.$r['id'].$r['statusflag'].'">Edit</a> / <a href="javascript:void(0);" onclick="deleteOrder('.$r['id'].')" >Delete</a>';
                            }
                            else
                            {
                                list($access, $confirm) = $order->checkTimeLeft($r['id'], 2);
                                if($access == 'yes' AND $confirm == 'yes' AND $_SESSION['rid'] == 2)
                                {
                                    $r['edit'] = '<a href="edit_order.php?id='.$r['id'].$r['statusflag'].'">Edit</a>';
                                    //$tpl -> Zone("editoption", "enabled");

                                    if($order->getcurrentorderstatus($r['id']) != 1)
                                    {
                                        $r['edit'] = '&nbsp;';
                                    }  
                                    
                                    
                                }
                                else
                                {
                                    $count--;
                                    $r['edit'] = '&nbsp;';
                                    //$tpl -> Zone("editoption", "disabled");
                                }                                
                            }
                        }
			$orders[] = $r;
			$i++;
		}
		
                if($count == 0)
                {
                    $tpl -> Zone("editoption", "disabled");
                }
                else
                {
                   $tpl -> Zone("editoption", "enabled"); 
                }
		$tpl -> AssignValue("start", $q->start);
		$tpl -> AssignValue("end", $q->end);
		$tpl -> AssignValue("total", $q->total);
		$tpl -> AssignValue("split_results", $q->show());
 			
	 }else{
		  $tpl -> Zone("noorders", "enabled");
		  $tpl -> Zone("export", "disabled");
		  $tpl -> AssignValue("total", '0');
	 }
	
	$tpl -> Loop("orders", $orders);
	$tpl -> CleanTags();
	$tpl -> CleanZones();
	LoadFrame($tpl -> Flush(1));
?>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.ui.core.js"></script>
<script type="text/javascript" src="js/jquery.ui.widget.js"></script>
<script type="text/javascript" src="js/jquery.ui.datepicker.js"></script>
<script type="text/javascript" src="js/thickbox.js"></script>
<script type="text/javascript">
$(function() {
			   
		var dates = $('#fromdate, #todate').datepicker({
 			dateFormat: 'dd-mm-yy',
			changeMonth: true,
			numberOfMonths: 1,
			disabled: true,
			onSelect: function(selectedDate) {
				var option = this.id == "fromdate" ? "minDate" : "maxDate";
				var instance = $(this).data("datepicker");
				var date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
				dates.not(this).datepicker("option", option, date);
			}
		});
	});
	
	$('.orderreport').click(function() {
		//alert("report");
		var qry 	= $("#qry").val();
		
			document.location.href ='export_order.php?qry='+qry ;
	 });

    function deleteOrder(id)
    {
        var params = {mode : '_delete_order', id : id};
        
        if(confirm("Are you sure to delete this Order? Press OK to continue."))
        {
            $.ajax({
                type : 'POST',
                url  : 'list_orders.php',
                data : params,
                dataType : 'json',
                success  : function(data)
                {
                    if(data.success == 'yes')
                    {
                        redirect('list_orders.php?action=1');
                    }
                }
            });
        }
    }

</script>