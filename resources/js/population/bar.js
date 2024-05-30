import Chart from 'chart.js/auto';
import axios from "axios";

axios.get('/api/population/gender')
    .then(response => {
        const labels = ['Female', 'Male'];

        const female = response.data.data[0].toFixed(0);
        const male = response.data.data[1].toFixed(0);

        const totalPopulation = [female,male];

        const data = {
            labels: labels,
            datasets: [{
                label: 'Gender Population',
                data: totalPopulation,
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
