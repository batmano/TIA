
<?php
session_start();

function spoj_s_db() {
	if ($link = mysql_connect('localhost', 'root', 'usbw')) {
		if (mysql_select_db('tia', $link)) {
			mysql_query("SET CHARACTER SET 'utf8'", $link); 
			return $link;
		} else {
			// NEpodarilo sa vybrať databázu!
			return false;
		}
	} else {
		// NEpodarilo sa spojiť s databázovým serverom!
		return false;
	}
}

/////////////////////////////////////////////////////////////////




function ponuka() {
if ($link = spoj_s_db()) {
    $search = False;
    if (isset($_GET['id'])){
        $search = $_GET['id'];                                                 
       $sql = "SELECT * FROM CLIENT WHERE client_id = $search";
    }
    else
      { $sql = "SELECT * FROM CLIENT WHERE client_id <> -1 "; }
 
                                                                                            
	$result = mysql_query($sql, $link);
	if ($result) {
    if (mysql_num_rows($result) == 0){
      echo "<br> <p >Ziaden klient :( </p>";
      }
    else{
		if ($search){
      echo '<p class="neni_film1">Nájdené výsledky pre zadaný názov filmu --> '.$search.' <-- :)</p>';
    }
	  echo ' <table>
						<tr>
							<th>ID</th>
							<th>Meno</th>
							<th>Priezvisko</th>
							<th> CLICK for UPDATE </th>
						</tr>';
	  while ($row = mysql_fetch_assoc($result)) {
      $pom = "http://$_SERVER[HTTP_HOST]/tia/"."newclient.php"."?id=". $row['client_id'];
      $pom2 = "http://$_SERVER[HTTP_HOST]/tia/"."clients_info.php"."?id=". $row['client_id'];
      $pom3 = "http://$_SERVER[HTTP_HOST]/tia/"."tran.php"."?id=". $row['client_id'];
	  echo '<tr><td>'. $row['client_id'].'</td>';
      echo '<td>'. $row['first_name'].'</td>';
      echo '<td>'. $row['last_name'].'</td>';
      echo '<td>
	  <input type="button" value="Update" 
	  onclick="location.href='."'".$pom."'". ';"/>
	  <input type="button" value="Info" 
	  onclick="location.href='."'".$pom2."'". ';"/>
	  <input type="button" value="Transakcia" 
	  onclick="location.href='."'".$pom3."'". ';"/>
	  </td>';
      echo '<tr>';
      // <input type="button" class="button_active" onclick="location.href='1.html';" />
	           }
	  echo '</table>';
      }
      
	  mysql_free_result($result);
	} else {
		// NEpodarilo sa vykonať dopyt!
		echo '<p class="chyba">NEpodarilo sa vykonať dopyt!</p>';
	     }
	mysql_close($link);
} else {
	// NEpodarilo sa spojiť s databázovým serverom!
	echo '<p class="chyba">NEpodarilo sa spojiť s databázovým serverom!</p>';
        }
}

function ponukaEmployees() {
if ($link = spoj_s_db()) {
    $search = False;
    if (isset($_GET['id'])){
        $search = $_GET['id'];                                                 
       $sql = "SELECT e.*, p.position_name, b.name FROM EMPLOYEE e
	   		JOIN POSITION p ON p.position_id = e.position_id
	   		JOIN BRANCH b ON b.branch_id = e.branch_id
	   	WHERE e.employee_id = $search";
    }
    else
      { $sql = "SELECT e.*, p.position_name, b.name FROM EMPLOYEE e
	   		JOIN POSITION p ON p.position_id = e.position_id
	   		JOIN BRANCH b ON b.branch_id = e.branch_id"; }
 
                                                                                            
	$result = mysql_query($sql, $link);
	if ($result) {
    if (mysql_num_rows($result) == 0){
      echo "<br> <p >Ziaden zamnestananec :( </p>";
      }
    else{
		if ($search){
      echo '<p>:(</p>';
    }
	  echo ' <table>
						<tr>
							<th>ID</th>
							<th>Meno</th>
							<th>Priezvisko</th>
							<th> Pozicia </th>
							<th> Pobocka </th>
						</tr>';
	  while ($row = mysql_fetch_assoc($result)) {
      $pom = "http://$_SERVER[HTTP_HOST]/tia/"."employees.php"."?id=". $row['employee_id'];
      $pom2 = "http://$_SERVER[HTTP_HOST]/tia/"."deleteemployee.php"."?id=". $row['employee_id'];
	  echo '<tr><td>'. $row['employee_id'].'</td>';
      echo '<td>'. $row['first_name'].'</td>';
      echo '<td>'. $row['last_name'].'</td>';
      echo '<td>'. $row['position_name'].'</td>';
      echo '<td>'. $row['name'].'</td>';
      echo '<td>
	  <input type="button" value="Update" 
	  onclick="location.href='."'".$pom."'". ';"/>
	  <input type="button" value="Delete" 
	  onclick="location.href='."'".$pom2."'". ';"/>
	  </td>';
      echo '</tr>';
      // <input type="button" class="button_active" onclick="location.href='1.html';" />
	           }
	  echo '</table>';
      }
      
	  mysql_free_result($result);
	} else {
		// NEpodarilo sa vykonať dopyt!
		echo '<p class="chyba">NEpodarilo sa vykonať dopyt!</p>';
	     }
	mysql_close($link);
} else {
	// NEpodarilo sa spojiť s databázovým serverom!
	echo '<p class="chyba">NEpodarilo sa spojiť s databázovým serverom!</p>';
        }
}

function showinfo($id) {
if ($link = spoj_s_db()) {
	
	$sql = "SELECT c.first_name, c.last_name, c.current_amount, count(t.transaction_id) as countT, 
	case when sum(t.amount) is null then 0 else
	sum(t.amount) end as sumA , count(distinct pd.sale_id) countP, 
	
	case when count(pd2.sale_id) = 0 then 'NIE' else 'ANO' end as hypo
			FROM CLIENT c 

			left join Transactions t on
				t.client_id = c.client_id
			left join Product_sold pd on
				c.client_id = pd.client_id
			left join Product_sold pd2 on
				c.client_id = pd2.client_id and pd2.product_id = 3

			WHERE c.client_id = $id
			group by c.first_name, c.last_name, c.current_amount";   

	$result = mysql_query($sql, $link);
	if ($result) {
		if (mysql_num_rows($result) == 0){
			echo "<br> <p >Ziaden klient :( </p>";
		}
		else{
			$row = mysql_fetch_assoc($result);
			echo '<div class="client_info">
              <h2 >'.$row['first_name'].' '.$row['last_name'].'</h2><br>
              <p> Pocet transakcii: '.$row['countT'].' </p>
			  <p> Aktualny stav uctu: '.$row['current_amount'].' €</p>
			  <p> Celkova suma transakcii: '.$row['sumA'].' €</p>
			  <p> Pocet produktov: '.$row['countP'].'</p>
			  <p> Ma hypoteku: '.$row['hypo'].'</p>
			  </div>';
			
		} 
	}
} else {
	// NEpodarilo sa spojiť s databázovým serverom!
	echo '<p class="chyba">NEpodarilo sa spojiť s databázovým serverom!</p>';
        }
}



function getBranches($sel) {
if ($link = spoj_s_db()) {
	
	$sql = "SELECT * FROM BRANCH";   

	$result = mysql_query($sql, $link);
	if ($result) {
		if (mysql_num_rows($result) == 0){
			echo "<p> Ziadne pobocky, chyba v databaze</p>";
		}
		else{
			echo '<select id="Branch" class="form-control">';
				while ($row = mysql_fetch_assoc($result)) {	
					if ($row['branch_id']== $sel){
						echo '<option value='.$row['branch_id'].  ' selected="selected"'.'>'.$row['name'].'</option>';
					}
					else echo '<option value='.$row['branch_id'].' >'.$row['name'].'</option>';
							
				}
				echo '</select>';
		} 
	}
} else {
	// NEpodarilo sa spojiť s databázovým serverom!
	echo '<p class="chyba">NEpodarilo sa spojiť s databázovým serverom!</p>';
        }
}

function getClientsForTransaction($id) {
if ($link = spoj_s_db()) {
	
	$sql = "SELECT * FROM CLIENT WHERE client_id not in (-1,$id);";   

	$result = mysql_query($sql, $link);
	if ($result) {
		if (mysql_num_rows($result) == 0){
			echo "<p> Mate len 1 klienta</p>";
		}
		else{
			echo '';
			echo '<p> Receiver <select id="Recevier" class="form-control">';
				while ($row = mysql_fetch_assoc($result)) {	
					$meno = $row['first_name']. ' '.$row['last_name'];
					echo '<option value='.$row['client_id'].' >'.$meno.'</option>';
							
				}
				echo '</select></p>';
		} 
	}
} else {
	// NEpodarilo sa spojiť s databázovým serverom!
	echo '<p class="chyba">NEpodarilo sa spojiť s databázovým serverom!</p>';
        }
}


function deleteEmployee($sel) {
if ($link = spoj_s_db()) {
	
	$sql = "DELETE FROM EMPLOYEE WHERE employee_id=$sel ;";   

	$result = mysql_query($sql, $link);
	if ($result) {
			echo 'Zamestnanec zmazany';
	}
} else {
	
	echo '<p class="chyba">NEpodarilo sa spojiť s databázovým serverom!</p>';
        }
}

function getPosition($sel) {
if ($link = spoj_s_db()) {
	
	$sql = "SELECT * FROM POSITION";   

	$result = mysql_query($sql, $link);
	if ($result) {
		if (mysql_num_rows($result) == 0){
			echo "<p> Ziadne pobocky, chyba v databaze</p>";
		}
		else{
			echo '<select id="Position" class="form-control">';
				while ($row = mysql_fetch_assoc($result)) {	
					if ($row['position_id']== $sel){
						echo '<option value='.$row['position_id'].  ' selected="selected"'.'>'.$row['position_name'].'</option>';
					}
					else echo '<option value='.$row['position_id'].' >'.$row['position_name'].'</option>';
							
				}
				echo '</select>';
		} 
	}
} else {
	// NEpodarilo sa spojiť s databázovým serverom!
	echo '<p class="chyba">NEpodarilo sa spojiť s databázovým serverom!</p>';
        }
}



function productSold($pid,$eid,$bid, $cid) {
      if ($link = spoj_s_db()) {
      	 $sql_sold = "INSERT INTO `product_sold`(`product_id`, `employee_id`, `branch_id`, `client_id`, `sale_date`) 
					VALUES (".$pid.",".$eid.",".$bid.",".$cid.",now()); ";

		 $res= mysql_query($sql_sold, $link);
      if ($res) {
		  return true;
      } else {
          return false;
        }
      } else {
      	return false;
    }
}

// PRIDANIE UZIVATELA DO DB ////////////////////////////////////////////////
function insertclient($fn, $ln, $eid) {
	if ($link = spoj_s_db()) {
		$sql = "INSERT INTO client (First_name, Last_name) VALUES
		 ('". addslashes(strip_tags($fn)) ."','".addslashes(strip_tags($ln)) ."'); ";




		$result = mysql_query($sql, $link);
		$client_id = mysql_insert_id();
		$row = getEmployeeById($eid);
		if ($result) {
			$sql_account = "INSERT INTO `account`( `client_id`, `product_id`, `amount`, `per_month`, `loan`, `paid`) 
					VALUES (".$client_id.",1,0,-1,-1,-1);";
				
			$result_account = mysql_query($sql_account, $link);

			$res_sold = productSold(1,$eid,$row['branch_id'], $client_id);
			
			if ($result_account && $res_sold) {
					echo "Klient vytovreny";
			}
			else{
				echo mysql_error($link);
			} 
   	} else {
			// NEpodarilo sa vykonať dopyt!
     	echo 'Nastala chyba pri registracii';
    }
		mysql_close($link);
	} else {
		// NEpodarilo sa spojiť s databázovým serverom!
		echo 'Nepodarilo sa spojiť s databázovým serverom!';
	       }
}	

function getEmployeeById($id ) {
      if ($link = spoj_s_db()) {
      	$sql = "SELECT * FROM employee WHERE employee_id=".$id.";";
	  	//echo $sql;
      	$result = mysql_query($sql, $link); 
      if ($result && (mysql_num_rows($result) > 0) ) {
		$row = mysql_fetch_assoc($result);
		mysql_free_result($result);
		return $row;
      } else {
          return -9999;
        }
      } else {
      echo 'Nepodarilo sa spojit s databazovym serverom!';
    }
}


///////////////////////////////////////////////////////////////////////////////////////////////////

function insertEmployee($fn, $ln, $pid,$bid) {
	if ($link = spoj_s_db()) {
		$sql = "INSERT INTO employee (first_name, last_name, position_id, branch_id) VALUES
		 ('". addslashes(strip_tags($fn)) ."','".addslashes(strip_tags($ln)) ."','".addslashes(strip_tags($pid)) .
		 "','".addslashes(strip_tags($bid)) .  "'); ";


		 echo $sql;
		$result = mysql_query($sql, $link);
		if ($result)  echo "Zamestnanec vytvoreny";

	    else {
				// NEpodarilo sa vykonať dopyt!
			echo 'Nastala chyba pri vytvarani';
		}
		mysql_close($link);
	} else {
		// NEpodarilo sa spojiť s databázovým serverom!
		echo 'Nepodarilo sa spojiť s databázovým serverom!';
	       }
}	


function UpdateEmployee($eid,$fn, $ln, $pid,$bid) {
	if ($link = spoj_s_db()) {
		$sql = "UPDATE employee SET
		 first_name='".addslashes(strip_tags($fn)) ."',".
		 "last_name='".addslashes(strip_tags($ln)) ."',".
		 "position_id='".addslashes(strip_tags($pid)) ."',".
		 "branch_id='".addslashes(strip_tags($bid)) ."' ".
		 " WHERE employee_id = ".$eid.";";

		 echo $sql;
		$result = mysql_query($sql, $link);
		if ($result)  echo "Zamestnanec aktualizovany";

	    else {
				// NEpodarilo sa vykonať dopyt!
			echo 'Nastala chyba pri aktualizacii';
		}
		mysql_close($link);
	} else {
		// NEpodarilo sa spojiť s databázovým serverom!
		echo 'Nepodarilo sa spojiť s databázovým serverom!';
	       }
}


function login_employee($id, $pass) {
      if ($link = spoj_s_db()) {
      $sql = "SELECT * FROM employee WHERE employee_id=".$id." AND last_name='".$pass."'";
	  echo $sql;
      $result = mysql_query($sql, $link); 
      if ($result && (mysql_num_rows($result) > 0) ) {
      $row = mysql_fetch_assoc($result);
      mysql_free_result($result);
      return $row;
      } else {
          return false;
        }
      } else {
      echo '<p class="chyba">Nepodarilo sa spojit s databazovym serverom!</p>';
        }
}





function get_client($kod) {
	if ($link = spoj_s_db()) {
		$sql = "SELECT * FROM client WHERE client_id=".$kod.";" ;// definuj dopyt
		//echo "sql = $sql <br>";
		$result = mysql_query($sql, $link); // vykonaj dopyt
		if ($result) {
			// dopyt sa podarilo vykonať
			return mysql_fetch_assoc($result);
		} else {
			
			//echo 'DPC DKAPKAPSd';
			return false;
		}
	} else {
		// NEpodarilo sa spojiť s databázovým serverom!
		return false;
	}
}



function get_employee($kod) {
	if ($link = spoj_s_db()) {
		$sql = "SELECT * FROM employee WHERE employee_id=".$kod.";" ;// definuj dopyt
		echo "sql = $sql <br>";
		$result = mysql_query($sql, $link); // vykonaj dopyt
		if ($result) {
			// dopyt sa podarilo vykonať
			return mysql_fetch_assoc($result);
		} else {
			
			echo 'DPC DKAPKAPSd';
			return false;
		}
	} else {
		// NEpodarilo sa spojiť s databázovým serverom!
		return false;
	}
}



function updateclient($id, $fn, $ln) {
	if ($link = spoj_s_db()) {
			$sql = "UPDATE client SET first_name='" .addslashes(strip_tags($fn)) ."', last_name ='"
			.addslashes(strip_tags($ln)). "' WHERE client_id='" . $id . "'";
			echo $sql;
			$result = mysql_query($sql, $link); 
		if ($result) {
			
			echo 'Udaje boli aktualizovane';
		}else{	
			echo 'Udaje sa nepodarilo zmenit';
		}
		mysql_close($link);
	} else {
		echo 'CHYBA';
	}
}



///  INSERT INTO `transactions`( `client_id`, `employee_id`, `amount`, `receiver_id`, `date`) VALUES (1,3,150,2,now());




function addTransaction($id, $eid, $rec, $amount) {
	if ($link = spoj_s_db()) {
		$sql1 = "INSERT INTO transactions (client_id, employee_id, amount, receiver_id, date) VALUES
		 (".$id. "," .$eid. ",".$amount.",".$rec.", now());";


		//echo $sql1;
		$client = addUpdateClientAmount($id, $amount*-1);
		$account = addUpdateAccountAmount($id, $amount*-1);
		$receiver = addUpdateClientAmount($rec, $amount);
		$account_recevier = addUpdateAccountAmount($rec, $amount);

		$result = mysql_query($sql1, $link);
		if ($result && $client &&$receiver && $account && $account_recevier)  
			echo "TRansakcia vykonana";

	    else {
			echo mysql_error();
		}
		mysql_close($link);
	} else {
		// NEpodarilo sa spojiť s databázovým serverom!
		echo 'Nepodarilo sa spojiť s databázovým serverom!';
	       }
}	

function addUpdateClientAmount($id, $amount) {
	if ($link = spoj_s_db()) {
		$sql = "UPDATE CLIENT SET current_amount = current_amount +( $amount) WHERE client_id = $id;";


		echo $sql;
		$result = mysql_query($sql, $link);
		if ($result)  return true;

	    else {
			return false;
		}
		mysql_close($link);
	} else {
		return false;
	       }
}	

function addUpdateAccountAmount($id, $amount) {
	if ($link = spoj_s_db()) {
		$sql = "UPDATE ACCOUNT SET amount = amount +( $amount) WHERE client_id = $id;";


		//echo $sql;
		$result = mysql_query($sql, $link);
		if ($result)  return true;

	    else {
			return false;
		}
		mysql_close($link);
	} else {
		return false;
	       }
}	
