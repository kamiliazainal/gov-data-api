import Chart from 'chart.js/auto';
import axios from "axios";

axios.get('/api/population/date-gender-race')
    .then(response => {
        const labels = response.data.labels;
        const malesMalay = response.data.malesMalay;
        const femalesMalay = response.data.femalesMalay
        const malesBumi = response.data.malesBumi;
        const femalesBumi = response.data.femalesBumi
        const malesIndian = response.data.malesIndian;
        const femalesIndian = response.data.femalesIndian
        const malesChinese = response.data.malesChinese;
        const femalesChinese = response.data.femalesChinese
        const malesOthers = response.data.malesOthers;
        const femalesOthers = response.data.femalesOthers

        const data = {
            labels: labels,
            datasets: [
                {
                    label: 'Female Malay',
                    data: femalesMalay,
                    backgroundColor: '#D5D8DC',
                },
                {
                    label: 'Male Malay',
                    data: malesMalay,
                    backgroundColor: '#566573',
                },
                {
                    label: 'Female Bumi',
                    data: femalesBumi,
                    backgroundColor: '#F6DDCC',
                },
                {
                    label: 'Male Bumi',
                    data: malesBumi,
                    backgroundColor: '#DC7633',
                },
                {
                    label: 'Female Indian',
                    data: femalesIndian,
                    backgroundColor: '#FCF3CF',
                },
                {
                    label: 'Male Indian',
                    data: malesIndian,
                    backgroundColor: '#F5B041',
                },
                {
                    label: 'Female Chinese',
                    data: femalesChinese,
                    backgroundColor: '#D5F5E3',
                },
                {
                    label: 'Male Chinese',
                    data: malesChinese,
                    backgroundColor: '#58D68D',
                },
                {
                    label: 'Female Others',
                    data: femalesOthers,
                    backgroundColor: '#D6EAF8',
                },
                {
                    label: 'Male Others',
                    data: malesOthers,
                    backgroundColor: '#5DADE2',
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
                        text: 'Year x Gender x Race'
                    },
                },
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            format: { maximumFractionDigits: 2, minimumFractionDigits: 2 }
                          }
                    }
                }
            }
        };

        new Chart(
            document.getElementById('dateGenderRace').getContext('2d'),
            config
        );
    })
    .catch(error => {
        console.log(error);
    });
