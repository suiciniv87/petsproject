<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="initial-scale=1.0, width=device-width" />
		<meta charset="utf-8">
		
		<script src="https://js.api.here.com/v3/3.1/mapsjs-core.js" type="text/javascript" charset="utf-8"></script>
		<script src="https://js.api.here.com/v3/3.1/mapsjs-service.js" type="text/javascript" charset="utf-8"></script>
		
	</head>
	<body>
		<?php
			include_once "conecta.php";
			
			$txt_data_inicio = $_POST['txt_data_inicio'];
			$txt_data_fim = $_POST['txt_data_fim'];
			$select_nome_pet = $_POST['select_nome_pet'];
			
			/*$sql = "SELECT nome_pet FROM 'pets' WHERE 'data_inicio' between $txt_data_inicio AND 'data_fim' $txt_data_fim AND `nome_pet` == $select_nome_pet";*/
			$sql ="SELECT * FROM pets WHERE data_inicio AND data_fim BETWEEN '$txt_data_inicio' AND '$txt_data_fim' AND nome_pet = '$select_nome_pet'";
			$resultado = mysqli_query($conn, $sql);
			
			/*echo $sql;
			
			while ($row = mysqli_fetch_array($resultado)) {
				echo "ID: " . $row["id"]. " - Tipo: " . $row["tipo_pet"]. " - Nome: " . $row["nome_pet"]. " - Lat: " . $row["lat"]. " - Long: " . $row["long"]. " - Horário: " . $row["hora_vista"]. "<br>";
			}*/
			
			if ($resultado->num_rows > 0) {
				while ($row = $resultado->fetch_assoc()) {
					echo "ID: " . $row["id"]. " - Tipo: " . $row["tipo_pet"]. " - Nome: " . $row["nome_pet"]. " - Lat Inicial: " . $row["lat"]. " - Long Inicial: " . $row["long"]. " - Lat Final: " . $row["lat_final"]. " - Long Final: " . $row["long_final"]. " - Horário: " . $row["hora_vista"]. "<br>";
					$latinicial = $row["lat"];
					$longinicial = $row["long"];
					$latfinal = $row["lat_final"];
					$longfinal = $row["long_final"];
				}
			}
			else {
				echo "Nenhum resultado";
			}
			$conn->close();
		?>


		<div style="width: 640px; height: 480px" id="mapContainer"></div>
		  <script>
			// Initialize the platform object:
			var platform = new H.service.Platform({
				'apikey': 'APIKEY(Você deve modificar essa linha)'
			});

			var targetElement = document.getElementById('mapContainer');

			// Get the default map types from the platform object:
			var defaultLayers = platform.createDefaultLayers();

			// Instantiate the map:
			var map = new H.Map(
			  document.getElementById('mapContainer'),
			  defaultLayers.vector.normal.map,
			  {
			  zoom: 10,
			  center: { lat: -56.0357564, lng: -83.16874654 }
			  });
			// Create the parameters for the routing request:
			var routingParameters = {
			  // The routing mode:
			  'mode': 'fastest;car',
			  // The start point of the route:
			  'waypoint0': 'geo!<?php echo $latinicial ?>,<?php echo $longinicial ?>',
			  // The end point of the route:
			  'waypoint1': 'geo!<?php echo $latfinal ?>,<?php echo $longfinal ?>',
			  // To retrieve the shape of the route we choose the route
			  // representation mode 'display'
			  'representation': 'display'
			};

			// Define a callback function to process the routing response:
			var onResult = function(result) {
			  var route,
			  routeShape,
			  startPoint,
			  endPoint,
			  linestring;
			  if(result.response.route) {
			  // Pick the first route from the response:
			  route = result.response.route[0];
			  // Pick the route's shape:
			  routeShape = route.shape;

			  // Create a linestring to use as a point source for the route line
			  linestring = new H.geo.LineString();

			  // Push all the points in the shape into the linestring:
			  routeShape.forEach(function(point) {
			  var parts = point.split(',');
			  linestring.pushLatLngAlt(parts[0], parts[1]);
			  });

			  // Retrieve the mapped positions of the requested waypoints:
			  startPoint = route.waypoint[0].mappedPosition;
			  endPoint = route.waypoint[1].mappedPosition;

			  // Create a polyline to display the route:
			  var routeLine = new H.map.Polyline(linestring, {
			  style: { strokeColor: 'blue', lineWidth: 3 }
			  });

			  // Create a marker for the start point:
			  var startMarker = new H.map.Marker({
			  lat: startPoint.latitude,
			  lng: startPoint.longitude
			  });

			  // Create a marker for the end point:
			  var endMarker = new H.map.Marker({
			  lat: endPoint.latitude,
			  lng: endPoint.longitude
			  });

			  // Add the route polyline and the two markers to the map:
			  map.addObjects([routeLine, startMarker, endMarker]);

			  // Set the map's viewport to make the whole route visible:
			  map.getViewModel().setLookAtData({bounds: routeLine.getBoundingBox()});
			  }
			};

			// Get an instance of the routing service:
			var router = platform.getRoutingService();

			// Call calculateRoute() with the routing parameters,
			// the callback and an error callback function (called if a
			// communication error occurs):
			router.calculateRoute(routingParameters, onResult,
			  function(error) {
			  alert(error.message);
			  });

		  </script>
		
		
	</body>
</html>