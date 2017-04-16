
<nav class="navbar">
  <div class="tm-navbar-bg">
      
      <a class="navbar-brand text-uppercase" href="main.php"><i class="fa fa-bank tm-brand-icon"></i>Small Bank</a>

      <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#tmNavbar">
          &#9776;
      </button>
      <button id="logoff" class="fa fa-power-off tm-brand-icon2"></button></a>
      <div class="collapse navbar-toggleable-md text-xs-center text-uppercase tm-navbar" id="tmNavbar">
          <ul class="nav navbar-nav">                               
              <li class="dropdown" >
                 <div class="dropdown" >
                    <div class="nav-link">Clients</div>
                        <div class="dropdown-content">
                            <a href="newclient.php">New client</a>
                            <a href="updateclients.php"> Clients </a>
                        </div>
                    </div>
                         
              </li>
             <li class="dropdown" >
                 <div class="dropdown" >
                    <div class="nav-link">Employees</div>
                        <div class="dropdown-content">
                            <a href="employees.php">New</a>
                            <a href="updateemployees.php"> Employees </a>
                        </div>
                    </div>
                         
              </li>
              <li class="dropdown" >
                 <div class="dropdown" >
                    <div class="nav-link">Transaction</div>
                        <div class="dropdown-content">
                            <a href="tran.php">New</a>
                        </div>
                    </div>
                         
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="graphs.php" data-no="5">Graphs</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="Morgage.php" data-no="6">Morgage</a>
              </li>
          </ul>
      </div>                        
  </div>
</nav>

<script>

		$(document).ready(function(){
			$('#logoff').click(function(){
					$.ajax({
						type: "POST",
						url: "logoff.php",
						data: {  action: "logoff" }
						}).done(function( msg ) {
						    alert( "Odhlaseny" );
                             location.reload(true);
						});  
			});

		});

	</script>








