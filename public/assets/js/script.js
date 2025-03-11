// script.js

// Auto-close the success message after 10 seconds
function autoCloseAlert() {
    setTimeout(function () {
        const alert = document.getElementById('success-alert');
        if (alert) {
            alert.classList.add('hide'); // Add the 'hide' class for fade-out
            setTimeout(() => alert.remove(), 500); // Remove after animation
        }
    }, 10000); // 10 seconds
}

// Close the alert manually when the close button is clicked
function setupCloseButton() {
    const closeButton = document.getElementById('close-alert');
    if (closeButton) {
        closeButton.addEventListener('click', function () {
            const alert = document.getElementById('success-alert');
            if (alert) {
                alert.classList.add('hide'); // Add the 'hide' class for fade-out
                setTimeout(() => alert.remove(), 500); // Remove after animation
            }
        });
    }
}

// Initialize ApexCharts for Department and Position Charts
function initializeCharts() {
    document.addEventListener("DOMContentLoaded", function () {
        // Data for the Department Chart
        const departmentChartData = {
            chart: {
                type: 'bar', // Bar chart type
                height: 350, // Chart height
            },
            series: [{
                name: 'Employees', // Series name
                data: window.departmentSeries || [] // Dynamic series data from backend
            }],
            xaxis: {
                categories: window.departmentCategories || [] // Dynamic categories from backend
            }
        };

        // Render the Department Chart
        const departmentChartElement = document.querySelector("#departmentChart");
        if (departmentChartElement) {
            const departmentChart = new ApexCharts(departmentChartElement, departmentChartData);
            departmentChart.render();
        }

        // Data for the Position Chart
        const positionChartData = {
            chart: {
                type: 'bar', // Bar chart type
                height: 350, // Chart height
            },
            series: [{
                name: 'Employees', // Series name
                data: window.positionSeries || [] // Dynamic series data from backend
            }],
            xaxis: {
                categories: window.positionCategories || [] // Dynamic categories from backend
            }
        };

        // Render the Position Chart
        const positionChartElement = document.querySelector("#positionChart");
        if (positionChartElement) {
            const positionChart = new ApexCharts(positionChartElement, positionChartData);
            positionChart.render();
        }
    });
}

// Call the functions
autoCloseAlert();
setupCloseButton();
initializeCharts();