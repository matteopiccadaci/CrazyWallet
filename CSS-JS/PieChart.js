function newChart() {
    const data = {
        labels: stocks,
        datasets: [{
            label: 'My First Dataset',
            data: values,
            backgroundColor: [
                'rgb(255, 99, 132)',
                'rgb(54, 162, 235)',
                'rgb(255, 205, 86)',
                'rgb(255, 21, 89)',
                'rgb(25, 205, 86)',
                'rgb(155, 25, 86)',
                'rgb(25, 5, 86)',
                'rgb(105, 255, 240)',
                'rgb(105, 25, 86)',
                'rgb(105, 25, 255)',
                'rgb(120, 5, 0)',
                'rgb(2, 100, 0)',
                'rgb(29, 85, 86)',
                'rgb(9, 5, 255)',
                'rgb(88, 100, 100)',
                'rgb(164, 205, 86)',
                'rgb(164, 0, 788)'
            ],
            hoverOffset: 4
        }]
    };

    const config = {
        type: 'pie',
        data: data,
        options: {
            legend: {
                display: false
            },
            tooltips: {
                enabled: true
            }
        }
    };

    const myChart = new Chart(
        document.getElementById('myChart'),
        config
    );
}

// Si è usato il pie chart di chart.js. Come per il candlestick, è stato modificato il codice per far si che i dati vengano presi dall'API e si sono aggiunti dei background color per evitare che nella torta non venissero fuori delle porzioni grigie.