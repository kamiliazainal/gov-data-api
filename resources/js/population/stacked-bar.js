import Chart from 'chart.js/auto';
import axios from "axios";

axios.get('/api/population/date-gender')
    .then(response => {
        const labels = response.data.labels;
        const males = response.data.males;
        const females = response.data.females

        const data = {
            labels: labels,
            datasets: [
                {
                    label: 'Female',
                    data: females,
                    backgroundColor: 'pink',
                  },
                  {
                    label: 'Male',
                    data: males,
                    backgroundColor: 'blue',
                  },
            ]
        };

        const config = {
            type: 'bar',
            data: data,
            options: {
                plugins: {
                    title: {
                        display: true,
                        text: 'Year x Gender'
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                // Do not return a label here to avoid redundancy
                                return '';
                            },
                            afterBody: function(tooltipItems) {
                                let dataIndex = tooltipItems[0].dataIndex;

                                // Find the counts for male and female for the specific year
                                let maleCount = data.datasets[1].data[dataIndex];
                                let femaleCount = data.datasets[0].data[dataIndex];

                                return [
                                    'Male: ' + maleCount,
                                    'Female: ' + femaleCount,
                                    'Total: ' + (maleCount + femaleCount)
                                ];
                            },
                        }
                      },
                },
                responsive: true,
                scales: {
                    x: {
                        stacked: true,
                    },
                    y: {
                        stacked: true
                    }
                }
            }
        };

        new Chart(
            document.getElementById('dateGender').getContext('2d'),
            config
        );
    })
    .catch(error => {
        console.log(error);
    });