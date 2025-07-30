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
$(function () {
  const chart = {
    series: [
      {
        name: "Produk",
        data: getMonthlyProductCount, // data dari blade
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
      tickAmount: 5,
      labels: {
        formatter: function (val) {
          return val.toLocaleString(); // hanya angka, bukan "Rp"
        },
      },
    },
    tooltip: {
      y: {
        formatter: function (val) {
          return val.toLocaleString() + " produk";
        },
      },
      theme: "dark",
    },
  };

  const chartRender = new ApexCharts(
    document.querySelector("#produk-overview"),
    chart
  );
  chartRender.render();
});


$(function () {
  const chart = {
    series: [
      {
        name: "Jumlah order",
        data: getDailyOrderCount, // array dengan 31 elemen, sesuai tanggal
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
      categories: Array.from({ length: 31 }, (_, i) => (i + 1).toString()), // ['1', '2', ..., '31']
      axisBorder: { show: false },
      axisTicks: { show: false },
    },
    yaxis: {
      tickAmount: 4,
      labels: {
        formatter: function (val) {
          return val.toLocaleString(); // hanya angka, bukan "Rp"
        },
      },
    },
    tooltip: {
      y: {
        formatter: function (val) {
          return val.toLocaleString() + " order";
        },
      },
      theme: "dark",
    },
  };

  const chartRender = new ApexCharts(
    document.querySelector("#order-overview"),
    chart
  );
  chartRender.render();
});
$(function () {
  const chart = {
    series: [
      {
        name: "Jumlah user",
        data: getDailyUserCount, // array dengan 31 elemen, sesuai tanggal
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
      categories: Array.from({ length: 31 }, (_, i) => (i + 1).toString()), // ['1', '2', ..., '31']
      axisBorder: { show: false },
      axisTicks: { show: false },
    },
    yaxis: {
      tickAmount: 4,
      labels: {
        formatter: function (val) {
          return val.toLocaleString(); // hanya angka, bukan "Rp"
        },
      },
    },
    tooltip: {
      y: {
        formatter: function (val) {
          return val.toLocaleString() + " user";
        },
      },
      theme: "dark",
    },
  };

  const chartRender = new ApexCharts(
    document.querySelector("#user-overview"),
    chart
  );
  chartRender.render();
});

