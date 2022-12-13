$(function () {
    "use strict";
	console.log("cargando Reportes");

	var ctx4 = document.getElementById("chart4").getContext("2d");	   
    var data4 = [];

	var bgColor = [
		{color:"#2f3d4a",highlight: "#2f3d4a",},
		{color:"#009efb",highlight: "#009efb",},
		{color:"#55ce63",highlight: "#55ce63",}
	];


		$.ajax({
			type: 'ajax',
			method: 'get',
			url: 'donut_generostock',
			async: false,
			dataType: 'json',
			success: function(data){  

				for (var i in data['x_genero']) {
					data4.push({
						label: data['x_genero'][i].genero.toUpperCase(),
						value: data['x_genero'][i].total,
						color:bgColor[i].color,
						highlight: bgColor[i].highlight,
					});
					//console.log(bgColor[i].color);
				}		
							
			},
			error: function(){
			alert('No se pudo cargar los datos');
			}
		});

		var myDoughnutChart = new Chart(ctx4).Doughnut(data4,{
			segmentShowStroke : true,
			segmentStrokeColor : "#fff",
			segmentStrokeWidth : 0,
			animationSteps : 100,
			tooltipCornerRadius: 2,
			animationEasing : "easeOutBounce",
			animateRotate : true,
			animateScale : false,
			legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>",
			responsive: true
		});


/** graficas de barras */

datagrafico();


});


function datagrafico(){
    namesMonth= ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul","Aug","Sept","Oct","Nov","Dec"];
    $.ajax({
        url: "ventas_mensual",
        type:"get",
        //data:{year: year},
        dataType:"json",
        success:function(data){
            var meses = new Array();
         	//creo un array de 12 posiciones
            var montos = new Array(12);
			//relleno el array con ceros
			montos.fill(0,0);

            $.each(data,function(key, value){
                meses.push(namesMonth[value.mes - 1]);
                valor = Number(value.monto);
               //montos.push(valor);
			   //reemplazo la posicion con la del mes y el valor
			    montos.splice(value.mes - 1, 1, valor);
			
            });

			var ctx2 = document.getElementById("chart2").getContext("2d"); 
			var data2 = {
				labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul","Aug","Sept","Oct","Nov","Dec"],
				datasets: [
					{
						label: "VENTAS",
						fillColor: "#009efb",
						strokeColor: "#009efb",
						highlightFill: "#009efb",
						highlightStroke: "#009efb",
						data: []
					}
					
				]
			};
          
			
			data2.datasets.map(function(dato){							
				  dato.data = montos;
				return dato;
			  });
			
		 	console.log({meses,valor,montos});
			 
			var chart2 = new Chart(ctx2).Bar(data2, {
				scaleBeginAtZero : true,
				scaleShowGridLines : true,
				scaleGridLineColor : "rgba(0,0,0,.005)",
				scaleGridLineWidth : 0,
				scaleShowHorizontalLines: true,
				scaleShowVerticalLines: true,
				barShowStroke : true,
				barStrokeWidth : 0,
				tooltipCornerRadius: 2,
				barDatasetSpacing : 3,
				legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%>$<%=datasets[i].label%><%}%></li><%}%></ul>",
				responsive: true
			});
        }
    });
}




