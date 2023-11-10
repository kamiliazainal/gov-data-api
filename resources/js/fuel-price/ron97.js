import Chart from 'chart.js/auto';
import axios from "axios";

axios.get('/api/fuel-price/ron97')
  .then(response => {
    const data = response.data;
    const labels = data.labels;
    const dataset = {
                        label: 'Fuel Price Ron 97',
                        backgroundColor: 'green',
                        borderColor: 'green',
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
        document.getElementById('ron97'),
        config
    );
  })
  .catch(error => {
    console.log(error);
  });
