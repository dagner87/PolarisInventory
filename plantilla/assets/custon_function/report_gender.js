$(function () {
    "use strict";


	 // Mapeo de números de mes a nombres de mes
	 var meses = {
       
		1:"Jan",
		2 :"Feb",
		3:"Mar",
		4:"Apr",
		5:"May",
		/* 6:"Jun",
		7:"July",
		8:"Aug",
		9:"Sept",
		10:"Oct",
		11:"Nov",
		12:"Dec" */
      };

	   // Función de devolución de llamada para manejar los datos obtenidos
	   function handleData(jsonData) {
		// Parsea los datos del JSON
		var chartData = Object.entries(jsonData).map(function([key, value]) {
		  var data = [];
		  for (var mes in meses) {
			var monto = value.find(function(item) {
			  return item.mes === mes;
			});
			data.push([meses[mes], monto ? monto.monto : 0]);
		  }
		  return {
			name: key,
			data: data
		  };
		});
  
		// Inicializa el gráfico
		var chart = echarts.init(document.getElementById('chart-container'));
  
		// Configura las opciones del gráfico
		var options = {
			title: {
				text: "Gráfico de Ventas por Genero",
			  },
			  tooltip : {
				  trigger: 'axis'
			  },
			  toolbox: {
				  show : true,
				  feature : {
					  
					  magicType : {show: true, type: ['line', 'bar']},
					  restore : {show: true},
					  saveAsImage : {show: true}
				  }
			  },
		  calculable : true,
		  color: ["#55ce63", "#009efb","#8425BD"],
		  legend: {
			data: Object.keys(jsonData)
		  },
		  xAxis: {
			type: 'category'
		  },
		  yAxis: {},
		  series: chartData.map(function(item) {
			return {
			  name: item.name,
			  type: 'bar',
			  data: item.data,
			  markPoint: {
				data: [
				  {type: 'max', name: 'Máximo'},
				  {type: 'min', name: 'Mínimo'}
				]
			  }
			};
		  })
		};
  
		// Dibuja el gráfico con las opciones configuradas
		chart.setOption(options);
	  }
  
	  // Llamada a la función para obtener los datos mediante AJAX
	  obtenerDatosAjax("r_m_gender", handleData);
  
	  // Función para obtener los datos del archivo PHP mediante AJAX
	  function obtenerDatosAjax(url, callback) {
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
		  if (this.readyState === 4 && this.status === 200) {
			var jsonData = JSON.parse(this.responseText);
			callback(jsonData);
		  }
		};
		xhttp.open("GET", url, true);
		xhttp.send();
	  }
  
	 
});

