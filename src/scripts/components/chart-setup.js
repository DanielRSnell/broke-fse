/**
 * Chart.js Setup
 * Initializes Chart.js visualizations for eval metrics
 */

import { Chart, registerables } from 'chart.js';

// Register Chart.js components
Chart.register(...registerables);

export function initCharts() {
  // Eval Success Rate Chart
  const successRateCanvas = document.getElementById('successRateChart');
  if (successRateCanvas) {
    new Chart(successRateCanvas, {
      type: 'line',
      data: {
        labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
        datasets: [{
          label: 'Success Rate',
          data: [85, 88, 92, 95],
          borderColor: '#22c55e',
          backgroundColor: 'rgba(34, 197, 94, 0.1)',
          tension: 0.4,
          fill: true
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false
          }
        },
        scales: {
          y: {
            beginAtZero: true,
            max: 100,
            ticks: {
              callback: function(value) {
                return value + '%';
              }
            }
          }
        }
      }
    });
  }

  // Response Time Chart
  const responseTimeCanvas = document.getElementById('responseTimeChart');
  if (responseTimeCanvas) {
    new Chart(responseTimeCanvas, {
      type: 'bar',
      data: {
        labels: ['Fast', 'Medium', 'Slow'],
        datasets: [{
          label: 'Response Distribution',
          data: [65, 30, 5],
          backgroundColor: [
            '#22c55e',
            '#eab308',
            '#3b82f6'
          ]
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false
          }
        },
        scales: {
          y: {
            beginAtZero: true,
            ticks: {
              callback: function(value) {
                return value + '%';
              }
            }
          }
        }
      }
    });
  }
}
