import Chart from 'chart.js/auto';
import axios from "axios";

axios.get('/api/population/gender')
    .then(response => {
        const labels = ['Female', 'Male'];
        // const labels = response.data.labels;
        // const dataset = {
        //     label: 'Gender Population',
        //     backgroundColor: ['pink', 'blue'],
        //     borderColor: ['pink', 'blue'],
        //     data: data.data,
        //     borderWidth: 1
        // };

        const data = {
            labels: labels,
            datasets: [{
                label: 'Gender Population',
                data: response.data.data,
                backgroundColor: ['pink', 'blue'],
                borderColor: ['pink', 'blue'],
                borderWidth: 1
            }]
        };

        const config = {
            type: 'bar',
            data: data,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            },
        };

        new Chart(
            document.getElementById('genderPopulation'),
            config
        );
    })
    .catch(error => {
        console.log(error);
    });
