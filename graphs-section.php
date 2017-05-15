  
                <div class="main">
                    <div class="client_info">
                        <h1>Grafy</h1><br>
                       <p> Vyberte graf </p>
                            <form action="#" method="post" name="select_graph">
                                <select name="graphtype">
                                    <option value="best_worker">Najlepsi Pracovnik</option>
                                    <option value="best_branch">Najlepsia Pobockak</option>
                                </select>
                            <br>
                            <br>
                            <input type="submit" name="submit" value="Get Selected Values" />

                            </form>
                            <?php
                                if(isset($_POST['submit'])){
                                    create_graph($_POST['graphtype']); 
                                }
                            ?>
                   
					</div>	
						
                </div>

            </div> 
            
             
        </div> <!-- .cd-hero -->
		