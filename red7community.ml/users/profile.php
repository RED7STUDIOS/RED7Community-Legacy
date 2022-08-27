<?php
/*
  File Name: profile.php
  Original Location: /users/profile.php
  Description: The profile for a user.
  Author: Mitchell (Creaous)
  Copyright (C) RED7 STUDIOS 2022
*/

require $_SERVER["DOCUMENT_ROOT"] . "/assets/common.php";
require $_SERVER["DOCUMENT_ROOT"] . "/assets/classes/Users.php";
require $_SERVER["DOCUMENT_ROOT"] . "/assets/classes/Infractions.php";

if (!isset($_SESSION)) {
	// Initialize the session
	session_start();
}

$id = htmlspecialchars($_GET['id']);

if ($getUsername($id) !== null) {
	$hasInfraction = $hasInfraction($id);
	$username = $getUsername($id);

	$real_displayname = $getDisplayName($id);
	$real_description = $getDescription($id);
	$displayname = $filterwords($real_displayname);
	$description = $filterwords($real_description);
	$icon = $getIcon($id);

	if ($hasInfraction === 1) {
		$displayname = "[ CONTENT REMOVED ]";
		$description = "[ CONTENT REMOVED ]";
		$icon = "https://www.gravatar.com/avatar/?s=180";
	}

	if ($description === "") {
		$description = "This user has not set a description.";
	}

	$created_at = $getCreatedAt($id);
	$membership = $getMembership($id);
	$role = $getRole($id);
	$_isVerified = $isVerified($id);
	$items = $getItems($id);
	$clans = $getClans($id);
	$badges = $getBadges($id);

	$data_avatar = file_get_contents($API_URL . '/avatar.php?api=getbyid&id=' . $id);

	$json_avatar = json_decode($data_avatar, true);

	$hats = $json_avatar[0]['data'][0]['items'];
	$shirt = $json_avatar[0]['data'][0]['shirt'];
	$pants = $json_avatar[0]['data'][0]['pants'];
	$face = $json_avatar[0]['data'][0]['face'];

	$_id = $getActiveInfraction($id);
	$_type = $getInfractionType($_id);
	$_reason = $getInfractionReason($_id);
	$_start = $getInfractionStart($_id);
	$_end = $getInfractionEnd($_id);
	$_issued_by_id = $getInfractionIssuer($_id);
	$_issued_by = $getDisplayName($_issued_by_id);
} else {
	$username = "Not Found";
}

if (isset($_GET["page"])) {
	$page = htmlspecialchars($_GET["page"]);
} else {
	$page = 1;
};

$premium = "";
$adminCSS = "";
$verified = "";
$shownName = "";
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="The profile page for <?php echo htmlspecialchars($username) ?>.">
	<title><?php echo htmlspecialchars($username) ?>'s Profile - <?php echo htmlspecialchars($site_name); ?></title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">

	<link rel="stylesheet" href="/assets/css/style.css">

	<script defer src="/assets/js/fontawesome.js"></script>
	<script defer src="/assets/js/site.js"></script>

	<script defer src="/assets/js/relation.js"></script>

	<style>
		#c {
			width: 50%;
			height: 50%;
		}
	</style>
</head>

<body onload="init();">
	<?php include_once $_SERVER["DOCUMENT_ROOT"] . "/account/navbar.php"; ?>

	<?php
	if (str_contains($membership, "Premium")) {
		$premium = ' <img src="' . $premiumIcon . '" class="premium-icon"></img>';
	}

	if ($role >= 2) {
		$adminCSS = 'class="title-rainbow-lr"';
	}

	if ($displayname != "" && $displayname != "[]" && !empty($displayname)) {
		$shownName = htmlspecialchars($displayname);
	} else {
		$shownName = $username;
	}
	
	if ($_isVerified == 1) {
		$verified = '<img src="' . $verifiedIcon . '" class="verified-icon"></img>';
	}

	$usernameText = $premium . "<span " . $adminCSS . ">" . $shownName . "</span>" . $verified;
	?>

	<div class="page-content-wrapper">
		<script type="text/javascript">
			var ajaxSubmit = function(formEl) {
				// fetch the data for the form
				var data = $(formEl).serializeArray();
				var url = $(formEl).attr('action');

				// setup the ajax request
				$.ajax({
					type: 'POST',
					url: url,
					data: data,
					dataType: 'json',
					success: function(d) {
						if (d.success) {
							alert('Changed value successfully!');
							document.location = document.location;
						} else {
							alert("An error occurred while changing value, please try again later.")
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
				observe = function(element, event, handler) {
					element.attachEvent('on' + event, handler);
				};
			} else {
				observe = function(element, event, handler) {
					element.addEventListener(event, handler, false);
				};
			}

			function init() {
				let text = document.getElementById('text');

				function resize() {
					text.style.height = 'auto';
					text.style.height = text.scrollHeight + 'px';
				}
				/* 0-timeout to get the already changed text */
				function delayedResize() {
					window.setTimeout(resize, 0);
				}

				observe(text, 'change', resize);
				observe(text, 'cut', delayedResize);
				observe(text, 'paste', delayedResize);
				observe(text, 'drop', delayedResize);
				observe(text, 'keydown', delayedResize);

				text.focus();
				text.select();
				resize();
			}
		</script>

		

		<main class="col-md-9">
			<div class="d-flex align-items-center border-bottom">
				<?php
				if ($username === "Not Found") {
					echo "<h2>This user could not be found!</h2></div><p>This user could possibly not be found due to a bug/glitch or has been removed (not banned).";
					exit;
				}
				?>
				<img src="<?php echo htmlspecialchars($icon) ?>" class="profile-picture"></img>
				&nbsp;
				<h2><?php echo $usernameText; ?></h2>
				<small><b>(@<?php echo htmlspecialchars($username); ?>)</b></small>
				<?php if ($hasInfraction === 1) {
					echo '<p><strong class="banned-text">*BANNED*</strong></p>';
				} ?>

				<?php
				// (A) LOAD RELATIONSHIP LIBRARY + SET CURRENT USER
				require $_SERVER['DOCUMENT_ROOT'] . "/assets/classes/Relations.php";

				// (B) PROCESS RELATIONSHIP REQUEST
				if (isset($_POST['req'])) {
					$pass = true;
					switch ($_POST['req']) {
							// (B0) INVALID
						default:
							$pass = false;
							$REL->error = "Invalid request";
							break;
							// (B1) ADD FRIEND
						case "add":
							$pass = $REL->request(htmlspecialchars($_SESSION['id']), $_POST['id']);
							break;
							// (B2) ACCEPT FRIEND
						case "accept":
							$pass = $REL->acceptReq($_POST['id'], htmlspecialchars($_SESSION['id']));
							break;
							// (B3) CANCEL ADD
						case "cancel":
							$pass = $REL->cancelReq(htmlspecialchars($_SESSION['id']), $_POST['id']);
							break;
							// (B4) UNFRIEND
						case "unfriend":
							$pass = $REL->unfriend(htmlspecialchars($_SESSION['id']), $_POST['id'], false);
							break;
							// (B5) BLOCK
						case "block":
							$pass = $REL->block(htmlspecialchars($_SESSION['id']), $_POST['id']);
							break;
							// (B6) UNBLOCK
						case "unblock":
							$pass = $REL->block(htmlspecialchars($_SESSION['id']), $_POST['id'], false);
							break;
					}
					//echo $pass ? "<div class='ok'>OK</div>" : "<div class='nok'>{$REL->error}</div>";
				}

				// (C) GET + SHOW ALL USERS
				$users = $REL->getUsers(); ?>

				<div id="userList"><?php
									if (isset($_SESSION['id'])) {
										if (htmlspecialchars($_SESSION['id']) != htmlspecialchars($_GET['id'])) {
											$requests = $REL->getReq(htmlspecialchars($_SESSION['id']));
											$friends = $REL->getFriends(htmlspecialchars($_SESSION['id']));
											$id = htmlspecialchars($_GET['id']);

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
					<input type="hidden" name="req" id="ninreq" />
					<input type="hidden" name="id" id="ninid" />
				</form>
			</div>
			<div>
			<?php
				if ($hasInfraction === 1) {
					echo '<h5>This user has been banned.</h5>';
				}
				?>
				<h3>About:</h3>
				<textarea class="description" id="text" disabled><?php echo $filterwords(htmlspecialchars($description)); ?></textarea>
				<hr />
				<canvas id="c"></canvas>
				<hr />
				<div title="currently-wearing" id="currently-wearing">
					<h4>Currently Wearing:</h4>
					<div class="row row-cols-1 row-cols-md-2 flex-nowrap overflow-auto profile-list-width">
						<?php
						$total = 0;

						$datatable = "items"; // MySQL table name
						$results_per_page = 8; // number of results per page

						$start_from = ($page - 1) * $results_per_page;
						$sql = "SELECT id, displayname, type, icon FROM items WHERE isEquippable=1";
						$result = mysqli_query($link, $sql);

						while ($row = mysqli_fetch_assoc($result)) {

							$inventory = json_decode($hats, true);

							$inventory[] = $face;
							$inventory[] = $shirt;
							$inventory[] = $pants;

							if (in_array($row['id'], $inventory)) {
								$total = $total + 1;

								$thingy = " border-success";
								$thingy2 = "/shop/item.php?id=" . htmlspecialchars($row['id']);

								echo '<div class="col profile-list-card"><a class="profile-list" href="' . htmlspecialchars($thingy2) . '"><div class="align-items-center card text-center' . htmlspecialchars($thingy) . '"><img class="card-img-top normal-img" src="' . $row['icon'] . '"><div class="card-body"><h6 class="card-title profile-list-title">' . htmlspecialchars($row['displayname']) . '</h6><p class="card-text">' . htmlspecialchars($row['type']) . '</div></div></a></div>';
							}
						}
						?>
					</div>
				</div>

				<hr />

				<div title="friends" id="friends">
					<h3>Friends:</h3>
					<div class="row row-cols-1 row-cols-md-2 flex-nowrap overflow-auto profile-list-width">
						<?php
						$friends = $REL->getFriends(htmlspecialchars($_GET['id']));
						$friends_amt = 0;

						if ($friends != "" && $friends != "[]" && !empty($friends)) {
							foreach ($users as $id => $name) {
								if (isset($friends['f'][$id])) {
									$friends_amt = $friends_amt + 1;
									$friend_id = $getIdFromName($name);
									$friend_name = $name;
									$friend_icon = $getIcon($friend_id);
									$friend_dsp = $getDisplayName($friend_id);

									if ($friend_dsp === null || $friend_dsp === "") {
										$friend_f = htmlspecialchars($name);
									} else {
										$friend_f = htmlspecialchars($friend_dsp);
									}

									echo '<div class="col profile-list-card"><a class="profile-list" href="/users/profile.php?id=' . htmlspecialchars($friend_id) . '"><div class="align-items-center card text-center"><img class="card-img-top user-img" src="' . $friend_icon . '"><div class="card-body"><h6 class="card-title profile-list-title">' . htmlspecialchars($friend_f) . '</h6> <small><b>(@<small class="profile-list-title">' . htmlspecialchars($name) . '</small>)</b></small></div></div></a></div>';
								}
							}
						}
						if ($friends_amt === 0) {
							echo '<p>This user has no friends yet.</p>';
						}
						?>
					</div>
				</div>

				<hr />

				<div title="badges" id="badges">
					<h3>Badges:</h3>
					<div class="row row-cols-1 row-cols-md-2 flex-nowrap overflow-auto profile-list-width">
						<?php
						if ($badges != "" && $badges != "[]" && !empty($badges)) {
							foreach (json_decode($badges) as $mydata) {
								$data = file_get_contents($API_URL . '/badge.php?api=getbyid&id=' . $mydata);

								$json = json_decode($data, true);

								$badge_id = $json[0]['data'][0]['id'];
								$badge_name = $json[0]['data'][0]['displayname'];
								$badge_icon = $json[0]['data'][0]['icon'];

								echo '<div class="col profile-list-card"><a class="profile-list" href="/shop/badge.php?id=' . htmlspecialchars($badge_id) . '"><div class="align-items-center card text-center"><img class="card-img-top user-img" src="' . $badge_icon . '"><div class="card-body"><h6 class="card-title profile-list-title">' . htmlspecialchars($badge_name) . '</h6></div></div></a></div>';
							}
						} else {
							echo '<p>This user has no badges yet.</p>';
						}
						?>
					</div>
				</div>

				<hr />

				<div title="inventory" id="inventory">
					<h3>Inventory:</h3>
					<div class="row row-cols-1 row-cols-md-2 flex-nowrap overflow-auto profile-list-width">
						<?php
						$vals = array_count_values(json_decode($items, true));

						if ($items != "" && $items != "[]" && !empty($items)) {
							foreach ($vals as $key => $mydata) {
								$data = file_get_contents($API_URL . '/item.php?api=getitembyid&id=' . $key);

								$json = json_decode($data, true);

								$item_id = $json[0]['data'][0]['id'];
								$item_propername = $json[0]['data'][0]['name'];
								$item_name = $json[0]['data'][0]['displayname'];
								$item_icon = $json[0]['data'][0]['icon'];

								$value = htmlspecialchars($vals[$key]);

								echo '<div class="col profile-list-card"><a class="profile-list" href="/shop/item.php?id=' . htmlspecialchars($item_id) . '"><div class="align-items-center card text-center"><img class="card-img-top normal-img" src="' . $item_icon . '"><div class="card-body"><h6 class="card-title profile-list-title">' . htmlspecialchars($item_name) . '</h6><p class="card-text profile-list-title"><span class="badge bg-success">x' . number_format_short($value) . '</span></div></div></a></div>';
							}
						} else {
							echo '<p>This user has no items yet.</p>';
						}
						?>
					</div>
				</div>
				<hr />
				<?php
				if (isset($your_role))
					if ($your_role >= 2) {
						$sql = "SELECT currency FROM users WHERE id=" . htmlspecialchars($_GET['id']);
						$result = mysqli_query($link, $sql);
						if (mysqli_num_rows($result) > 0) {
							while ($row = mysqli_fetch_assoc($result)) {
								$current_currency = htmlspecialchars($row['currency']);
							}
						}

						echo '<fieldset>
								<h4>Real Data:</h4>
								<form method="post" action="/ajax/moderate.php"
									onSubmit="return ajaxSubmit(this);"><p><b>Display Name: </b> <input maxlength="69420" type="text" name="value"
									value="' . $real_displayname . '"/>
	<input hidden type="text" name="action" value="displayNameChange"/>
	<input hidden type="text" name="id" value="' . htmlspecialchars($_GET['id']) . '"/>
	<button class="btn btn-success" type="submit" name="form_submit" onclick="spin();"><i class="fa-solid fa-pen-to-square"></i> Change</button>
	</form></p>
								<p><b>Username: </b>' . $username . '</p>
								<form method="post" action="/ajax/moderate.php"
									onSubmit="return ajaxSubmit(this);"><p><b>Description: </b><textarea maxlength="200" type="text" name="value" style="width: 100%; border: 0 none white; overflow: hidden; padding: 0; outline: none; background-color: #D0D0D0;">' . $real_description . '
									</textarea><input hidden type="text" name="action" value="descriptionChange"/>
									<input hidden type="text" name="id" value="' . htmlspecialchars($_GET['id']) . '"/>
									<button class="btn btn-success" type="submit" name="form_submit" onclick="spin();"><i class="fa-solid fa-pen-to-square"></i> Change</button>
									</form></p>
						
								<form method="post" action="/ajax/moderate.php"
									onSubmit="return ajaxSubmit(this);">
									<label><b><?php echo htmlspecialchars($currency_name); ?> Amount:</b></label> <input maxlength="69420" type="number" name="amount"
																				value="' . $current_currency . '"/>
									<input hidden type="text" name="action" value="currencyChange"/>
									<input hidden type="text" name="id" value="' . htmlspecialchars($_GET['id']) . '"/>
									<button class="btn btn-success" type="submit" name="form_submit" onclick="spin();"><i class="fa-solid fa-pen-to-square"></i> Change</button>
								</form>';
						if ($your_role == 3) {
							echo '<form method="post" action="/ajax/moderate.php"
									onSubmit="return ajaxSubmit(this);">
									<label><b>Role:</b></label> <select name="value" id="value">
									<option value="user">User</option>
									<option value="moderator">Moderator</option>
									<option value="admin">Admin</option>
									<option value="super_admin">Super Admin</option>
								</select>
									<input hidden type="text" name="action" value="roleChange"/>
									<input hidden type="text" name="id" value="' . htmlspecialchars($_GET['id']) . '"/>
									<button class="btn btn-success" type="submit" name="form_submit" onclick="spin();"><i class="fa-solid fa-pen-to-square"></i> Change</button>
								</form>';
						}
						echo '
							</fieldset>
							<hr/>
							';

						if ($_id != null) {
							$checked = 'checked';
						} else {
							$checked = "";
						}

						echo '
									<fieldset>
					<h4>Infraction Settings:</h4>
					<form method="post" action="/ajax/moderate.php"
						onSubmit="return ajaxSubmit(this);">
						<label><b>Type:</b></label> <select name="type" id="type">
									<option value="ban">Ban</option>
									<option value="warning">Warning</option>
								</select>
								<br/>
						<label><b>Reason:</b></label>
						<input maxlength="69420" type="text" name="reason" class="moderate-input" value="' . htmlspecialchars($_reason) . '"/>
						<label><b>Start:</b></label>
						<input type="datetime-local" name="start"'; if ($_start != null) { echo ' value="'. $_start. '"'; } else { echo ' value="'. $todayTime. '"'; } echo '>
						<br/>
						<label><b>End:</b></label>
						<input type="datetime-local" name="end"'; if ($_end != null) { echo ' value="'. $_end. '"'; } else { echo ' value="'. $todayTime. '"'; } echo '>
						<br/>
						<label><b>Active:</b></label>
						<input type="checkbox" name="isActive"' . htmlspecialchars($checked) . '/>
						<br/>
						<input hidden type="text" name="action" value="infractUser"/>
						<input hidden type="text" name="id" value="' . htmlspecialchars($_GET['id']) . '"/>
						<button class="btn btn-success" type="submit" name="form_submit" onclick="spin();"><i class="fa-solid fa-ban"></i> Modify Infraction</button>
					</form>
				</fieldset>

				<hr/>
									';
					}


				?>
			</div>
	</div>
	</main>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://unpkg.com/@popperjs/core@2"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js">
	</script>
</body>

<script type="module">
	import * as THREE from 'https://threejsfundamentals.org/threejs/resources/threejs/r127/build/three.module.js';
	import {
		OrbitControls
	} from 'https://threejsfundamentals.org/threejs/resources/threejs/r127/examples/jsm/controls/OrbitControls.js';
	import {
		OBJLoader
	} from 'https://threejsfundamentals.org/threejs/resources/threejs/r127/examples/jsm/loaders/OBJLoader.js';
	import {
		MTLLoader
	} from 'https://threejsfundamentals.org/threejs/resources/threejs/r127/examples/jsm/loaders/MTLLoader.js';

	function main() {
		const canvas = document.querySelector('#c');
		const renderer = new THREE.WebGLRenderer({
			canvas
		});

		const fov = 45;
		const aspect = 2; // the canvas default
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
			const skyColor = 0xB1E1FF; // light blue
			const groundColor = 0xB97A20; // brownish orange
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
		$data = file_get_contents($API_URL . '/item.php?api=getitembyid&id=' . $face);

		$json = json_decode($data, true);

		$id = $face;
		$name = $json[0]['data'][0]['displayname'];
		$icon = $json[0]['data'][0]['texture'];

		$data_shirt = file_get_contents($API_URL . '/item.php?api=getitembyid&id=' . $shirt);

		$json_shirt = json_decode($data_shirt, true);

		$shirtid = $shirt;

		$shirticon = "";

		if ($shirtid === 0 || $shirtid = 0) {
			$shirticon = "";
		} else {
			$shirtname = $json_shirt[0]['data'][0]['displayname'];
			$shirticon = $json_shirt[0]['data'][0]['texture'];
		}

		$data_pants = file_get_contents($API_URL . '/item.php?api=getitembyid&id=' . $pants);

		$json_pants = json_decode($data_pants, true);

		$pantsid = $pants;
		$pantsicon = "";

		if ($pantsid === 0 || $pantsid = 0) {
			$pantsicon = "";
		} else {
			$pantsname = $json_shirt[0]['data'][0]['displayname'];
			$pantsicon = $json_shirt[0]['data'][0]['texture'];
		}
		?>

		var shirtTextureLoader = new THREE.TextureLoader();
		var shirtMap = shirtTextureLoader.load('<?php echo $STORAGE_URL;
												echo $shirticon; ?>');
		var shirtMaterial = new THREE.MeshPhongMaterial({
			map: shirtMap
		});

		var pantsTextureLoader = new THREE.TextureLoader();
		var pantsMap = pantsTextureLoader.load('<?php echo $STORAGE_URL;
												echo $pantsicon; ?>');
		var pantsMaterial = new THREE.MeshPhongMaterial({
			map: pantsMap
		});

		// HEAD MODEL
		{
			// Create a material
			var textureLoader = new THREE.TextureLoader();
			var map = textureLoader.load('<?php echo $STORAGE_URL;
											echo $icon; ?>');
			var material = new THREE.MeshPhongMaterial({
				map: map
			});

			// Create a new OBJ loader.
			var loader = new OBJLoader();
			// Load the model into memory.
			loader.load('<?php echo $STORAGE_URL ?>/Avatar/Head.obj', function(object) {
				// For any meshes in the model, add our material.
				object.traverse(function(node) {
					// Set the face image.
					if (node.isMesh) node.material = material;

					if (node instanceof THREE.Mesh) {
						// Set the color to Yellow.
						node.material.color.setHex(0xFFFF00);
					}
				});

				// Add the model to the scene.
				scene.add(object);
			});
		}

		// LEFT ARM MODEL
		{
			// Create a new OBJ loader.
			var loader = new OBJLoader();
			// Load the model into memory.
			<?php
			$armthingy = $STORAGE_URL . "/Avatar/LeftArm.obj";
			foreach (json_decode($hats, true) as $hat) {
				$data = file_get_contents($API_URL . '/item.php?api=getitembyid&id=' . $hat);

				$json = json_decode($data, true);

				$id = $hat;
				$type = $json[0]['data'][0]['type'];
				if ($type === "Gear") {
					$armthingy = $STORAGE_URL . "/Avatar/LeftArmUp.obj";
				}
			}
			?>
			loader.load('<?php echo $armthingy ?>', function(object) {
				// For any meshes in the model, add our material.
				object.traverse(function(node) {
					// Set the face image.
					<?php
					if ($shirticon != null || $shirticon != "") {
						echo 'if ( node.isMesh ) node.material = shirtMaterial;';
					}
					?>

					if (node instanceof THREE.Mesh) {
						// Set the color to Yellow.
						node.material.color.setHex(0x66CCFF);
					}
				});

				// Add the model to the scene.
				scene.add(object);
			});
		}

		// TORSO MODEL
		{
			// Create a new OBJ loader.
			var loader = new OBJLoader();
			// Load the model into memory.
			loader.load('<?php echo $STORAGE_URL ?>/Avatar/Torso.obj', function(object) {
				// For any meshes in the model, add our material.
				object.traverse(function(node) {
					// Set the face image.
					<?php
					if ($shirticon != null || $shirticon != "") {
						echo 'if ( node.isMesh ) node.material = shirtMaterial;';
					}
					?>

					if (node instanceof THREE.Mesh) {
						// Set the color to Yellow.
						node.material.color.setHex(0x66CCFF);
					}
				});

				// Add the model to the scene.
				scene.add(object);
			});
		}

		// RIGHT ARM MODEL
		{
			// Create a new OBJ loader.
			var loader = new OBJLoader();
			// Load the model into memory.
			loader.load('<?php echo $STORAGE_URL ?>/Avatar/RightArm.obj', function(object) {
				// For any meshes in the model, add our material.
				object.traverse(function(node) {
					// Set the face image.
					<?php
					if ($shirticon != null || $shirticon != "") {
						echo 'if ( node.isMesh ) node.material = shirtMaterial;';
					}
					?>

					if (node instanceof THREE.Mesh) {
						// Set the color to Yellow.
						node.material.color.setHex(0x66CCFF);
					}
				});

				// Add the model to the scene.
				scene.add(object);
			});
		}

		// LEFT LEG MODEL
		{
			// Create a new OBJ loader.
			var loader = new OBJLoader();
			// Load the model into memory.
			loader.load('<?php echo $STORAGE_URL ?>/Avatar/LeftLeg.obj', function(object) {
				// For any meshes in the model, add our material.
				object.traverse(function(node) {
					// Set the face image.
					<?php
					if ($pantsicon != null || $pantsicon != "") {
						echo 'if ( node.isMesh ) node.material = pantsMaterial;';
					}
					?>

					if (node instanceof THREE.Mesh) {
						// Set the color to Yellow.
						node.material.color.setHex(0x66CCFF);
					}
				});

				// Add the model to the scene.
				scene.add(object);
			});
		}

		// RIGHT LEG MODEL
		{
			// Create a new OBJ loader.
			var loader = new OBJLoader();
			// Load the model into memory.
			loader.load('<?php echo $STORAGE_URL ?>/Avatar/RightLeg.obj', function(object) {
				// For any meshes in the model, add our material.
				object.traverse(function(node) {
					// Set the face image.
					<?php
					if ($pantsicon != null || $pantsicon != "") {
						echo 'if ( node.isMesh ) node.material = pantsMaterial;';
					}
					?>

					if (node instanceof THREE.Mesh) {
						// Set the color to Yellow.
						node.material.color.setHex(0x66CCFF);
					}
				});

				// Add the model to the scene.
				scene.add(object);
			});
		}

		<?php
		foreach (json_decode($hats, true) as $hat) {
			$data = file_get_contents($API_URL . '/item.php?api=getitembyid&id=' . $hat);

			$json = json_decode($data, true);

			$id = $hat;
			$name = $json[0]['data'][0]['displayname'];
			$obj = $json[0]['data'][0]['obj'];
			$mtl = $json[0]['data'][0]['mtl'];

			echo '{
				const mtlLoader = new MTLLoader();
				mtlLoader.load("' . $STORAGE_URL . $mtl . '", (mtl) => {
					mtl.preload();
					const objLoader = new OBJLoader();
					objLoader.setMaterials(mtl);
					objLoader.load("' . $STORAGE_URL . $obj . '", (root) => {
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