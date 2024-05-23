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
                    backgroundColor: 'pink',
                },
                {
                    label: 'Male Malay',
                    data: malesMalay,
                    backgroundColor: 'blue',
                },
                {
                    label: 'Female Bumi',
                    data: femalesBumi,
                    backgroundColor: 'pink',
                },
                {
                    label: 'Male Bumi',
                    data: malesBumi,
                    backgroundColor: 'blue',
                },
                {
                    label: 'Female Indian',
                    data: femalesIndian,
                    backgroundColor: 'pink',
                },
                {
                    label: 'Male Indian',
                    data: malesIndian,
                    backgroundColor: 'blue',
                },
                {
                    label: 'Female Chinese',
                    data: femalesChinese,
                    backgroundColor: 'pink',
                },
                {
                    label: 'Male Chinese',
                    data: malesChinese,
                    backgroundColor: 'blue',
                },
                {
                    label: 'Female Others',
                    data: femalesOthers,
                    backgroundColor: 'pink',
                },
                {
                    label: 'Male Others',
                    data: malesOthers,
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
