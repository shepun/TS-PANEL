<?php 
try {
    $dbh = new PDO('mysql:host=localhost;dbname=teamspeak3', 'root', 'aze123');
    // foreach($dbh->query('SELECT * from tokens') as $row) {
        // print_r($row);
    // }
} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}
// load framework files
require_once("libraries/TeamSpeak3/TeamSpeak3.php");

try {
	$ts3_VirtualServer = TeamSpeak3::factory("serverquery://serveradmin:aze123@141.138.154.2:10011/?server_port=9987#no_query_clients");
	
} 
catch(Exception $e) 
{ 
	echo "<span class='error'><b>Error " . $e->getCode() . ":</b> " . $e->getMessage() . "</span>\n"; 
} 
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Bootstrap Admin Theme v3</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- styles -->
    <link href="css/styles.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  	<div class="header">
	     <div class="container">
	        <div class="row">
	           <div class="col-md-5">
	              <!-- Logo -->
	              <div class="logo">
	                 <h1><a href="index.html">Bootstrap Admin Theme</a></h1>
	              </div>
	           </div>
	           <div class="col-md-5">
	              <div class="row">
	                <div class="col-lg-12">
	                  <div class="input-group form">
	                       <input type="text" class="form-control" placeholder="Search...">
	                       <span class="input-group-btn">
	                         <button class="btn btn-primary" type="button">Search</button>
	                       </span>
	                  </div>
	                </div>
	              </div>
	           </div>
	           <div class="col-md-2">
	              <div class="navbar navbar-inverse" role="banner">
	                  <nav class="collapse navbar-collapse bs-navbar-collapse navbar-right" role="navigation">
	                    <ul class="nav navbar-nav">
	                      <li class="dropdown">
	                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">My Account <b class="caret"></b></a>
	                        <ul class="dropdown-menu animated fadeInUp">
	                          <li><a href="profile.html">Profile</a></li>
	                          <li><a href="login.html">Logout</a></li>
	                        </ul>
	                      </li>
	                    </ul>
	                  </nav>
	              </div>
	           </div>
	        </div>
	     </div>
	</div>

    <div class="page-content">
    	<div class="row">
		  <div class="col-md-2">
		  	<div class="sidebar content-box" style="display: block;">
                <ul class="nav">
                    <!-- Main menu -->
                    <li class="current"><a href="index.html"><i class="glyphicon glyphicon-home"></i> Dashboard</a></li>
                    <li><a href="calendar.html"><i class="glyphicon glyphicon-calendar"></i> Calendar</a></li>
                    <li><a href="stats.html"><i class="glyphicon glyphicon-stats"></i> Statistics (Charts)</a></li>
                    <li><a href="tables.html"><i class="glyphicon glyphicon-list"></i> Tables</a></li>
                    <li><a href="buttons.html"><i class="glyphicon glyphicon-record"></i> Buttons</a></li>
                    <li><a href="editors.html"><i class="glyphicon glyphicon-pencil"></i> Editors</a></li>
                    <li><a href="forms.html"><i class="glyphicon glyphicon-tasks"></i> Forms</a></li>
                    <li class="submenu">
                         <a href="#">
                            <i class="glyphicon glyphicon-list"></i> Pages
                            <span class="caret pull-right"></span>
                         </a>
                         <!-- Sub menu -->
                         <ul>
                            <li><a href="login.html">Login</a></li>
                            <li><a href="signup.html">Signup</a></li>
                        </ul>
                    </li>
                </ul>
             </div>
		  </div>
		  <div class="col-md-10">
		  	<div class="row">
		  	
		  	</div>

		  	<div class="content-box-large">
				<p>
                      <button class="btn btn-default"><i class="glyphicon glyphicon-cog"></i> Mettre à jour</button>
                      <button class="btn btn-info"><i class="glyphicon glyphicon-refresh"></i> Redemerrage</button>
                      <button class="btn btn-primary"><i class="glyphicon glyphicon-pause"></i> Éteindre</button>
                      <button class="btn btn-danger"><i class="glyphicon glyphicon-play"></i> Allumer</button>
                </p>
		  	</div>
			
			<div class="col-md-10">
				<div class="row">
				<?php 
				// Partie Gestion utilisateur
				if(isset($_GET['client_id']))
				{
					$id=$_GET['client_id'];
					$stmt = $dbh->prepare('SELECT * FROM clients WHERE client_id=?');
					$stmt->bindParam(1, $id);
					$stmt->execute();
					if($stmt->Rowcount() > 0)
					{
						if(isset($_GET['action']))
						{
							$info_user = $stmt->fetch();
							if($_GET['action'] == "edit")
							{
								
								?>
								<div class="col-md-6">
									<div class="content-box-large">
										<div class="panel-heading">
											<div class="panel-title">Information sur <?php echo $info_user['client_nickname']; ?></div>
										</div>
										<div class="panel-body">
											<form class="form-horizontal" role="form">
											<?php 
												foreach($dbh->query('SELECT * from client_properties WHERE id='.$id) as $row)
												{
													$name = str_replace('client_', '', $row['ident']);
													if(strlen($row['value']) > 80)
													{
														echo '<div class="form-group">
																<label class="col-sm-2 control-label">'.$name.'</label>
																<div class="col-sm-10">
																	<textarea class="form-control" id="'.$row['ident'].'" value="'.$row['value'].'" rows="3"></textarea>
																</div>
															</div>';
													} else {
														echo '<div class="form-group">
															<label for="inputEmail3" class="col-sm-2 control-label">'.$name.'</label>
															<div class="col-sm-10">
																<input type="text" class="form-control" id="'.$row['ident'].'" value="'.$row['value'].'">
															</div>
														</div>';
													}
												}
												?>
												 
												  <div class="form-group">
													<div class="col-sm-offset-2 col-sm-10">
													  <button type="submit" class="btn btn-primary">Sign in</button>
													</div>
												  </div>
												</form>
										</div>
									</div>
								</div>
								<?php
							} elseif($_GET['action'] == "delete")
							{
								echo 'Utilisateur supprimer '.$info_user['client_nickname'];
							}
						}
						else 
						{
							// Aucun action (pas d'action renseigner)
						}
					}
					else 
					{
						// Utilisateur inexistant
					}
				}
				
				if(isset($_GET['ban_id']))
				{
					$id=$_GET['ban_id'];
					$stmt = $dbh->prepare('SELECT * FROM bans WHERE ban_id=?');
					$stmt->bindParam(1, $id);
					$stmt->execute();
					if($stmt->Rowcount() > 0)
					{
						if(isset($_GET['action']))
						{
							$info_ban = $stmt->fetch();
							if($_GET['action'] == "edit")
							{
								
								?>
								<div class="col-md-6">
									<div class="content-box-large">
										<div class="panel-heading">
											<div class="panel-title">BAN <?php echo $info_ban['ban_name']; ?></div>
										</div>
										<div class="panel-body">
											<form class="form-horizontal" role="form">
											<?php 
												echo '<b>Raison </b>'.$info_ban['ban_reason'].'<br/>';
												echo '<b>Temps </b>'.$info_ban['ban_timestamp'].'<br/>';
												echo '<b>Par </b>'.$info_ban['ban_invoker_name'].'<br/>';
												?>
												 
												 
												</form>
										</div>
									</div>
								</div>
								<?php
							} elseif($_GET['action'] == "delete")
							{
								echo 'Ban supprimer '.$info_ban['ban_name'];
							}
						}
						else 
						{
							// Aucun action renseigner
						}
					}
					else
					{
						// Mauvais ID ban
					}
				}
				?>
				</div>
			</div>
			<div class="col-md-10">

		  	<div class="row">
  				<div class="col-md-6">
  					<div class="content-box-large">
		  				<div class="panel-heading">
							<div class="panel-title">Token(s)</div>
						</div>
		  				<div class="panel-body">
		  					<table class="table">
				              <thead>
				                <tr>
				                  <th>#</th>
				                  <th>Token</th>
				                  <th>Date de création</th>
				                </tr>
				              </thead>
				              <tbody>
							  <?php 
							  
								foreach($dbh->query('SELECT * from tokens') as $row)
								{
									echo '<tr>';
										echo '<td>'.$row['token_id1'].'</td>';
										echo '<td>'.$row['token_key'].'</td>';
										echo '<td>'.$row['token_created'].'</td>';
									echo '</tr>';
								}
							  ?>
				              </tbody>
				            </table>
		  				</div>
		  			</div>
  				</div>
				<div class="col-md-6">
  					<div class="content-box-large">
		  				<div class="panel-heading">
							<div class="panel-title">Ban(s)</div>
						</div>
		  				<div class="panel-body">
		  					<table class="table">
				              <thead>
				                <tr>
				                  <th>#</th>
				                  <th>Nom</th>
				                  <th>IP</th>
				                  <th>Temps de ban</th>
				                  <th>Raison</th>
				                  <th>Ban par</th>
				                  <th>Actions</th>
				                </tr>
				              </thead>
				              <tbody>
							  <?php 
							  
								foreach($dbh->query('SELECT * from bans') as $row)
								{
									echo '<tr>';
										echo '<td>'.$row['ban_id'].'</td>';
										echo '<td>'.$row['ban_name'].'</td>';
										echo '<td>'.$row['ban_ip'].'</td>';
										echo '<td>'.$row['ban_timestamp'].'</td>';
										echo '<td>'.$row['ban_reason'].'</td>';
										echo '<td>'.$row['ban_invoker_name'].'</td>';
										echo '<td>';
											echo '<a href="index.php?ban_id='.$row['ban_id'].'&action=edit"><i class="glyphicon glyphicon-pencil"></i></a>';			
											echo '<a href="index.php?ban_id='.$row['ban_id'].'&action=delete"><i class="glyphicon glyphicon-remove"></i></a>';											
										echo '</td>';
									echo '</tr>';
								}
							  ?>
				              </tbody>
				            </table>
		  				</div>
		  			</div>
  				</div>
			</div>
			
			<div class="row">
  				<div class="col-md-6">
  					<div class="content-box-large">
		  				<div class="panel-heading">
							<div class="panel-title">Client(s)</div>
						</div>
		  				<div class="panel-body">
		  					<table class="table">
				              <thead>
				                <tr>
				                  <th>#</th>
				                  <th>Nom</th>
				                  <th>Dernières connexion</th>
				                  <th>Nombre de connexion</th>
				                  <th>Dernier IP</th>
				                  <th>Actions</th>
				                </tr>
				              </thead>
				              <tbody>
							  <?php 
							  
								foreach($dbh->query('SELECT * from clients') as $row)
								{
									if($row['client_nickname'] != "serveradmin" && $row['client_nickname'] != "ServerQuery Guest")
									{
										echo '<tr>';
											echo '<td>'.$row['client_id'].'</td>';
											echo '<td>'.$row['client_nickname'].'</td>';
											echo '<td>'.$row['client_lastconnected'].'</td>';
											echo '<td>'.$row['client_totalconnections'].'</td>';
											echo '<td>'.$row['client_lastip'].'</td>';
											echo '<td>';
												echo '<a href="index.php?client_id='.$row['client_id'].'&action=edit"><i class="glyphicon glyphicon-pencil"></i></a>';			
												echo '<a href="index.php?client_id='.$row['client_id'].'&action=delete"><i class="glyphicon glyphicon-remove"></i></a>';											
											echo '</td>';
										echo '</tr>';
									}
								}
							  ?>
				              </tbody>
				            </table>
		  				</div>
		  			</div>
  				</div>
				<div class="col-md-6">
  					<div class="content-box-large" id="token_gerer">
		  				<div class="panel-heading">
							<div class="panel-title">Créer tokens par groupe</div>
						</div>
		  				<div class="panel-body">
		  					
							  <?php 
								$new_token = false;
								$delete_token = false;
								if(isset($_GET['group_id']))
								{
									$id=$_GET['group_id'];
									$stmt = $dbh->prepare('SELECT * FROM groups_server WHERE group_id=?');
									$stmt->bindParam(1, $id);
									$stmt->execute();
									if($stmt->Rowcount() > 0)
									{
										if(isset($_GET['action']))
										{
											if($_GET['action'] == "create")
												$new_token = true;
											elseif($_GET['action'] == "delete")
												$delete_token = true;
										}
										else{
											// Aucun action
										}
									} else {
										// Mauvais ID
									}
								}
							  
								foreach($dbh->query('SELECT * from groups_server WHERE server_id=1') as $row)
								{
									$groupe = $row['name'];
									echo '<b>'.$row['name'].'</b><br/>';
									foreach($dbh->query('SELECT * FROM tokens WHERE token_id1="'.$row['group_id'].'"') as $row1)
									{
										echo $row1['token_key'].' |<a href="index.php?group_id='.$row['group_id'].'&action=delete&token_key='.urlencode($row1['token_key']).'"> X </a>  |<br/>';
									}
									
									echo '<a href="index.php?group_id='.$row['group_id'].'&action=create">Nouveau token('.$row['name'].')</a><br/>';
									
									if($new_token == true && $id == $row['group_id'])
									{
										$group = $ts3_VirtualServer->serverGroupGetByName($groupe);
										$group->privilegeKeyCreate();  
										echo '<meta http-equiv="Refresh" content="0; url=index.php#token_gerer">';
									}
									if($delete_token == true)
									{
										
										// On supprime
										$stmt = $dbh->prepare('DELETE FROM tokens WHERE token_key=?');
										$stmt->bindParam(1, $_GET['token_key']);
										$stmt->execute();
										echo '<meta http-equiv="Refresh" content="0; url=index.php#token_gerer">';
									}
								}
							  ?>
				             
		  				</div>
		  			</div>
  				</div>
  			</div>
			
			<div class="row">
  				<div class="col-md-10">
	  					<div class="content-box-large">
			  				<div class="panel-heading">
					            <div class="panel-title">Information TS</div>
					          
					        </div>
			  				<div class="panel-body">
								
			  					<form class="form-horizontal" role="form">
								<?php 
								foreach($dbh->query('SELECT * from server_properties') as $row)
								{
									$name = str_replace('virtualserver_', '', $row['ident']);
									if(strlen($row['value']) > 80)
									{
										echo '<div class="form-group">
												<label class="col-sm-2 control-label">'.$name.'</label>
												<div class="col-sm-10">
													<textarea class="form-control" id="'.$row['ident'].'" value="'.$row['value'].'" rows="3"></textarea>
												</div>
											</div>';
									} else {
										echo '<div class="form-group">
											<label for="inputEmail3" class="col-sm-2 control-label">'.$name.'</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" id="'.$row['ident'].'" value="'.$row['value'].'">
											</div>
										</div>';
									}
								}
								?>
								 
								  <div class="form-group">
								    <div class="col-sm-offset-2 col-sm-10">
								      <button type="submit" class="btn btn-primary">Sign in</button>
								    </div>
								  </div>
								</form>
			  				</div>
			  			</div>
	  				</div>
  			</div>
			<div class="row">
  				<div class="col-md-10">
	  					<div class="content-box-large">
			  				<div class="panel-heading">
					            <div class="panel-title">Viewer TS</div>
					          
					        </div>
			  				<div class="panel-body">
								<?php echo $ts3_VirtualServer->getViewer(new TeamSpeak3_Viewer_Html("images/viewer/", "images/flags/", "data:image")); ?>			  					
			  				</div>
			  			</div>
	  				</div>
  			</div>

		  </div>
		</div>
    </div>

    <footer>
         <div class="container">
         
            <div class="copy text-center">
               Copyright 2016 <a href='#'>U1</a>
            </div>
            
         </div>
      </footer>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="js/custom.js"></script>
  </body>
</html>