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
				legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
				responsive: true
			});
        }
    });
}

// ============================================================== 
// Bar chart option
// ============================================================== 
var myChart = echarts.init(document.getElementById('bar-chart'));

// specify chart configuration item and dataHombre
option = {
    tooltip : {
        trigger: 'axis'
    },
    legend: {
        data:['Hombre','Mujer','Unisex']
    },
    toolbox: {
        show : true,
        feature : {
            
            magicType : {show: true, type: ['line', 'bar']},
            restore : {show: true},
            saveAsImage : {show: true}
        }
    },
    color: ["#55ce63", "#009efb","#8425BD"],
    calculable : true,
    xAxis : [
        {
            type : 'category',
            data : ['Jan','Feb','Mar','Apr','May','Jun','July','Aug','Sept','Oct','Nov','Dec']
        }
    ],
    yAxis : [
        {
            type : 'value'
        }
    ],
    series : [
        {
            name:'Hombre',
            type:'bar',
            data:[2.0, 4.9, 7.0, 23.2, 25.6, 76.7, 135.6, 162.2, 32.6, 20.0, 6.4, 3.3],
            markPoint : {
                data : [
                    {type : 'max', name: 'Max'},
                    {type : 'min', name: 'Min'}
                ]
            },
            markLine : {
                data : [
                    {type : 'average', name: 'Average'}
                ]
            }
        },
        {
            name:'Mujer',
            type:'bar',
            data:[2.6, 5.9, 9.0, 26.4, 28.7, 70.7, 175.6, 182.2, 48.7, 18.8, 6.0, 2.3],
            markPoint : {
                data : [
                    {name : 'The highest year', value : 182.2, xAxis: 7, yAxis: 183, symbolSize:18},
                    {name : 'Year minimum', value : 2.3, xAxis: 11, yAxis: 3}
                ]
            },
            markLine : {
                data : [
                    {type : 'average', name : 'Average'}
                ]
            }
        },
        {
            name:'Unisex',
            type:'bar',
            data:[46,395,207,421,463,308,365,178,345,7],
            markPoint : {
                data : [
                    {name : 'The highest year', value : 182.2, xAxis: 7, yAxis: 183, symbolSize:18},
                    {name : 'Year minimum', value : 2.3, xAxis: 11, yAxis: 3}
                ]
            },
            markLine : {
                data : [
                    {type : 'average', name : 'Average'}
                ]
            }
        }
    ]
};
                    

// use configuration item and data specified to show chart
myChart.setOption(option, true), $(function() {
            function resize() {
                setTimeout(function() {
                    myChart.resize()
                }, 100)
            }
            $(window).on("resize", resize), $(".sidebartoggler").on("click", resize)
        });




