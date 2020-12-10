var ctx = document.getElementById('myChart').getContext('2d');
var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'bar',

    // The data for our dataset
    data: {
        labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei'],
        datasets: [{
            label: 'MOS : Microsoft Office Specialist',
            backgroundColor: 'rgb(0, 85, 255, 0.6)',
            borderColor: 'rgb(255, 255, 255)',
            fill: false,
            data: [3, 15, 13, 8, 20]
        }, {
            label: 'MTA : Microsft Technology Associate',
            backgroundColor: 'rgb(26, 255, 0, 0.6)',
            borderColor: 'rgb(46, 219, 86)',
            fill: false,
            data: [1, 4, 3, 9, 15]
        }, {
            label: 'MCE : Microsoft Certified Educator',
            backgroundColor: 'rgb(54, 185, 204, 0.6)',
            borderColor: 'rgb(54, 185, 204)',
            fill: false,
            data: [2, 10, 5, 20, 8]
        }, {
            label: 'MTA : Microsft Technical Certifications',
            backgroundColor: 'rgb(246, 194, 62, 0.6)',
            borderColor: 'rgb(255, 194, 62)',
            fill: false,
            data: [10, 3, 6, 1, 4]
        }]
    },

    // Configuration options go here
    options: {
        scales: {
            xAxes: [{
                scaleLabel: {
                    display: true,
                    labelString: 'Bulan'
                }
            }],
            yAxes: [{
                scaleLabel: {
                    display: true,
                    labelString: 'Peserta'
                }
            }]
        }
    }
});