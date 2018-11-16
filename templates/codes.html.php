

			<div class="main-content">
				<div class="main-content-inner">
						<div class="page-content">
						<!-- /.ace-settings-container -->

						<!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								<!-- /.row -->

								<div class="row">
									<div class="col-xs-12">
										<h3 class="header smaller lighter blue"><strong>Coupons</strong></h3>
										
											<?php if(isset($add_message) && $add_message!= '')
												echo $add_message 
												 ;?>
										<div class="clearfix">
											<a href="<?php echo Request::$BASE_PATH.'codes/new_code';?>">
												<button class="btn btn-success"><i class="ace-icon fa fa-plus"></i> Add Coupon</button>
											</a>
											<a href="<?php echo Request::$BASE_PATH.'import/';?>">
												<button class="btn btn-purple"><i class="ace-icon fa fa-cloud-upload"></i>Upload</button>
											</a>
											<div class="pull-right tableTools-container"> </div>
										</div>
										<div class="table-header">
											All Coupons
										</div>

										<!-- div.table-responsive -->

										<!-- div.dataTables_borderWrap -->
										<div>
										
											<table id="dynamic-table" class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
<!-- 														<th class="center"> -->
<!-- 															<label class="pos-rel"> -->
<!-- 																<input type="checkbox" class="ace" /> -->
<!-- 																<span class="lbl"></span> -->
<!-- 															</label> -->
<!-- 														</th> -->
														<th class="center">ID's</th>
														<th class="center">Name</th>
                                                        <th class="center">Detail</th>
                                                        <th class="center">Code</th>
                                                        <th class="center">Coupon Types</th>
                                                        <th class="center">Stores</th>
                                                        <th class="center">URL'S</th>
                                                        <th class="center">Categories</th>
                                                        <th class="center">Rank</th>
                                                        <th class="center">Spam</th>
                                                        <th class="center">Active Dates</th>
                                                        <th class="center">Expire Dates</th>
                                                        <th>Actions</th>
													</tr>
												</thead>

												<tbody>
													
													<?php 
													if($objall)
														foreach($objall as $key){ ?>
													<tr>
<!-- 														<td class="center"> -->
<!-- 															<label class="pos-rel"> -->
<!-- 																<input type="checkbox" class="ace" /> -->
<!-- 																<span class="lbl"></span> -->
<!-- 															</label> -->
<!-- 														</td> -->
														<td class="center">
															<?php echo $key->id ;?>
														</td>
														<td class="center">
															<?php echo $key->name ;?>
														</td>
                                                        <td class="center">
                                                            <?php echo substr($key->detail,0,30).'..' ;?>
                                                        </td>
                                                        <td class="center">
                                                            <?php echo $key->code ;?>
                                                        </td>
                                                        <td class="center">
                                                            <?php echo $key->type ;?>
                                                        </td>
                                                        <td class="center">
                                                            <?php echo $key->store ;?>
                                                        </td>
                                                        <td class="center">
                                                            <?php echo $key->address ;?>
                                                        </td>
                                                        <td class="center">
                                                            <?php echo $key->category ;?>
                                                        </td>

														<td class="center">
                                                            <?php echo $key->rank ;?>
                                                        </td>
                                                        <td class="center">
                                                            <?php if($key->spam=='1'){echo 'Yes' ;}else{echo 'No';}?>
                                                        </td>
                                                        <td class="center">
                                                            <?php echo $key->active_date ;?>
                                                        </td>
                                                        <td class="center">
                                                            <?php echo $key->expire_date ;?>
                                                        </td>


														<td>
															<div class="action-buttons">

																<a class="red" href="#"></a>
																	<i id="<?php echo $key->id; ?>"  class="ace-icon fa fa-trash-o bigger-130 bootbox-confirm"></i>
																	<a href="<?php echo Request::$BASE_PATH.'codes/edit_code/'.$key->id ?>">
																		<i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
																	</a>
																	 <a href="<?php echo Request::$BASE_PATH.'ranking/'.$key->store_id ?>">
                                                                        <i class="ace-icon fa fa-eye bigger-120"></i>
                                                                    </a>
															</div>
															
															

														</td>
													</tr>
														<?php } ?>
												</tbody>
											</table>
										</div>
									</div>
								</div>

								

								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->
			
			
			
			
			
			<script src="<?php echo Request::$BASE_PATH; ?>assets/js/jquery.dataTables.min.js"></script>
			<script src="<?php echo Request::$BASE_PATH; ?>assets/js/jquery.dataTables.bootstrap.min.js"></script>
			<script src="<?php echo Request::$BASE_PATH; ?>assets/js/dataTables.buttons.min.js"></script>
			<script src="<?php echo Request::$BASE_PATH; ?>assets/js/buttons.flash.min.js"></script>
			<script src="<?php echo Request::$BASE_PATH; ?>assets/js/buttons.html5.min.js"></script>
			<script src="<?php echo Request::$BASE_PATH; ?>assets/js/buttons.print.min.js"></script>
			<script src="<?php echo Request::$BASE_PATH; ?>assets/js/buttons.colVis.min.js"></script>
			<script src="<?php echo Request::$BASE_PATH; ?>assets/js/dataTables.select.min.js"></script>
			<script src="<?php echo Request::$BASE_PATH; ?>assets/js/jquery-ui.custom.min.js"></script>
    		<script src="<?php echo Request::$BASE_PATH; ?>assets/js/jquery.ui.touch-punch.min.js"></script>
    		<script src="<?php echo Request::$BASE_PATH; ?>assets/js/jquery.gritter.min.js"></script>
    		<script src="<?php echo Request::$BASE_PATH; ?>assets/js/bootbox.js"></script>
    		<script src="<?php echo Request::$BASE_PATH; ?>assets/js/jquery.easypiechart.min.js"></script>
    		<script src="<?php echo Request::$BASE_PATH; ?>assets/js/bootstrap-datepicker.min.js"></script>
    		<script src="<?php echo Request::$BASE_PATH; ?>assets/js/jquery.hotkeys.index.min.js"></script>
    		<script src="<?php echo Request::$BASE_PATH; ?>assets/js/bootstrap-wysiwyg.min.js"></script>
    		<script src="<?php echo Request::$BASE_PATH; ?>assets/js/select2.min.js"></script>
    		<script src="<?php echo Request::$BASE_PATH; ?>assets/js/spinbox.min.js"></script>
    		<script src="<?php echo Request::$BASE_PATH; ?>assets/js/bootstrap-editable.min.js"></script>
    		<script src="<?php echo Request::$BASE_PATH; ?>assets/js/ace-editable.min.js"></script>
    		<script src="<?php echo Request::$BASE_PATH; ?>assets/js/jquery.maskedinput.min.js"></script>
			
			<script type="text/javascript">
			jQuery(function($) {
				//initiate dataTables plugin
				var myTable = 
				$('#dynamic-table')
				//.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
				.DataTable( {
					bAutoWidth: false,
					"aaSorting": [],
					
					
					//"bProcessing": true,
			        //"bServerSide": true,
			        //"sAjaxSource": "http://127.0.0.1/table.php"	,
			
					//,
					//"sScrollY": "200px",
					//"bPaginate": false,
			
					"sScrollX": "100%",
					//"sScrollXInner": "120%",
					//"bScrollCollapse": true,
					//Note: if you are applying horizontal scrolling (sScrollX) on a ".table-bordered"
					//you may want to wrap the table inside a "div.dataTables_borderWrap" element
			
					//"iDisplayLength": 50
			
			
					select: {
						style: 'single'
					}
			    } );
			
				
				
				$.fn.dataTable.Buttons.defaults.dom.container.className = 'dt-buttons btn-overlap btn-group btn-overlap';
				
				new $.fn.dataTable.Buttons( myTable, {
					buttons: [
					  {
						"extend": "colvis",
						"text": "<i class='fa fa-search bigger-110 blue'></i> <span class='hidden'>Show/hide columns</span>",
						"className": "btn btn-white btn-primary btn-bold",
						columns: ':not(:first):not(:last)'
					  },
					  {
						"extend": "copy",
						"text": "<i class='fa fa-copy bigger-110 pink'></i> <span class='hidden'>Copy to clipboard</span>",
						"className": "btn btn-white btn-primary btn-bold"
					  },
					  {
						"extend": "csv",
						"text": "<i class='fa fa-database bigger-110 orange'></i> <span class='hidden'>Export to CSV</span>",
						"className": "btn btn-white btn-primary btn-bold"
					  },
					  {
						"extend": "excel",
						"text": "<i class='fa fa-file-excel-o bigger-110 green'></i> <span class='hidden'>Export to Excel</span>",
						"className": "btn btn-white btn-primary btn-bold"
					  },
					  {
						"extend": "pdf",
						"text": "<i class='fa fa-file-pdf-o bigger-110 red'></i> <span class='hidden'>Export to PDF</span>",
						"className": "btn btn-white btn-primary btn-bold"
					  },
					  {
						"extend": "print",
						"text": "<i class='fa fa-print bigger-110 grey'></i> <span class='hidden'>Print</span>",
						"className": "btn btn-white btn-primary btn-bold",
						autoPrint: false,
						message: 'This print was produced using the Print button for DataTables'
					  }		  
					]
				} );
				myTable.buttons().container().appendTo( $('.tableTools-container') );
				
				//style the message box
				var defaultCopyAction = myTable.button(1).action();
				myTable.button(1).action(function (e, dt, button, config) {
					defaultCopyAction(e, dt, button, config);
					$('.dt-button-info').addClass('gritter-item-wrapper gritter-info gritter-center white');
				});
				
				
				var defaultColvisAction = myTable.button(0).action();
				myTable.button(0).action(function (e, dt, button, config) {
					
					defaultColvisAction(e, dt, button, config);
					
					
					if($('.dt-button-collection > .dropdown-menu').length == 0) {
						$('.dt-button-collection')
						.wrapInner('<ul class="dropdown-menu dropdown-light dropdown-caret dropdown-caret" />')
						.find('a').attr('href', '#').wrap("<li />")
					}
					$('.dt-button-collection').appendTo('.tableTools-container .dt-buttons')
				});
			
				////
			
				setTimeout(function() {
					$($('.tableTools-container')).find('a.dt-button').each(function() {
						var div = $(this).find(' > div').first();
						if(div.length == 1) div.tooltip({container: 'body', title: div.parent().text()});
						else $(this).tooltip({container: 'body', title: $(this).text()});
					});
				}, 500);
				
				
				
				
				
				myTable.on( 'select', function ( e, dt, type, index ) {
					if ( type === 'row' ) {
						$( myTable.row( index ).node() ).find('input:checkbox').prop('checked', true);
					}
				} );
				myTable.on( 'deselect', function ( e, dt, type, index ) {
					if ( type === 'row' ) {
						$( myTable.row( index ).node() ).find('input:checkbox').prop('checked', false);
					}
				} );
			
			
			
			
				/////////////////////////////////
				//table checkboxes
				$('th input[type=checkbox], td input[type=checkbox]').prop('checked', false);
				
				//select/deselect all rows according to table header checkbox
				$('#dynamic-table > thead > tr > th input[type=checkbox], #dynamic-table_wrapper input[type=checkbox]').eq(0).on('click', function(){
					var th_checked = this.checked;//checkbox inside "TH" table header
					
					$('#dynamic-table').find('tbody > tr').each(function(){
						var row = this;
						if(th_checked) myTable.row(row).select();
						else  myTable.row(row).deselect();
					});
				});
				
				//select/deselect a row when the checkbox is checked/unchecked
				$('#dynamic-table').on('click', 'td input[type=checkbox]' , function(){
					var row = $(this).closest('tr').get(0);
					if(this.checked) myTable.row(row).deselect();
					else myTable.row(row).select();
				});
			
			
			
				$(document).on('click', '#dynamic-table .dropdown-toggle', function(e) {
					e.stopImmediatePropagation();
					e.stopPropagation();
					e.preventDefault();
				});
				
				
				
				//And for the first simple table, which doesn't have TableTools or dataTables
				//select/deselect all rows according to table header checkbox
				var active_class = 'active';
				$('#simple-table > thead > tr > th input[type=checkbox]').eq(0).on('click', function(){
					var th_checked = this.checked;//checkbox inside "TH" table header
					
					$(this).closest('table').find('tbody > tr').each(function(){
						var row = this;
						if(th_checked) $(row).addClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', true);
						else $(row).removeClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', false);
					});
				});
				
				//select/deselect a row when the checkbox is checked/unchecked
				$('#simple-table').on('click', 'td input[type=checkbox]' , function(){
					var $row = $(this).closest('tr');
					if($row.is('.detail-row ')) return;
					if(this.checked) $row.addClass(active_class);
					else $row.removeClass(active_class);
				});
			
				
			
				/********************************/
				//add tooltip for small view action buttons in dropdown menu
				$('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
				
				//tooltip placement on right or left
				function tooltip_placement(context, source) {
					var $source = $(source);
					var $parent = $source.closest('table')
					var off1 = $parent.offset();
					var w1 = $parent.width();
			
					var off2 = $source.offset();
					//var w2 = $source.width();
			
					if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
					return 'left';
				}
				
				
				
				
				/***************/
				$('.show-details-btn').on('click', function(e) {
					e.preventDefault();
					$(this).closest('tr').next().toggleClass('open');
					$(this).find(ace.vars['.icon']).toggleClass('fa-angle-double-down').toggleClass('fa-angle-double-up');
				});
				/***************/
				
				
				
			

				
				
				/**
				//add horizontal scrollbars to a simple table
				$('#simple-table').css({'width':'2000px', 'max-width': 'none'}).wrap('<div style="width: 1000px;" />').parent().ace_scroll(
				  {
					horizontal: true,
					styleClass: 'scroll-top scroll-dark scroll-visible',//show the scrollbars on top(default is bottom)
					size: 2000,
					mouseWheelLock: true
				  }
				).css('padding-top', '12px');
				*/
			
			
			})
		</script>
			
			
			<script src="<?php echo Request::$BASE_PATH.'assets/js/bootbox.js'; ?>"></script>
			<script>
					$(".bootbox-confirm").click(function() {
						var Self = $(this);
						bootbox.confirm("Are you sure! you wanted to delete this ?", function(result) {
							if(result) {
								$.post("<?php echo Request::$BASE_PATH.'codes/delete_code/' ?>", {
				 					id: Self.attr('id'),
				 					}).done(function(data,status){
					 			      if(status=='success'){
					 			      	
					 			    	 Self.closest("tr").remove();
					 			      }else{
					 			    	 alert('Error in remove User');
					 			      }
						 		});
							}
						});
					});
					
				/**
					$("#bootbox-confirm").on(ace.click_event, function() {
						bootbox.confirm({
							message: "Are you sure?",
							buttons: {
							  confirm: {
								 label: "OK",
								 className: "btn-primary btn-sm",
							  },
							  cancel: {
								 label: "Cancel",
								 className: "btn-sm",
							  }
							},
							callback: function(result) {
								if(result) alert(1)
							}
						  }
						);
					});
					
					
				**/

				
			</script>
			