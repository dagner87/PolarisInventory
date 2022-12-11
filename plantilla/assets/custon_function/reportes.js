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

});
