<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Calendario</title>
	<link href="http://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="app.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="calendar">
<h1>Octubre</h1>
		<div class="day">
			<strong class="day-number">1</strong><a data-month="10" data-day="1" class="add-event" href="#"></a></div>
		<div class="day">
			<strong class="day-number">2</strong><a data-month="10" data-day="2" class="add-event" href="#"></a></div>
		<div class="day">
			<strong class="day-number">3</strong><a data-month="10" data-day="3" class="add-event" href="#"></a></div>
		<div class="day">
			<strong class="day-number">4</strong><a data-month="10" data-day="4" class="add-event" href="#"></a></div>
		<div class="day marked">
			<strong class="day-number">5</strong><div class="events"><ul><li>
							<h5>Prueba Alfonso</h5>
							<div>
								<strong>Inicio:</strong>
								<span>12:00 pm</span>
							</div>
							
							<div>
								<strong>Fin:</strong>
								<span>14:00 pm</span>
							</div>
						</li></ul></div></div>
		<div class="day">
			<strong class="day-number">6</strong><a data-month="10" data-day="6" class="add-event" href="#"></a></div>
		<div class="day">
			<strong class="day-number">7</strong><a data-month="10" data-day="7" class="add-event" href="#"></a></div>
		<div class="day">
			<strong class="day-number">8</strong><a data-month="10" data-day="8" class="add-event" href="#"></a></div>
		<div class="day marked">
			<strong class="day-number">9</strong><div class="events"><ul><li>
							<h5>Examen Dante</h5>
							<div>
								<strong>Inicio:</strong>
								<span>8:00 am</span>
							</div>
							
							<div>
								<strong>Fin:</strong>
								<span>12:00 pm</span>
							</div>
						</li></ul></div></div>
		<div class="day">
			<strong class="day-number">10</strong><a data-month="10" data-day="10" class="add-event" href="#"></a></div>
		<div class="day marked">
			<strong class="day-number">11</strong><div class="events"><ul><li>
							<h5>Control Fernando</h5>
							<div>
								<strong>Inicio:</strong>
								<span>16:00 pm</span>
							</div>
							
							<div>
								<strong>Fin:</strong>
								<span>18:00 pm</span>
							</div>
						</li></ul></div></div>
		<div class="day">
			<strong class="day-number">12</strong><a data-month="10" data-day="12" class="add-event" href="#"></a></div>
		<div class="day">
			<strong class="day-number">13</strong><a data-month="10" data-day="13" class="add-event" href="#"></a></div>
		<div class="day marked">
			<strong class="day-number">14</strong><div class="events"><ul><li>
							<h5>Laboratorio Emilio</h5>
							<div>
								<strong>Inicio:</strong>
								<span>11:00 am</span>
							</div>
							
							<div>
								<strong>Fin:</strong>
								<span>12:00 pm</span>
							</div>
						</li></ul></div></div>
		<div class="day">
			<strong class="day-number">15</strong><a data-month="10" data-day="15" class="add-event" href="#"></a></div>
		<div class="day">
			<strong class="day-number">16</strong><a data-month="10" data-day="16" class="add-event" href="#"></a></div>
		<div class="day">
			<strong class="day-number">17</strong><a data-month="10" data-day="17" class="add-event" href="#"></a></div>
		<div class="day">
			<strong class="day-number">18</strong><a data-month="10" data-day="18" class="add-event" href="#"></a></div>
		<div class="day">
			<strong class="day-number">19</strong><a data-month="10" data-day="19" class="add-event" href="#"></a></div>
		<div class="day">
			<strong class="day-number">20</strong><a data-month="10" data-day="20" class="add-event" href="#"></a></div>
		<div class="day">
			<strong class="day-number">21</strong><a data-month="10" data-day="21" class="add-event" href="#"></a></div>
		<div class="day">
			<strong class="day-number">22</strong><a data-month="10" data-day="22" class="add-event" href="#"></a></div>
		<div class="day">
			<strong class="day-number">23</strong><a data-month="10" data-day="23" class="add-event" href="#"></a></div>
		<div class="day">
			<strong class="day-number">24</strong><a data-month="10" data-day="24" class="add-event" href="#"></a></div>
		<div class="day">
			<strong class="day-number">25</strong><a data-month="10" data-day="24" class="add-event" href="#"></a></div>
		<div class="day">
			<strong class="day-number">26</strong><a data-month="10" data-day="26" class="add-event" href="#"></a></div>
		<div class="day">
			<strong class="day-number">27</strong><a data-month="10" data-day="27" class="add-event" href="#"></a></div>
		<div class="day">
			<strong class="day-number">28</strong><a data-month="10" data-day="28" class="add-event" href="#"></a></div></div>

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
        <h4 class="modal-title">Agregar evento</h4>
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
				<label>Hora de finalizacion</label>
				<input type="text" name="end_hour" value="23:00:00">
			</div>
			<div>
				<input type="hidden" name="month">
				<input type="hidden" name="day">
			</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary">Agregar evento</button>
      </div>
      </form>
    </div>
  </div>
</div>
</body>
</html>