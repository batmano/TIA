  
                <div class="main">
                    <div class="client_info">
                 <?php 
                     if (isset($_GET['id'])){
                         $row =get_client($_GET['id']);
                        echo 'Meno: <h2 >'.$row['first_name'].' '.$row['last_name'].'</h2><br>';
                        echo '<p>Suma transakcie (max '.$row['current_amount'].' eur):  <input type="number" min="0" style="width: 5em;" 
                        max="'.$row['current_amount'].'" step="1" id="amount_tran" required="required" size = "10"></p>';
                        getClientsForTransaction($_GET['id']);
                        echo '<p> <input id="sendmoney" type="submit" name="sendmoney"  value="Send"> </p>';
                     }else{
                         echo '<h1> nemate vybraneho klienta </h1>';
                     }
						
					?>
                    
                    <script>
                     
                      $('#sendmoney').click(function(){
                          var max = <?php echo $row['current_amount'] ;?>;
                          var value = $('#amount_tran').val()
                          if( value > max || value < 0 || value == ''){
                                alert('Zle zadana suma');
                          } else{
                              
                            var idcko = "<?php  echo $_GET['id'] ?>";
                            var edcko = "<?php  echo $_SESSION['login']?>";
                            var pri = $('#Recevier option:selected').val();
                            var am = $('#amount_tran').val();

                            alert(am);
                            $.ajax({
                                type: "POST",
                                url: "addTran.php",
                                data: { 
                                 id : idcko,
                                 eid: edcko,
                                 rec: pri,
                                 amount: am,
                                 action:$('#sendmoney').val()
                                  }

                                }).done(function( msg ) {
						        alert( "Data Saved: " + msg );
                                });    
                            }
                        
                    });
                    </script>
                                    
					</div>	
						
                </div>

            </div> 
            
             
        </div> <!-- .cd-hero -->
		