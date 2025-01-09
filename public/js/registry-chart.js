class UserRegistryChart {
    constructor() {
        this.chartInstance = null;
    }

    async init () {
        await this.fetchRegistryData();
    }

    createChart(data) {
        const ctx = document.getElementById('UserRegistryChart').getContext('2d');

        if (this.chartInstance) {
            this.chartInstance.destroy();
        }

        this.chartInstance = new Chart(ctx, {
            type: 'line',
            data: {
                labels: data.dates,
                datasets: [{
                    label: 'Registered Users',
                    data: data.registeredUsers,
                    fill: true,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'User Registered Activity'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }

    async fetchRegistryData() {
        try {
            const response = await fetch('/api/user-activity');
            const data = await response.json();
            this.createChart(data);
        } catch (error) {
            console.error('Error fetching activity data:', error);
        }
    }

    async updateChart() {
        await this.fetchRegistryData();
    }
}

export default UserRegistryChart;