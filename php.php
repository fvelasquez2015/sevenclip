<?php

	$mysqli = new mysqli('localhost', 'root', '', 'calendario_eventos');

	if ( $mysqli->connect_errno )
	{
		die( $mysqli->mysqli_connect_error() );
	}

	if(isset($_GET['add-event']))
	{
		$error = true;

		if(!isset($_POST['start_hour']) || empty($_POST['start_hour']))
			$errors[] = 'hora de inicio necesaria';

		if(!isset($_POST['end_hour']) || empty($_POST['end_hour']))
			$errors[] = 'hora de finalizacion necesaria';

		$start_hour = explode(':', isset($_POST['start_hour']) ? $_POST['start_hour'] : '');
		$end_hour = explode(':', isset($_POST['end_hour']) ? $_POST['end_hour'] : '');

		if(!preg_match('~^([1-2][0-3]|[01]?[1-9]):([0-5]?[0-9]):([0-5]?[0-9])$~', $_POST['start_hour']))
		{
			$errors[] = 'hora de inicio incorrecta';
		}

		if(!preg_match('~^([1-2][0-3]|[01]?[1-9]):([0-5]?[0-9]):([0-5]?[0-9])$~', $_POST['end_hour']))
		{
			$errors[] = 'hora de finalizacion incorrecta';
		}

		$month = (int) $_POST['month'];
		$day = (int) $_POST['day'];

		$start_datetime = new DateTime();
		$end_datetime = new DateTime();

		$start_datetime->setDate(date('Y'), $month, $day);
		$end_datetime->setDate(date('Y'), $month, $day);

		$start_datetime->setTime(
			$start_hour[0],
			$start_hour[1],
			$start_hour[2]
		);

		$end_datetime->setTime(
			$end_hour[0],
			$end_hour[1],
			$end_hour[2]
		);

		if($end_datetime < $start_datetime)
			$errors[] = 'la hora de finalizacion debe ser superar a la de inicio';

		$description = htmlspecialchars($_POST['description'], ENT_QUOTES, 'UTF-8');

		if( empty($description) || trim($description) == '' )
			$errors[] = 'descripcion invalida';

		if( !empty($errors) )
		{
			die(implode('<br>', $errors) . '
				</body></html>');
		}
		else
		{
			$formated_startdate = $start_datetime->format('Y-m-d G:i:s');
			$formated_enddate = $end_datetime->format('Y-m-d G:i:s');
			$team_code = 1;

			if($stmt = $mysqli->prepare("
				INSERT INTO calendario_eventos
				(descripcion, fecha_inicio, fecha_fin, cod_equipo) 
				VALUES (?, ?, ?, ?)"))
			{
				$stmt->bind_param('sssi', 
					$description,
					$formated_startdate,
					$formated_enddate,
					$team_code
				);

				$stmt->execute();

				header('location: index.php');
			}
			else
			{
				die($mysqli->error . '
					</body></html>');
			}
		}
	}

	$result = $mysqli->query('SELECT * FROM calendario_eventos');

	if( !$result )
		die( $mysqli->error );

	$events = array();

	while($row = $result->fetch_assoc())
	{
		$start_date = new DateTime($row['fecha_inicio']);
		$end_date = new DateTime($row['fecha_fin']);
		$day = $start_date->format('j');
		$month = $start_date->format('n');

		$events[$month][] = array(
			'id' => $row['id'],
			'day' => $day,
			'start_hour' => $start_date->format('G:i a'),
			'end_hour' => $end_date->format('G:i a'),
			'team_code' => $row['cod_equipo'],
			'description' => $row['descripcion']
		);
	}
	
	$datetime = new DateTime();

	// mes en texto
	$txt_months = array(
		'Enero', 'Febrero', 'Marzo',
		'Abril', 'Mayo', 'Junio',
		'Julio', 'Agosto', 'septiembre',
		'Octubre', 'Noviembre', 'Diciembre'
	);

	// month number
	$month_number = $datetime->format('n');

	// nombre del mes
	$month_txt = $txt_months[$datetime->format('n')-1];

	// ultimo dia del mes
	$month_days = date('j', strtotime("last day of"));

	echo '<h1>' . $month_txt . '</h1>';

	foreach(range(1, $month_days) as $day)
	{
		$marked = false;
		$events_list = array();

		// si existe el mes en los eventos...
		if(array_key_exists($month_number, $events))
		{
			// recorremos los eventos del mes $events[numero de mes]
			foreach($events[$month_number] as $key => $event)
			{
				// si el dia del evento coincide lo marcamos y guardamos la informacion
				if($event['day'] == $day)
				{
					$marked = true;
					$events_list[] = $event;
					break;
				}
			}
		}

		echo '
		<div class="day' . ($marked ? ' marked' : '') . '">
			<strong class="day-number">' . $day . '</strong>';

			if( !empty($events_list) )
			{
				echo '<div class="events"><ul>';
					
					foreach($events_list as $event)
					{
						echo '<li>
							<h5>' . $event['description'] . '</h5>
							<div>
								<strong>Inicio:</strong>
								<span>' . $event['start_hour'] . '</span>
							</div>
							
							<div>
								<strong>Fin:</strong>
								<span>' . $event['end_hour'] . '</span>
							</div>
						</li>';
					}

				echo '</ul></div>';
			}
			else
			{
				echo '<a data-month="' . $month_number . '" data-day="' . $day . '" class="add-event" href="#"></a>';
			}

		echo '</div>';
	}
	?>