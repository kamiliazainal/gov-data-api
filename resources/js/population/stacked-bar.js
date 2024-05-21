import Chart from 'chart.js/auto';
import axios from "axios";

axios.get('/api/population/date-gender')
    .then(response => {
        console.log(response.data.labels);
        const labels = response.data.labels;

        const female = labels.filter((label) => label == 'female');
        const male = labels.filter((label) => label == 'male');

        const dataResponse = response.data.data;
        let years = [];

        for (let i = 0; i < dataResponse.length; i++) {
            const element = dataResponse[i];
            const date = new Date(element);
            years.push(date.getFullYear());

            const test = labels.filter((label) => label == 'female');
            console.log(test);
        }

        const distinctYears = [ ...new Set(years)];

        console.log(distinctYears,female.length);

        const data = {
            labels: distinctYears,
            datasets: [
                {
                    label: 'Female',
                    data: female.length,
                    backgroundColor: 'pink',
                  },
                  {
                    label: 'Male',
                    data: male.length,
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
            document.getElementById('dateGender'),
            config
        );
    })
    .catch(error => {
        console.log(error);
    });
