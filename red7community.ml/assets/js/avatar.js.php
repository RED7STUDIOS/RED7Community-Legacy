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
		$data = file_get_contents($API_URL . '/catalog.php?api=getitembyid&id=' . $face);

		$json_a = json_decode($data, true);

		$id = $face;
		$name = $json_a[0]['data'][0]['displayname'];
		$icon = $json_a[0]['data'][0]['texture'];

		$data_shirt = file_get_contents($API_URL . '/catalog.php?api=getitembyid&id=' . $shirt);

		$json_a_shirt = json_decode($data_shirt, true);

		$shirtid = $shirt;
		$shirtname = $json_a_shirt[0]['data'][0]['displayname'];
		$shirticon = $json_a_shirt[0]['data'][0]['texture'];

		$data_pants = file_get_contents($API_URL . '/catalog.php?api=getitembyid&id=' . $pants);

		$json_a_pants = json_decode($data_pants, true);

		$pantsid = $pants;
		$pantsname = $json_a_pants[0]['data'][0]['displayname'];
		$pantsicon = $json_a_pants[0]['data'][0]['texture'];
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
				$data = file_get_contents($API_URL . '/catalog.php?api=getitembyid&id=' . $hat);

				$json_a = json_decode($data, true);

				$id = $hat;
				$type = $json_a[0]['data'][0]['type'];
				if ($type == "Gear") {
					$armthingy = $STORAGE_URL . "/Avatar/LeftArmUp.obj";
				}
			}
			?>
			loader.load('<?php echo $armthingy ?>', function(object) {
				// For any meshes in the model, add our material.
				object.traverse(function(node) {
					// Set the face image.
					if (node.isMesh) node.material = shirtMaterial;

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
					if (node.isMesh) node.material = shirtMaterial;

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
					if (node.isMesh) node.material = shirtMaterial;

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
					if (node.isMesh) node.material = pantsMaterial;

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
					if (node.isMesh) node.material = pantsMaterial;

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
			$data = file_get_contents($API_URL . '/catalog.php?api=getitembyid&id=' . $hat);

			$json_a = json_decode($data, true);

			$id = $hat;
			$name = $json_a[0]['data'][0]['displayname'];
			$obj = $json_a[0]['data'][0]['obj'];
			$mtl = $json_a[0]['data'][0]['mtl'];

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