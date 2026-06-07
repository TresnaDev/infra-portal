import Alpine from 'alpinejs'
import ApexCharts from 'apexcharts'

window.Alpine = Alpine
window.ApexCharts = ApexCharts

// Global ApexCharts Configuration for InfraPortal Theme
window.Apex = {
    chart: {
        fontFamily: 'Plus Jakarta Sans, sans-serif',
        toolbar: { show: false },
        animations: { enabled: true, dynamicAnimation: { speed: 400 } }
    },
    colors: ['#0C0C0C', '#363636', '#B0B0B0'],
    stroke: { curve: 'smooth', width: 2 },
    grid: {
        borderColor: '#E2E2E2',
        strokeDashArray: 4,
        padding: { top: 0, right: 0, bottom: 0, left: 10 }
    },
    dataLabels: { enabled: false },
    tooltip: { theme: 'dark' }
};

Alpine.start()