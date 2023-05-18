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

      // Llamada a la función para obtener el JSON
      var jsonData = obtenerDatos();

      // Parsea los datos del JSON
      var chartData = Object.entries(jsonData).map(function ([key, value]) {
        var data = [];
        for (var mes in meses) {
          var monto = value.find(function (item) {
            return item.mes === mes;
          });
          data.push([meses[mes], monto ? monto.monto : 0]);
        }
        return {
          name: key,
          data: data,
        };
      });

      // Inicializa el gráfico
      var chart = echarts.init(document.getElementById("chart-container"));

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
          data: Object.keys(jsonData),
        },
        xAxis: {
          type: "category",
        },
        yAxis: {},
        series: chartData.map(function (item) {
          return {
            name: item.name,
            type: "bar",
            data: item.data,
            markPoint: {
              data: [
                { type: "max", name: "Máximo" },
                { type: "min", name: "Mínimo" },
              ],
            },
          };
        }),
      };

      // Dibuja el gráfico con las opciones configuradas
      chart.setOption(options);
	  

});

  // Función que devuelve el JSON
  function obtenerDatos() {
	// Aquí colocas tu lógica para obtener el JSON
	return {
	  hombre: [
		{
		  mes: "1",
		  monto: "85",
		},
		{
		  mes: "2",
		  monto: "310",
		},
		{
		  mes: "3",
		  monto: "50",
		},
		{
		  mes: "4",
		  monto: "70",
		},
		{
		  mes: "5",
		  monto: "280",
		},
	  ],
	  mujer: [
		{
		  mes: "1",
		  monto: "150",
		},
		{
		  mes: "2",
		  monto: "40",
		},
		{
		  mes: "4",
		  monto: "120",
		},
		{
		  mes: "5",
		  monto: "130",
		},
	  ],
	  unisex: [
		{
		  mes: "1",
		  monto: "50",
		},
		{
		  mes: "2",
		  monto: "50",
		},
		{
		  mes: "3",
		  monto: "210",
		},
	  ],
	};
  }

