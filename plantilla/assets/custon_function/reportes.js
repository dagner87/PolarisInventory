$(function () {
    "use strict";
	console.log("cargando Reportes");

var ctx4 = document.getElementById("chart4").getContext("2d");
var data4 = [
	{
		value: 50,
		color:"#2f3d4a",
		highlight: "#2f3d4a",
		label: "Men"
	},
	{
		value: 70,
		color: "#009efb",
		highlight: "#009efb",
		label: "Woman"
	},
	{
		value: 30,
		color: "#55ce63",
		highlight: "#55ce63",
		label: "Unisex"
	}
];

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
