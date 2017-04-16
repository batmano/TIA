
<?php
$zobraz = false;
if (isset($_GET['id'])){
	if ($udaje = get_employee($_GET['id'])) {
		$zobraz = true;
		$button = "Save";
		//echo $udaje['branch_id'];
		//echo $udaje['position_id'];
	}
	
}
?>
           
                <div class="main">
                    <form action="#" method="post" id="EmployeeForm">

				<fieldset>
					<legend><?php echo $section_name; ?> </legend>
					<div class="form-group agileinfo">
						<label for="FirstName">First Name</label>
						<input id="FirstName" type="text" value="<?php if ($zobraz) echo $udaje['first_name']; ?>" class="form-control"  placeholder="..." required>
					</div>
					<div class="form-group">
						<label for="LastName">Last Name</label>
						<input id="LastName" type="text" value="<?php if ($zobraz) echo $udaje['last_name']; ?>" class="form-control" placeholder="..." required>
					</div>
				</fieldset>


				<fieldset class="form-horizontal" role="form">
					<legend></legend>
					
					<div class="form-group">
						<label for="Position" class="col-sm-2 w3-agileits control-label">Position</label>
						<div class="col-sm-6">
							
							<?php 
								if ($zobraz) getPosition( $udaje['position_id']); 
								else getPosition(1);
							?>
						</div>
					</div>
                    <br>
                    <br>
					
					<div id = 'employee_futher_info' class="form-group">
						<label for="Branch" class="col-sm-2 w3-agileits control-label">Branch</label>
						<div class="col-sm-6">
							<?php 
								if ($zobraz) getBranches( $udaje['branch_id']); 
								else getBranches(1);
							?>
						</div>
					</div>
				</fieldset>
				
                <fieldset>
					<button id="SaveButtonEmployee" class="testo" value="<?php echo $button; ?>"><?php echo $button; ?> </button>
                </fieldset>

			</form>
                </div>

            </div> 
            
             
        </div> <!-- .cd-hero -->
		<script>

		$(document).ready(function(){
			$('.testo').click(function(){
					if( !$('#FirstName').val() ||  !$('#LastName').val() ) {
					alert("Nevyplnene vsetky potrebne polia");
				}
				else{	
					var idcko = "<?php if ($zobraz) echo  $udaje['employee_id']; else echo -9999; ?>";
					$.ajax({
						type: "POST",
						url: "CU_employee.php",
						data: { 
								 eid : idcko,
								 fn: $('#FirstName').val() ,
                                 ln: $('#LastName').val(),
                                 branch: $('#Branch option:selected').val(),
                                 pos: $('#Position option:selected').val(),
                                 action:$('.testo').val()
                                  }
						}).done(function( msg ) {
						alert( "Data Saved: " + msg );
						});    
				}
			});

		});

	</script>