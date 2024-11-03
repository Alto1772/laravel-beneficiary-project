'use strict';

(function () {
  let cardColor, headingColor, legendColor, labelColor, shadeColor, borderColor;

  cardColor = config.colors.cardColor;
  headingColor = config.colors.headingColor;
  legendColor = config.colors.bodyColor;
  labelColor = config.colors.textMuted;
  borderColor = config.colors.borderColor;

  const ageChartEl = document.getElementById('ageChart'),
    ageChartOptions = {
      chart: {
        height: 350,
        type: 'bar',
        toolbar: { show: false },
        zoom: { enabled: false }
      },
      plotOptions: {
        // bar: { borderRadius: 2, startingShape: 'rounded', endingShape: 'rounded' }
      },
      colors: [config.colors.info, config.colors.danger, config.colors.primary],
      dataLabels: {
        enabled: false
      },
      grid: {
        strokeDashArray: 7,
        borderColor: borderColor,
        padding: {
          top: 0,
          bottom: 0,
          left: 20,
          right: 20
        }
      },
      fill: {
        opacity: [1, 1]
      },
      xaxis: {
        labels: {
          style: {
            fontSize: '13px',
            fontFamily: 'Public Sans',
            colors: labelColor
          }
        },
        axisTicks: {
          show: false
        },
        axisBorder: {
          show: false
        }
      },
      yaxis: {
        labels: {
          style: {
            fontSize: '13px',
            fontFamily: 'Public Sans',
            colors: labelColor
          }
        }
      },
      series: [],
      noData: {
        text: 'Loading...',
        style: {
          fontSize: '1.7em',
          fontFamily: 'Public Sans',
          fontWeight: 500,
          color: labelColor
        }
      }
    };
  var ageChart = new ApexCharts(ageChartEl, ageChartOptions);
  ageChart.render();

  const barangayChartEl = document.getElementById('barangayChart'),
    barangayChartOptions = {
      chart: {
        height: 350,
        type: 'bar',
        toolbar: { show: false },
        zoom: { enabled: false }
      },
      plotOptions: {
        bar: { borderRadius: 4, startingShape: 'rounded', endingShape: 'rounded' }
      },
      colors: [config.colors.success, config.colors.primary, config.colors.danger],
      dataLabels: {
        enabled: false
      },
      grid: {
        strokeDashArray: 7,
        borderColor: borderColor,
        padding: { top: 0, bottom: 0, left: 20, right: 20 }
      },
      fill: {
        opacity: [1, 1]
      },
      xaxis: {
        labels: {
          style: {
            fontSize: '13px',
            fontFamily: 'Public Sans',
            colors: labelColor
          }
        },
        axisTicks: { show: false },
        axisBorder: { show: false }
      },
      yaxis: {
        labels: {
          style: {
            fontSize: '13px',
            fontFamily: 'Public Sans',
            colors: labelColor
          }
        }
      },
      series: [],
      noData: {
        text: 'Loading...',
        style: {
          fontSize: '1.7em',
          fontFamily: 'Public Sans',
          fontWeight: 500,
          color: labelColor
        }
      }
    };
  var barangayChart = new ApexCharts(barangayChartEl, barangayChartOptions);
  barangayChart.render();

  const setNoDataText = text => {
    ageChart.updateOptions({ noData: { text: text } });
    barangayChart.updateOptions({ noData: { text: text } });
  };

  const populateCharts = (data, year = null) => {
    const barangays = data.barangays,
      ageGroups = data.ageGroups;

    setNoDataText('No Data');

    const barangayChartData = Object.keys(barangays).map(key => ({
        name: key,
        data: barangays[key].map(item => ({ x: item.name, y: item.count }))
      })),
      ageChartData = Object.keys(ageGroups).map(key => ({
        name: key,
        data: ageGroups[key].map(item => ({ x: item.age, y: item.count }))
      }));
    ageChart.updateSeries(ageChartData);
    barangayChart.updateSeries(barangayChartData);
  };
  fetch('/api/analytics', {
    method: 'GET',
    headers: { 'Content-Type': 'application/json' },
    credentials: 'same-origin'
  })
    .then(response => response.json())
    .then(data => populateCharts(data))
    .catch(err => {
      setNoDataText('Error fetching analytics');
      console.error('Error fetching analytics:', err);
    });

  document.querySelectorAll('#expandGraphButton').forEach(el => {
    el.addEventListener('click', () => {
      const graphContainer = el.closest('.graph-container');

      graphContainer.classList.toggle('graph-expanded');
    });
  });
})();
