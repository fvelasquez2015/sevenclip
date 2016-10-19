<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Horario SevenClip</title>
	<link href="http://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="estilo.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
	<script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="horario.js"></script>
</head>
<body>
<div class="horario">
<?php

	$mysqli = new mysqli('localhost', 'root', '', 'horario'); #Base de datos = horario

	if ( $mysqli->connect_errno )
	{
		die( $mysqli->mysqli_connect_error() );
	}

	if(isset($_GET['add-event']))
	{
		$error = true;

		if(!isset($_POST['start_hour']) || empty($_POST['start_hour']))
			$errors[] = 'ERROR: hora de inicio necesaria';

		if(!isset($_POST['end_hour']) || empty($_POST['end_hour']))
			$errors[] = 'ERROR: hora de finalizacion necesaria';

		$start_hour = explode(':', isset($_POST['start_hour']) ? $_POST['start_hour'] : '');
		$end_hour = explode(':', isset($_POST['end_hour']) ? $_POST['end_hour'] : '');

		if(!preg_match('~^([1-2][0-3]|[01]?[1-9]):([0-5]?[0-9]):([0-5]?[0-9])$~', $_POST['start_hour']))
		{
			$errors[] = 'ERROR: hora de inicio incorrecta';
		}

		if(!preg_match('~^([1-2][0-3]|[01]?[1-9]):([0-5]?[0-9]):([0-5]?[0-9])$~', $_POST['end_hour']))
		{
			$errors[] = 'ERROR: hora de termino incorrecta';
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
			$errors[] = 'ERROR: La hora de termino debe ser superar a la de inicio';

		$description = htmlspecialchars($_POST['description'], ENT_QUOTES, 'UTF-8');

		if( empty($description) || trim($description) == '' )
			$errors[] = 'ERROR: descripcion invalida';

		if( !empty($errors) )
		{
			die(implode('<br>', $errors) . '
				</body></html>');
		}
		else
		{
			$formated_startdate = $start_datetime->format('Y-m-d G:i:s');
			$formated_enddate = $end_datetime->format('Y-m-d G:i:s');
			$alu_code = 1;

			if($stmt = $mysqli->prepare("
				INSERT INTO horario
				(descripcion, hora_inicio, hora_fin, id_alu) 
				VALUES (?, ?, ?, ?)"))
			{
				$stmt->bind_param('sssi', 
					$description,
					$formated_startdate,
					$formated_enddate,
					$alu_code
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

	$result = $mysqli->query('SELECT * FROM horario');

	if( !$result )
		die( $mysqli->error );

	$events = array();

	while($row = $result->fetch_assoc())
	{
		$start_date = new DateTime($row['hora_inicio']);
		$end_date = new DateTime($row['hora_fin']);
		$day = $start_date->format('j');
		$month = $start_date->format('n');

		$events[$month][] = array(
			'id' => $row['id'],
			'day' => $day,
			'start_hour' => $start_date->format('G:i a'),
			'end_hour' => $end_date->format('G:i a'),
			'alu_code' => $row['id_alu'],
			'description' => $row['descripcion']
		);
	}
	
	$datetime = new DateTime();
	
	$month_number = $datetime->format('n');

	$month_days = date('j', strtotime(""));

	foreach(range(1, 25) as $day)
	{
		$marked = false;
		$events_list = array();

		if(array_key_exists($month_number, $events))
		{
			foreach($events[$month_number] as $key => $event)
			{
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
			</strong>';

			if( !empty($events_list) )
			{
				echo '<div class="events"><ul>';
					
					foreach($events_list as $event)
					{
						echo '<li>
							<h5>' . $event['description'] . '</h5>
							<div>
								<strong>Hora inicio:</strong>
								<span>' . $event['start_hour'] . '</span>
							</div>
							
							<div>
								<strong>Hora fin:</strong>
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
</div>
<div class="add-event-form">
	<div class="wrapper">
		<form method="POST" action="?add-event">

		</form>
	</div>
</div>

<div class="modal fade" id="add-event">
  <div class="modal-dialog">
    <div class="modal-content">
    <form method="POST" action="?add-event">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Agregar</h4>
      </div>
      <div class="modal-body">
			<div>
				<label>Descripcion</label>
				<input type="text" name="description">
			</div>
			<div>
				<label>Hora de inicio</label>
				<input type="text" name="start_hour" value="08:00:00">
			</div>
			<div>
				<label>Hora de termino</label>
				<input type="text" name="end_hour" value="23:00:00">
			</div>
			<div>
				<input type="hidden" name="month">
				<input type="hidden" name="day">
			</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary">Agregar al horario</button>
      </div>
      </form>
    </div>
  </div>
</div>
</body>
</html>