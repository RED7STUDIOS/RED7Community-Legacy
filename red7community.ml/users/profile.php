<?php
/*
  File Name: profile.php
  Original Location: /users/profile.php
  Description: The profile for a user.
  Author: Mitchell (BlxckSky_959)
  Copyright (C) RED7 STUDIOS 2021
*/

include_once $_SERVER["DOCUMENT_ROOT"]. "/assets/common.php";

if(!isset($_SESSION)){
	// Initialize the session
	session_start();
}

$data = file_get_contents($API_URL. '/user.php?key=CvHKAVEBzGveKVUpLaUZZWgHt&api=getbyid&id='. $_GET['id']);

// Decode the json response.
if (!str_contains($data, "This user doesn't exist or has been deleted"))
{
	$json_a = json_decode($data, true);

	$isBanned = $json_a[0]['data'][0]['isBanned'];

	$id = $_GET['id'];
	$username = $json_a[0]['data'][0]['username'];

	$real_displayname = $json_a[0]['data'][0]['displayname'];
	$real_description = $json_a[0]['data'][0]['description'];

	if ($isBanned != 1) {
		$displayname = filterwords($json_a[0]['data'][0]['displayname']);
		$description = filterwords($json_a[0]['data'][0]['description']);
		$icon = $json_a[0]['data'][0]['icon'];
	} else {
		$displayname = "[ CONTENT REMOVED ]";
		$description = "[ CONTENT REMOVED ]";
		$icon = "https://www.gravatar.com/avatar/?s=180";
	}

	if ($description == "") {
		$description = "This user has not set a description.";
	}

	$created_at = $json_a[0]['data'][0]['created_at'];
	$membership = $json_a[0]['data'][0]['membership'];
	$banReason = $json_a[0]['data'][0]['bannedReason'];
	$banDate = $json_a[0]['data'][0]['bannedDate'];
	$isAdmin = $json_a[0]['data'][0]['isAdmin'];
	$isVerified = $json_a[0]['data'][0]['isVerified'];
	$items = $json_a[0]['data'][0]['items'];
	$clans = $json_a[0]['data'][0]['clans'];
	$badges = $json_a[0]['data'][0]['badges'];

	$data_avatar = file_get_contents($API_URL. '/avatar.php?key=CvHKAVEBzGveKVUpLaUZZWgHt&api=getbyid&id='. $_GET['id']);

	$json_a_avatar = json_decode($data_avatar, true);

	$hats = $json_a_avatar[0]['data'][0]['items'];
	$shirt = $json_a_avatar[0]['data'][0]['shirt'];
	$pants = $json_a_avatar[0]['data'][0]['pants'];
	$face = $json_a_avatar[0]['data'][0]['face'];
}
else
{
	$username = "Not Found";
}

if (isset($_GET["page"])) { $page = $_GET["page"]; } else { $page=1; };
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="The profile page for <?php echo htmlspecialchars($username) ?>.">
		<title><?php echo htmlspecialchars($username) ?> - <?php echo $site_name; ?></title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

		<link rel="stylesheet" href="/assets/css/style.css">

		<script src="/assets/js/fontawesome.js"></script>

		<script src="/assets/js/relation.js"></script>

		<style>
		#c {
			width: 50%; 
			height: 50%;
		}
		</style>
	</head>
	<body onload="init();">
		<?php include_once $_SERVER["DOCUMENT_ROOT"]. "/account/navbar.php" ?>
        <div class="page-content-wrapper">
            <script type="text/javascript">
                var ajaxSubmit = function (formEl) {
                    // fetch the data for the form
                    var data = $(formEl).serializeArray();
                    var url = $(formEl).attr('action');

                    // setup the ajax request
                    $.ajax({
                        type: 'POST',
                        url: url,
                        data: data,
                        dataType: 'json',
                        success: function (d) {
                            if (d.success) {
                                alert('Changed value successfully!');
                                document.location = document.location;
                            }
                        }
                    });

                    // return false so the form does not actually
                    // submit to the page
                    return false;
                }
            </script>

            <script>

                let observe;
                if (window.attachEvent) {
                    observe = function (element, event, handler) {
                        element.attachEvent('on' + event, handler);
                    };
                } else {
						observe = function (element, event, handler) {
							element.addEventListener(event, handler, false);
						};
					}

					function init () {
						let text = document.getElementById('text');
						function resize () {
							text.style.height = 'auto';
							text.style.height = text.scrollHeight+'px';
						}
						/* 0-timeout to get the already changed text */
						function delayedResize () {
							window.setTimeout(resize, 0);
						}

						observe(text, 'change',  resize);
						observe(text, 'cut',     delayedResize);
						observe(text, 'paste',   delayedResize);
						observe(text, 'drop',    delayedResize);
						observe(text, 'keydown', delayedResize);

						text.focus();
						text.select();
						resize();
					}

				</script>

				<?php
				if (isset($your_isBanned))
				{
					if ($your_isBanned == 1)
					{
						echo "<script type='text/javascript'>location.href = '/errors/banned.php';</script>";
					}
				}
				
				if (isset($maintenanceMode))
				{
					if ($maintenanceMode == "on")
					{
						echo "<script type='text/javascript'>location.href = '/errors/maintenance.php';</script>";
					}
				}
				?>

				<main class="col-md-9">
					<div class="d-flex align-items-center border-bottom">
						<?php
							if ($username == "Not Found")
							{
								echo "<h2>This user could not be found!</h2></div><p>This user could possibly not be found due to a bug/glitch or has been removed (not banned).";
								exit;
							}
						?>
						<img src="<?php echo htmlspecialchars($icon) ?>" style="height: 128px; width: 128px; border-radius: 50%;"></img>
						&nbsp;
						<?php if (str_contains($membership, "Premium")) { echo '<img src="'. $premiumIcon . '" style="height: 30px; width: 30px;"></img>'; } ?>
						<h2 class="<?php if( $isAdmin == 1 ) { echo 'title-rainbow-lr'; } else {  } ?>"> <?php if ($displayname != "" && $displayname != "[]" && !empty($displayname)) { echo filterwords(htmlspecialchars($displayname)); } else { echo filterwords(htmlspecialchars($username)); } ?></h2>
						&nbsp;
						<?php if ($isVerified == 1) { echo '<img src="'. $verifiedIcon . '" style="height: 25px; width: 25px;"></img>'; } ?>
						<small><b>(@<?php echo htmlspecialchars($username); ?>)</b></small>
						<?php if ( $isBanned == 1 ) { echo '<p><strong style="color: red;">*BANNED*</strong></p>'; } ?>

                        <?php
                        // (A) LOAD RELATIONSHIP LIBRARY + SET CURRENT USER
                        require $_SERVER['DOCUMENT_ROOT']. "/assets/relation.php";

                        // (B) PROCESS RELATIONSHIP REQUEST
                        if (isset($_POST['req'])) {
                            $pass = true;
                            switch ($_POST['req']) {
                                // (B0) INVALID
                                default: $pass = false; $REL->error = "Invalid request"; break;
                                // (B1) ADD FRIEND
                                case "add": $pass = $REL->request($_SESSION['id'], $_POST['id']); break;
                                // (B2) ACCEPT FRIEND
                                case "accept": $pass = $REL->acceptReq($_POST['id'], $_SESSION['id']); break;
                                // (B3) CANCEL ADD
                                case "cancel": $pass = $REL->cancelReq($_SESSION['id'], $_POST['id']); break;
                                // (B4) UNFRIEND
                                case "unfriend": $pass = $REL->unfriend($_SESSION['id'], $_POST['id'], false); break;
                                // (B5) BLOCK
                                case "block": $pass = $REL->block($_SESSION['id'], $_POST['id']); break;
                                // (B6) UNBLOCK
                                case "unblock": $pass = $REL->block($_SESSION['id'], $_POST['id'], false); break;
                            }
                            //echo $pass ? "<div class='ok'>OK</div>" : "<div class='nok'>{$REL->error}</div>";
                        }

                        // (C) GET + SHOW ALL USERS
                        $users = $REL->getUsers(); ?>

                        <div id="userList"><?php
                            if (isset($_SESSION['id']))
                            {
                                if ($_SESSION['id'] != $_GET['id'])
                                {
                                    $requests = $REL->getReq($_SESSION['id']);
                                    $friends = $REL->getFriends($_SESSION['id']);
                                    $id = $_GET['id'];

                                    echo '&nbsp;';

                                    // (C2) BLOCK/UNBLOCK
                                    /*
                                    if (isset($friends['b'][$id])) {
                                        echo "<a class='btn btn-success' onclick=\"relate('unblock', $id)\">Unblock</a>";
                                    } else {
                                        echo "<a class='btn btn-danger' onclick=\"relate('block', $id)\">Block</a>";
                                    }
                                    */

                                    // (C3) FRIEND STATUS
                                    // FRIENDS
                                    if (isset($friends['f'][$id])) {
                                        echo "<a class='btn btn-danger' onclick=\"relate('unfriend', $id)\"><i class='fas fa-user-times'></i> Unfriend</a>";
                                    }
                                    // INCOMING FRIEND REQUEST
                                    else if (isset($requests['in'][$id])) {
                                        echo "<a class='btn btn-success' onclick=\"relate('accept', $id)\"><i class='fas fa-user-plus'></i> Accept Friend</a>";
                                    }
                                    // OUTGOING FRIEND REQUEST
                                    else if (isset($requests['out'][$id])) {
                                        echo "<a class='btn btn-danger' onclick=\"relate('cancel', $id)\"><i class='fas fa-user-slash'></i> Cancel Request</a>";
                                    }
                                    // STRANGERS
                                    else {
                                        echo "<a class='btn btn-primary' onclick=\"relate('add', $id)\"><i class='fas fa-user-friends'></i> Friend</a>";
                                    }
                                }
                            }
                        ?>
                        </div>


                        <!-- (D) NINJA RELATIONSHIP FORM -->
						<form id="ninform" method="post" target="_self">
						  <input type="hidden" name="req" id="ninreq"/>
						  <input type="hidden" name="id" id="ninid"/>
						</form>
					</div>
					<div>
						<?php
						if ($isBanned == 1) {
							if ($banDate == "" && $banReason == "") {
								echo '<h3>Ban Information:</h3><p>This user was banned on: <strong>Unknown</strong> with the following reason: <strong>Unknown</strong></p><hr/>';
							}
							else if ($banDate != "") {
								if ($banReason != "") {
									echo '<h3>Ban Information:</h3><p>This user was banned on: <strong>'. $banDate. '</strong> with the following reason: <strong>'. $banReason. '</strong></p><hr/>';
								}
								else {
									echo '<h3>Ban Information:</h3><p>This user was banned on: <strong>' . $banDate . '</strong> with the following reason: <strong>Unknown</strong></p><hr/>';
								}
							} else {
								echo '<h3>Ban Information:</h3><p>This user was banned on: <strong>Unknown</strong> with the following reason: <strong>' . $banReason . '</strong></p><hr/>';
							}
						}
						?>

                        <h3>About:</h3>
                        <textarea class="description" id="text"
                                  disabled><?php echo filterwords(htmlspecialchars($description)); ?></textarea>
                        <hr/>
						<?php
							if ($your_isAdmin == 1) {
								$sql = "SELECT currency FROM users WHERE id=" . $_GET['id'];
								$result = mysqli_query($link, $sql);
								if (mysqli_num_rows($result) > 0) {
									while ($row = mysqli_fetch_assoc($result)) {
										$current_currency = $row['currency'];
									}
								}

								echo '<fieldset>
                            <h3>Real Data:</h3>
                            <p><b>Display Name: </b>' . $real_displayname . '</p>
                            <p><b>Username: </b>' . $username . '</p>
                            <p><b>Description: </b>' . $real_description . '</p>
                    
                            <form method="post" action="/moderate/ajax.php"
                                  onSubmit="return ajaxSubmit(this);">
                                <label><b>Currency Amount:</b></label> <input maxlength="69420" type="number" name="amount"
                                                                              value="' . $current_currency . '"/>
                                <input hidden type="text" name="action" value="currencyChange"/>
                                <input hidden type="text" name="id" value="' . $_GET['id'] . '"/>
                                <input class="btn btn-success" type="submit" name="form_submit" value="Change"/>
                            </form>
                        </fieldset>
                        <hr/>
                        ';

								if ($isBanned == 1) {
									$checked = 'checked';
								} else {
									$checked = "";
								}

								echo '
                                <fieldset>
                <h3>Ban Settings:</h3>
                <form method="post" action="/moderate/ajax.php"
                      onSubmit="return ajaxSubmit(this);">
                    <h5>Is Banned:</h5>
                    <input type="checkbox" name="isBanned"' . $checked . '/>
                    <h5>Ban Reason:</h5>
                    <input maxlength="69420" type="text" name="banReason" class="moderate-input" value="' . $banReason . '"/>
                    <input hidden type="text" name="action" value="banningUser"/>
                    <input hidden type="text" name="id" value="' . $_GET['id'] . '"/>
                    <input class="btn btn-success" type="submit" name="form_submit" value="Ban / Unban"/>
                </form>
            </fieldset>

            <hr/>
                                ';


							}

						?>

                        <canvas id="c"></canvas>

                        <h4>Currently Wearing:</h4>
                        <div class="row row-cols-1 row-cols-md-2 flex-nowrap overflow-auto profile-list-width">
							<?php
								$total = 0;

								$datatable = "catalog"; // MySQL table name
								$results_per_page = 8; // number of results per page

								$start_from = ($page-1) * $results_per_page;
								$sql = "SELECT id, displayname, type, icon FROM catalog WHERE isEquippable=1";
								$result = mysqli_query($link, $sql);

								while($row = mysqli_fetch_assoc($result)) {

									$inventory = json_decode($hats, true);

									$inventory[] = $face;
									$inventory[] = $shirt;
									$inventory[] = $pants;

									if (in_array($row['id'], $inventory))
									{
										$total = $total + 1;

										$thingy = " border-success";
										$thingy2 = "/catalog/item.php?id=". $row['id'];

										echo '<div class="col profile-list-card"><a class="profile-list" href="'. $thingy2. '"><div class="align-items-center card text-center'. $thingy. '"><img class="card-img-top normal-img" src="'. $row['icon'] . '"><div class="card-body"><h6 class="card-title profile-list-title">'. $row['displayname'] . '</h6><p class="card-text">'. $row['type']. '</div></div></a></div>';
									}
								}
							?>
						</div>

                        <hr/>

                        <h3>Friends:</h3>
                        <div class="row row-cols-1 row-cols-md-2 flex-nowrap overflow-auto profile-list-width">
							<?php
								$friends = $REL->getFriends($_GET['id']);

								if ($friends != "" && $friends != "[]" && !empty($friends)) {
									foreach ($users as $id=>$name) {
										if (isset($friends['f'][$id]))
										{
											$data = file_get_contents($API_URL. '/user.php?key=CvHKAVEBzGveKVUpLaUZZWgHt&api=getbyname&name='. $name);

											$json_a = json_decode($data, true);

											$friend_id = $json_a[0]['data'][0]['id'];
											$friend_name = $json_a[0]['data'][0]['username'];
											$friend_icon = $json_a[0]['data'][0]['icon'];
											$friend_dsp = $json_a[0]['data'][0]['displayname'];

											if ($friend_dsp == null || $friend_dsp == "")
											{
												$friend_f = htmlspecialchars($name);
											}
											else
											{
												$friend_f = htmlspecialchars($friend_dsp);
											}

											echo '<div class="col profile-list-card"><a class="profile-list" href="/users/profile.php?id='. $friend_id . '"><div class="align-items-center card text-center"><img class="card-img-top user-img" src="'. $friend_icon . '"><div class="card-body"><h6 class="card-title profile-list-title">'. $friend_f . '</h6> <small><b>(@<small class="profile-list-title">'. htmlspecialchars($name). '</small>)</b></small></div></div></a></div>';
										}
									}
								}
								else
								{
									echo '<p>This user has no friends yet.</p>';
								}
							?>
                        </div>

                        <hr/>

                        <h3>Badges:</h3>
                        <div class="row row-cols-1 row-cols-md-2 flex-nowrap overflow-auto profile-list-width">
							<?php
								if ($badges != "" && $badges != "[]" && !empty($badges)) {
									foreach(json_decode($badges) as $mydata)
									{
										$data = file_get_contents($API_URL. '/badge.php?key=CvHKAVEBzGveKVUpLaUZZWgHt&api=getbyid&id='. $mydata);

										$json_a = json_decode($data, true);

										$badge_id = $json_a[0]['data'][0]['id'];
										$badge_name = $json_a[0]['data'][0]['displayname'];
										$badge_icon = $json_a[0]['data'][0]['icon'];

										echo '<div class="col profile-list-card"><a class="profile-list" href="/catalog/badge.php?id='. $badge_id . '"><div class="align-items-center card text-center"><img class="card-img-top user-img" src="'. $badge_icon . '"><div class="card-body"><h6 class="card-title profile-list-title">'. $badge_name . '</h6></div></div></a></div>';
									}
								}
								else
								{
									echo '<p>This user has no badges yet.</p>';
								}
							?>
                        </div>

                        <hr/>

                        <h3>Inventory:</h3>
                        <div class="row row-cols-1 row-cols-md-2 flex-nowrap overflow-auto profile-list-width">
							<?php
								$vals = array_count_values(json_decode($items, true));

								if ($items != "" && $items != "[]" && !empty($items)) {
									foreach($vals as $key=>$mydata)
									{
										$data = file_get_contents($API_URL. '/catalog.php?key=CvHKAVEBzGveKVUpLaUZZWgHt&api=getitembyid&id='. $key);

										$json_a = json_decode($data, true);

										$item_id = $json_a[0]['data'][0]['id'];
										$item_propername = $json_a[0]['data'][0]['name'];
										$item_name = $json_a[0]['data'][0]['displayname'];
										$item_icon = $json_a[0]['data'][0]['icon'];

										$value = $vals[$key];

										echo '<div class="col profile-list-card"><a class="profile-list" href="/catalog/item.php?id='. $item_id . '"><div class="align-items-center card text-center"><img class="card-img-top normal-img" src="'. $item_icon . '"><div class="card-body"><h6 class="card-title profile-list-title">'. $item_name . '</h6><p class="card-text profile-list-title"><span class="badge bg-success">x'. number_format_short($value) . '</span></div></div></a></div>';
									}
								}
								else
								{
									echo '<p>This user has no items yet.</p>';
								}
							?>
                        </div>
					</div>
				</div>
			</main>
		</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
	</body>

	<script type="module">
		import * as THREE from 'https://threejsfundamentals.org/threejs/resources/threejs/r127/build/three.module.js';
		import {OrbitControls} from 'https://threejsfundamentals.org/threejs/resources/threejs/r127/examples/jsm/controls/OrbitControls.js';
		import {OBJLoader} from 'https://threejsfundamentals.org/threejs/resources/threejs/r127/examples/jsm/loaders/OBJLoader.js';
		import {MTLLoader} from 'https://threejsfundamentals.org/threejs/resources/threejs/r127/examples/jsm/loaders/MTLLoader.js';

		function main() {
			const canvas = document.querySelector('#c');
			const renderer = new THREE.WebGLRenderer({canvas});

			const fov = 45;
			const aspect = 2;  // the canvas default
			const near = 0.1;
			const far = 100;
			const camera = new THREE.PerspectiveCamera(fov, aspect, near, far);
			camera.position.set(0, 10, 20);

			const controls = new OrbitControls(camera, canvas);
			controls.target.set(0, 5, 0);
			controls.update();

			const scene = new THREE.Scene();
			scene.background = new THREE.Color('black');

			{
				const planeSize = 40;

				const loader = new THREE.TextureLoader();
				const texture = loader.load('https://threejsfundamentals.org/threejs/resources/images/checker.png');
				texture.wrapS = THREE.RepeatWrapping;
				texture.wrapT = THREE.RepeatWrapping;
				texture.magFilter = THREE.NearestFilter;
				const repeats = planeSize / 2;
				texture.repeat.set(repeats, repeats);

				const planeGeo = new THREE.PlaneGeometry(planeSize, planeSize);
				const planeMat = new THREE.MeshPhongMaterial({
					map: texture,
					side: THREE.DoubleSide,
				});
				const mesh = new THREE.Mesh(planeGeo, planeMat);
				mesh.rotation.x = Math.PI * -.5;
				scene.add(mesh);
			}

			{
				const skyColor = 0xB1E1FF;  // light blue
				const groundColor = 0xB97A20;  // brownish orange
				const intensity = 1;
				const light = new THREE.HemisphereLight(skyColor, groundColor, intensity);
				scene.add(light);
			}

			{
				const color = 0xFFFFFF;
				const intensity = 1;
				const light = new THREE.DirectionalLight(color, intensity);
				light.position.set(0, 10, 0);
				light.target.position.set(-5, 0, 0);
				scene.add(light);
				scene.add(light.target);
			}

			<?php
				$data = file_get_contents($API_URL. '/catalog.php?key=CvHKAVEBzGveKVUpLaUZZWgHt&api=getitembyid&id='. $face);

				$json_a = json_decode($data, true);

				$id = $face;
				$name = $json_a[0]['data'][0]['displayname'];
				$icon = $json_a[0]['data'][0]['texture'];

				$data_shirt = file_get_contents($API_URL. '/catalog.php?key=CvHKAVEBzGveKVUpLaUZZWgHt&api=getitembyid&id='. $shirt);

				$json_a_shirt = json_decode($data_shirt, true);

				$shirtid = $shirt;

				$shirticon = "";
				
				if ($shirtid == 0 || $shirtid = 0)
				{
					$shirticon = "";
				}
				else
				{
					$shirtname = $json_a_shirt[0]['data'][0]['displayname'];
					$shirticon = $json_a_shirt[0]['data'][0]['texture'];
				}

				$data_pants = file_get_contents($API_URL. '/catalog.php?key=CvHKAVEBzGveKVUpLaUZZWgHt&api=getitembyid&id='. $pants);

				$json_a_pants = json_decode($data_pants, true);

				$pantsid = $pants;
				$pantsicon = "";
				
				if ($pantsid == 0 || $pantsid = 0)
				{
					$pantsicon = "";
				}
				else
				{
					$pantsname = $json_a_shirt[0]['data'][0]['displayname'];
					$pantsicon = $json_a_shirt[0]['data'][0]['texture'];
				}
			?>

			var shirtTextureLoader = new THREE.TextureLoader();
			var shirtMap = shirtTextureLoader.load('<?php echo $STORAGE_URL; echo $shirticon; ?>');
			var shirtMaterial = new THREE.MeshPhongMaterial({map: shirtMap});

			var pantsTextureLoader = new THREE.TextureLoader();
			var pantsMap = pantsTextureLoader.load('<?php echo $STORAGE_URL; echo $pantsicon; ?>');
			var pantsMaterial = new THREE.MeshPhongMaterial({map: pantsMap});

			// HEAD MODEL
			{
				// Create a material
				var textureLoader = new THREE.TextureLoader();
				var map = textureLoader.load('<?php echo $STORAGE_URL; echo $icon; ?>');
				var material = new THREE.MeshPhongMaterial({map: map});

				// Create a new OBJ loader.
				var loader = new OBJLoader();
				// Load the model into memory.
				loader.load( '<?php echo $STORAGE_URL ?>/Avatar/Head.obj', function ( object )
				{
					// For any meshes in the model, add our material.
					object.traverse( function ( node ) {
						// Set the face image.
						if ( node.isMesh ) node.material = material;

						if ( node instanceof THREE.Mesh ) {
							// Set the color to Yellow.
							node.material.color.setHex(0xFFFF00);
						}
					});

					// Add the model to the scene.
					scene.add( object );
				});
			}

			// LEFT ARM MODEL
			{
				// Create a new OBJ loader.
				var loader = new OBJLoader();
				// Load the model into memory.
				<?php
				$armthingy = $STORAGE_URL. "/Avatar/LeftArm.obj";
				foreach(json_decode($hats, true) as $hat) {
					$data = file_get_contents($API_URL. '/catalog.php?key=CvHKAVEBzGveKVUpLaUZZWgHt&api=getitembyid&id='. $hat);

					$json_a = json_decode($data, true);

					$id = $hat;
					$type = $json_a[0]['data'][0]['type'];
					if ($type == "Gear")
					{
						$armthingy = $STORAGE_URL. "/Avatar/LeftArmUp.obj";
					}
				}
				?>
				loader.load( '<?php echo $armthingy ?>', function ( object )
				{
					// For any meshes in the model, add our material.
					object.traverse( function ( node ) {
						// Set the face image.
						<?php
						if ($shirticon != null || $shirticon != "") {
							echo 'if ( node.isMesh ) node.material = shirtMaterial;';
						}
						?>

						if ( node instanceof THREE.Mesh ) {
							// Set the color to Yellow.
							node.material.color.setHex(0x66CCFF);
						}
					});

					// Add the model to the scene.
					scene.add( object );
				});
			}

			// TORSO MODEL
			{
				// Create a new OBJ loader.
				var loader = new OBJLoader();
				// Load the model into memory.
				loader.load( '<?php echo $STORAGE_URL ?>/Avatar/Torso.obj', function ( object )
				{
					// For any meshes in the model, add our material.
					object.traverse( function ( node ) {
						// Set the face image.
						<?php
						if ($shirticon != null || $shirticon != "") {
							echo 'if ( node.isMesh ) node.material = shirtMaterial;';
						}
						?>

						if ( node instanceof THREE.Mesh ) {
							// Set the color to Yellow.
							node.material.color.setHex(0x66CCFF);
						}
					});

					// Add the model to the scene.
					scene.add( object );
				});
			}

			// RIGHT ARM MODEL
			{
				// Create a new OBJ loader.
				var loader = new OBJLoader();
				// Load the model into memory.
				loader.load( '<?php echo $STORAGE_URL ?>/Avatar/RightArm.obj', function ( object )
				{
					// For any meshes in the model, add our material.
					object.traverse( function ( node ) {
						// Set the face image.
						<?php
						if ($shirticon != null || $shirticon != "") {
							echo 'if ( node.isMesh ) node.material = shirtMaterial;';
						}
						?>

						if ( node instanceof THREE.Mesh ) {
							// Set the color to Yellow.
							node.material.color.setHex(0x66CCFF);
						}
					});

					// Add the model to the scene.
					scene.add( object );
				});
			}

			// LEFT LEG MODEL
			{
				// Create a new OBJ loader.
				var loader = new OBJLoader();
				// Load the model into memory.
				loader.load( '<?php echo $STORAGE_URL ?>/Avatar/LeftLeg.obj', function ( object )
				{
					// For any meshes in the model, add our material.
					object.traverse( function ( node ) {
						// Set the face image.
						<?php
						if ($pantsicon != null || $pantsicon != "") {
							echo 'if ( node.isMesh ) node.material = pantsMaterial;';
						}
						?>

						if ( node instanceof THREE.Mesh ) {
							// Set the color to Yellow.
							node.material.color.setHex(0x66CCFF);
						}
					});

					// Add the model to the scene.
					scene.add( object );
				});
			}

			// RIGHT LEG MODEL
			{
				// Create a new OBJ loader.
				var loader = new OBJLoader();
				// Load the model into memory.
				loader.load( '<?php echo $STORAGE_URL ?>/Avatar/RightLeg.obj', function ( object )
				{
					// For any meshes in the model, add our material.
					object.traverse( function ( node ) {
						// Set the face image.
						<?php
						if ($pantsicon != null || $pantsicon != "") {
							echo 'if ( node.isMesh ) node.material = pantsMaterial;';
						}
						?>

						if ( node instanceof THREE.Mesh ) {
							// Set the color to Yellow.
							node.material.color.setHex(0x66CCFF);
						}
					});

					// Add the model to the scene.
					scene.add( object );
				});
			}

			<?php
			foreach(json_decode($hats, true) as $hat) {
				$data = file_get_contents($API_URL. '/catalog.php?key=CvHKAVEBzGveKVUpLaUZZWgHt&api=getitembyid&id='. $hat);

				$json_a = json_decode($data, true);

				$id = $hat;
				$name = $json_a[0]['data'][0]['displayname'];
				$obj = $json_a[0]['data'][0]['obj'];
				$mtl = $json_a[0]['data'][0]['mtl'];

				echo '{
				const mtlLoader = new MTLLoader();
				mtlLoader.load("'. $STORAGE_URL. $mtl. '", (mtl) => {
					mtl.preload();
					const objLoader = new OBJLoader();
					objLoader.setMaterials(mtl);
					objLoader.load("'. $STORAGE_URL. $obj. '", (root) => {
						scene.add(root);
					});
				});
			}';
			}
			?>

			function resizeRendererToDisplaySize(renderer) {
				const canvas = renderer.domElement;
				const width = canvas.clientWidth;
				const height = canvas.clientHeight;
				const needResize = canvas.width !== width || canvas.height !== height;
				if (needResize) {
					renderer.setSize(width, height, false);
				}
				return needResize;
			}

			function render() {

				if (resizeRendererToDisplaySize(renderer)) {
					const canvas = renderer.domElement;
					camera.aspect = canvas.clientWidth / canvas.clientHeight;
					camera.updateProjectionMatrix();
				}

				renderer.render(scene, camera);

				requestAnimationFrame(render);
			}

			requestAnimationFrame(render);
		}

		main();
	</script>
</html>