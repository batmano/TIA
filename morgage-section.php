  
                <div class="main">
                    <div class="client_info">
                 <?php 
                        echo 'Hypoteka';
                        getClientsForMorgage();
                        echo '<p> Pocet rokov <select id="morgage_year" class="form-control">';
                        for ($i = 10; $i < 16; $i++){
                            $a = $i*2;
                            echo '<option value='.$a.'>'.$a.'</option>';
                        }
                        echo '</select> </p>';
                        
                        echo '<p> Salary <input type="number"  id="salary" class="form-control"> </p>';

                        echo '<input type="button" value="morgage" id="morgageButton"/>';
                        echo '<div class="client_info">';
                        echo '<h2 id="morgageh2"> </h2>';
                        echo '<p id="maxlimit"></p>';
                        echo '<p id="monthpayment"></p>';
                        echo '<p id="demo"></p>';
                        echo '<p> <input id="createmorgage" type="submit" name="createmorgage"  value="Create morgage"> </p>';
                        echo '</div>';
					?>
                    
                    <script>
                     document.getElementById('createmorgage').style.display = 'none';
                      $('#morgageButton').click(function(){
                          var id = $('#client_morgage option:selected').val();
                          var year = $('#morgage_year option:selected').val();
                          var money1 = $('#client_morgage').find('option:selected').attr('data-othervalue');
                          var maxlimit = money1 * year /3 * 0.53;
                          
                          document.getElementById("morgageh2").innerHTML = 'Vypocet hypoteky';
                          document.getElementById("maxlimit").innerHTML = "Vypocitana vyska hypoteky: " + maxlimit +" €";
                          document.getElementById("monthpayment").innerHTML = 'Mesacna splatka: ' + maxlimit/year*12 +" €";
                          document.getElementById('createmorgage').style.display = 'inline';

                               
                          
                    });

                     $('#createmorgage').click(function(){
                         var idcko = $('#client_morgage option:selected').val();
                          var year = $('#morgage_year option:selected').val();
                          var money1 = $('#client_morgage').find('option:selected').attr('data-othervalue');
                          var maxlimit = money1 * year /3 * 0.53;
                         alert(idcko + "  " + year + "  " + money1 + "  "+ maxlimit);
                            $.ajax({
                                type: "POST",
                                url: "addMorgage.php",
                                data: { 
                                 id : idcko,
                                 amount: maxlimit,
                                 action: $('#createmorgage').val()
                                  }

                                }).done(function( msg ) {
						        alert( "Data Saved: " + msg );
                                }); 

                               
                          
                    });

                    
                    </script>
                                    
					</div>	
						
                </div>

            </div> 
            
             
        </div> <!-- .cd-hero -->
		