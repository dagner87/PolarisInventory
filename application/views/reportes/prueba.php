<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Gráfico ECharts</title>
  <!-- Incluye la biblioteca ECharts -->
  <script src="https://cdn.jsdelivr.net/npm/echarts/dist/echarts.min.js"></script>
</head>
<body>
  <!-- Contenedor del gráfico -->
  <div id="chart-container" style="width: 100%; height: 400px;"></div>

  <script>
    // Mapeo de números de mes a nombres de mes
    var meses = {
      "1": "Enero",
      "2": "Febrero",
      "3": "Marzo",
      "4": "Abril",
      "5": "Mayo"
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
          text: 'Gráfico de ejemplo'
        },
        tooltip: {},
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
  </script>
</body>
</html>
