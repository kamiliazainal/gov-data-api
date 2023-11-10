import Chart from 'chart.js/auto';
import axios from "axios";

axios.get('/api/fuel-price/diesel')
  .then(response => {
    const data = response.data;
    const labels = data.labels;
    const dataset = {
                        label: 'Fuel Price Diesel',
                        backgroundColor: 'silver',
                        borderColor: 'silver',
                        data: data.data,
                    };

    const config = {
                        type: 'line',
                        data: {
                            labels: labels,
                            datasets: [dataset],
                        },
                        options: {},
                    };

    new Chart(
        document.getElementById('diesel'),
        config
    );
  })
  .catch(error => {
    console.log(error);
  });
