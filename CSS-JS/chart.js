function chart(stocks){
    var options = {
          series: [{
            data:stocks
        }],
          chart: {
          type: 'candlestick',
          height: 350
        },
        title: {
          text: '', /* vuoto, altrimenti comprarirebbe la scritta di default anche rimuovendo il tag */
          align: 'left'
        },
        xaxis: {
          type: 'datetime'
        },
        yaxis: {
          tooltip: {
            enabled: true
          }
        }
        };
        var chart = new ApexCharts(document.querySelector("#chart"), options)
        chart.render();
}
/* Il presente file JavaScript, utile a generare un grafico a candela, è una modifica di quello reperibile al seguente link: https://apexcharts.com/javascript-chart-demos/candlestick-charts/basic/.
La modifica coniste nel trasferire i dati ottenuti dall'API in quanto, inizalmente, sono presenti dei valori di default.*/
      
    