$(function () {
  const chart = {
    series: [
      {
        name: "Pendapatan",
        data: monthlyRevenue, // data dari blade
      },
    ],
    chart: {
      toolbar: {
        show: false,
      },
      type: "line",
      height: 320,
      stacked: false,
      fontFamily: "inherit",
      foreColor: "#adb0bb",
    },
    colors: ["var(--bs-primary)"],
    dataLabels: {
      enabled: false,
    },
    legend: {
      show: false,
    },
    stroke: {
      width: 3,
      curve: "smooth",
    },
    grid: {
      borderColor: "rgba(0,0,0,0.1)",
      strokeDashArray: 3,
    },
    xaxis: {
      categories: [
        "Jan", "Feb", "Mar", "Apr", "Mei", "Jun",
        "Jul", "Agu", "Sep", "Okt", "Nov", "Des"
      ],
      axisBorder: { show: false },
      axisTicks: { show: false },
    },
    yaxis: {
      tickAmount: 4,
      labels: {
        formatter: function (val) {
          return "Rp " + val.toLocaleString();
        },
      },
    },
    tooltip: {
      y: {
        formatter: function (val) {
          return "Rp " + val.toLocaleString();
        },
      },
      theme: "dark",
    },
  };

  const chartRender = new ApexCharts(
    document.querySelector("#traffic-overview"),
    chart
  );
  chartRender.render();
});
