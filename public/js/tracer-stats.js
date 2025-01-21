let bentukLembagaChart;

async function fetchBentukLembagaStats() {
    try {
        const response = await fetch('/api/tracer/bentuk-lembaga-stats');
        const data = await response.json();
        
        // Data untuk chart
        const chartData = {
            labels: data.map(item => item.bentuk_lembaga),
            datasets: [{
                data: data.map(item => item.total),
                backgroundColor: [
                    '#4e73df', // Primary
                    '#1cc88a', // Success
                    '#36b9cc', // Info
                    '#f6c23e'  // Warning
                ],
                hoverBackgroundColor: [
                    '#2e59d9',
                    '#17a673',
                    '#2c9faf',
                    '#dda20a'
                ],
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            }]
        };

        // Buat chart
        const ctx = document.getElementById('bentukLembagaChart').getContext('2d');
        
        // Hancurkan chart lama jika ada
        if (bentukLembagaChart) {
            bentukLembagaChart.destroy();
        }

        // Buat chart baru
        bentukLembagaChart = new Chart(ctx, {
            type: 'doughnut',
            data: chartData,
            options: {
                maintainAspectRatio: false,
                tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    caretPadding: 10,
                },
                legend: {
                    display: false
                },
                cutoutPercentage: 80,
            },
        });

        // Setup download handlers
        setupDownloadHandlers(bentukLembagaChart);

    } catch (error) {
        console.error('Error fetching bentuk lembaga stats:', error);
    }
}

function setupDownloadHandlers(chart) {
    // Download as PNG
    document.getElementById('downloadPNG').addEventListener('click', function() {
        const link = document.createElement('a');
        link.download = 'bentuk-lembaga-chart.png';
        link.href = chart.canvas.toDataURL('image/png');
        link.click();
    });

    // Download as PDF (requires html2canvas and jsPDF)
    document.getElementById('downloadPDF').addEventListener('click', function() {
        const canvas = chart.canvas;
        const imgData = canvas.toDataURL('image/png');
        const pdf = new jsPDF();
        pdf.addImage(imgData, 'PNG', 10, 10);
        pdf.save('bentuk-lembaga-chart.pdf');
    });
}

// Refresh chart setiap 5 menit
setInterval(fetchBentukLembagaStats, 300000);

// Panggil fungsi saat halaman dimuat
document.addEventListener('DOMContentLoaded', fetchBentukLembagaStats); 