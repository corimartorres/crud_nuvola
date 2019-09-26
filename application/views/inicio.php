<?php
    $CI = &get_instance();
    if ($this->uri->segment(3)==0) {
        $cliente[0]['id'] = "";
        $cliente[0]['Nombre'] = "";
        $cliente[0]['Apellido'] = "";
        $cliente[0]['Cedula'] = "";
        $cliente[0]['Edad'] = "";
        $cliente[0]['Correo'] = "";
    }else{
        $CI->db->where('id', $this->uri->segment(3));
        $cliente = $CI->db->get('cliente')->result_array();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Clientes</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.2.1/Chart.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    
 
    <style>
        body{
            margin:0;
            margin-bottom: 120px;
            background-color: #81BEF7;
        }
        h1{
            font-size: 40px;
            color: #0B615E;
            font-weight: bold;
        }
        .panel-default{
            border: 2px solid #0B615E;
            border-radius: 20px;
            background-color: #F2EFFB; 
        }
        .panel-heading{
            border-radius: 20px 20px 0px 0px;
            padding-left: 30px;
        }
        h2{
            font-size: 20px;
            color: #0B615E;
            font-weight: bold;
        }
        .row{
            margin-bottom: 15px;
        }
        .btn{
            border-radius: 15px;
        }
        .input-group-addon{
            color: #0B615E;
            font-weight: bold;
        }
        th{
            color: #0B615E;
            font-weight: bold;
        }
    </style>

</head>
<body>
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12 text-center">
                <h1>Datos Clientes</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading"><h2>Agregar Cliente</h2></div>
                    <div class="panel-body">
                        <form action="<?= base_url('clienteController/guardar') ?>" method='post'>
                            <!-- -------------------------------------------------------------- --> 
                            <div class="col-md-12 form-group input-group">
                                <input type="hidden" name="id" class="form-control" value="<?= $cliente[0]['id']?>">
                            </div>
                            <!-- -------------------------------------------------------------- -->
                            <div class="col-md-12 form-group input-group">
                                <label for="" class="input-group-addon">Nombre</label>
                                <input required type="text" name="Nombre" class="form-control" minlength="2" maxlength="40" value="<?= $cliente[0]['Nombre']?>">
                            </div>
                            <div class="col-md-12 form-group input-group">
                                <label for="" class="input-group-addon">Apellido</label>
                                <input required type="text" name="Apellido" class="form-control" minlength="2" maxlength="40" value="<?= $cliente[0]['Apellido']?>">
                            </div>
                            <div class="col-md-12 form-group input-group">
                                <label for="" class="input-group-addon">Cédula</label>
                                <input required type="number" name="Cedula" class="form-control" minlength="6" maxlength="15" value="<?= $cliente[0]['Cedula']?>">
                            </div>
                            <div class="col-md-12 form-group input-group">
                                <label for="" class="input-group-addon">Edad</label>
                                <input required type="number" name="Edad" class="form-control" maxlength="3" value="<?= $cliente[0]['Edad']?>">
                            </div>
                            <div class="col-md-12 form-group input-group">
                                <label for="" class="input-group-addon">Correo</label>
                                <input required type="email" name="Correo" class="form-control" placeholder="Por ejemplo, maria.perez@gmail.com" minlength="2" maxlength="40" value="<?= $cliente[0]['Correo']?>">
                            </div>
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-success glyphicon glyphicon-ok"></button>
                                <a href="<?php echo base_url("clienteController/guardar/0") ?>" class="btn btn-primary glyphicon glyphicon-plus"></a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading"><h2>Clientes Agregados</h2></div>
                    <div class="panel-body">
                        <table class="table table-hover table-striped">
                            <thead>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Cédula</th>
                                <th>Edad</th>
                                <th>Correo</th>
                                <th></th>
                            </thead>
                            <tbody>
                                <?php
                                    $cliente = $CI->db->get('cliente')->result_array();
                                    foreach ($cliente as $cliente) {
                                        
                                        $rutaEditar = base_url("clienteController/guardar/{$cliente['id']}");
                                        $rutaBorrar = base_url("clienteController/borrar?borrar={$cliente['id']}");
                                        echo "<tr>
                                            <td>{$cliente['Nombre']}</td>
                                            <td>{$cliente['Apellido']}</td>
                                            <td>{$cliente['Cedula']}</td>
                                            <td>{$cliente['Edad']}</td>
                                            <td>{$cliente['Correo']}</td>
                                            <td>
                                                <a href='{$rutaEditar}' class='btn btn-info glyphicon glyphicon-pencil'></a>
                                                <a href='{$rutaBorrar}' onclick='return confirm(\"¿Seguro que desea borrar el cliente?\")' class='btn btn-danger glyphicon glyphicon-trash'></a>   
                                            </td>
                                        </tr>
                                        ";
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <input type="button" id="btnBuscar" value="Graficar">

	<div id="contenedor_grafico">
		<canvas id="myChart" width="400" height="150"></canvas>
	</div>
<script>

var paramNombre = [];
var paramEdad = [];

$('#btnBuscar').click(function(){
 	$.post("<?php echo base_url();?>clienteController/getPersonas",
 		function(data){
 			var obj = JSON.parse(data);

 			paramNombre = [];
 			paramEdad = [];
 			$.each(obj, function(i,item){
 				paramNombre.push(item.Nombre);
 				paramEdad.push(item.Edad);
 			});
			
 			$('#myChart').remove();
 			$('#contenedor_grafico').append("<canvas id='myChart' width='400' height='150'></canvas>");

 			var ctx = $("#myChart");
 			var myChart = new Chart(ctx, {
 			    type: 'bar',
 			    data: {
 			    	labels: paramNombre, 
 			    	datasets: [
 			        	{
 				            label: "Edad",
 				            fill: true,
 				            lineTension: 0.1,
 				            backgroundColor: "#088A29",
 				            borderColor: "#088A29",
 				            borderCapStyle: 'butt',
 				            borderDash: [],
 				            borderDashOffset: 0.0,
 				            borderJoinStyle: 'miter',
 				            pointBorderColor: "#088A29",
 				            pointBackgroundColor: "#fff",
 				            pointBorderWidth: 10,
 				            pointHoverRadius: 5,
 				            pointHoverBorderWidth: 5,
 				            pointRadius: 1,
 				            pointHitRadius: 10,
 				            data: paramEdad, 
 				            spanGaps: false,
 				        }
 			    	]
 				},
 			    options: {
 			        scales: {
 			            yAxes: [{
 			                ticks: {
 			                    beginAtZero:true
 			                }
 			            }]
 			        }
 			    }
 			});
 		});
 });


</script>
</body>
</html>