// -------------------------------------------------------------------------------------------------------------------------------------------
// Dashboard 5 : Chart Init Js
// -------------------------------------------------------------------------------------------------------------------------------------------
document.addEventListener("DOMContentLoaded", function () {

  // -----------------------------------------------------------------------
  // Realtime chart
  // -----------------------------------------------------------------------

  // -----------------------------------------------------------------------
  // Ample vs Pixel
  // -----------------------------------------------------------------------

  var sales_of_ample_vs_pixel = {
    series: [
      {
        name: "Growth ",
        data: [0, 1, 1, 10, 24, 6, 12, 4, 21, 15, 44, 24, 28, 4, 10, 21, 5, 47],
      },
      {
        name: "Loss ",
        data: [
          0, 4, 3, 24, 9, 10, 18, 15, 44, 17, 19, 26, 31, 8, 37, 10, 24, 51,
        ],
      },
    ],
    chart: {
      height: 350,
      type: "area",
      stacked: false,
      fontFamily: "inherit",
      zoom: {
        enabled: false,
      },
      toolbar: {
        show: false,
      },
    },
    colors: ["rgba(38, 198, 218, 0.7)", "rgba(38, 198, 218, 0.1)"],
    dataLabels: {
      enabled: false,
    },
    stroke: {
      show: false,
    },
    markers: {
      size: 2,
      strokeColors: "transparent",
      colors: "#26c6da",
    },
    fill: {
      type: "solid",
      colors: ["rgba(38, 198, 218, 0.7)", "rgba(38, 198, 218, 0.4)"],
      opacity: 1,
    },
    grid: {
      strokeDashArray: 3,
      borderColor: "rgba(0,0,0,0.2)",
    },
    xaxis: {
      axisBorder: {
        show: false,
      },
      axisTicks: {
        show: false,
      },
      categories: [
        "0",
        "4",
        "8",
        "12",
        "16",
        "20",
        "24",
        "30",
        "16",
        "20",
        "24",
        "30",
        "34",
        "38",
        "42",
        "46",
        "50",
        "54",
      ],
      labels: {
        style: {
          colors: "#a1aab2",
        },
      },
    },
    yaxis: {
      labels: {
        style: {
          colors: "#a1aab2",
        },
      },
    },
    legend: {
      show: false,
    },
    tooltip: {
      theme: "dark",
      marker: {
        show: true,
      },
    },
  };

  var chart_line_overview = new ApexCharts(
    document.querySelector("#sales-of-ample-vs-pixel"),
    sales_of_ample_vs_pixel
  );
  chart_line_overview.render();

  // -----------------------------------------------------------------------
  // Badnwidth usage
  // -----------------------------------------------------------------------

  var option_Bandwidth_usage = {
    series: [
      {
        name: "",
        labels: ["0", "4", "8", "12", "16", "20", "24", "30"],
        data: [0,8,12,10,6,8,15,23],
      },
    ],
    chart: {
      height: 82,
      type: "line",
      foreColor: "#adb0bb",
      toolbar: {
        show: false,
      },
      sparkline: {
        enabled: true,
      },
    },
    colors: ["#fff"],
    fill: {
      type: "solid",
      opacity: 1,
      colors: ["#fff"],
    },
    grid: {
      show: false,
    },
    stroke: {
      curve: "smooth",
      lineCap: "square",
      colors: ["#fff"],
      width: 2,
    },
    markers: {
      size: 0,
      colors: ["#fff"],
      strokeColors: "transparent",
      shape: "square",
      hover: {
        size: 7,
      },
    },
    xaxis: {
      axisBorder: {
        show: false,
      },
      axisTicks: {
        show: false,
      },
      labels: {
        show: false,
      },
    },
    yaxis: {
      labels: {
        show: false,
      },
    },
    tooltip: {
      theme: "dark",
      style: {
        fontSize: "10px",
        fontFamily: "inherit",
      },
      x: {
        show: false,
      },
      y: {
        formatter: undefined,
      },
      marker: {
        show: true,
      },
      followCursor: true,
    },
  };

  var chart_line_basic = new ApexCharts(
    document.querySelector("#bandwidth-usage"),
    option_Bandwidth_usage
  );
  chart_line_basic.render();
  // -----------------------------------------------------------------------
  // Download count
  // -----------------------------------------------------------------------

  var option_Download_count = {
    series: [
      {
        name: "",
        data: [4, 5, 2, 10, 9, 12, 4, 9, 4, 5, 3, 10],
      },
    ],
    chart: {
      type: "bar",
      fontFamily: "inherit",
      height: 82,
      foreColor: "#adb0bb",
      toolbar: {
        show: false,
      },
      sparkline: {
        enabled: true,
      },
    },
    colors: ["rgba(255, 255, 255, 0.7)"],
    grid: {
      show: false,
    },
    plotOptions: {
      bar: {
        horizontal: false,
        startingShape: "flat",
        endingShape: "flat",
        columnWidth: "60%",
        barHeight: "100%",
        borderRadius: 2,
      },
    },
    dataLabels: {
      enabled: false,
    },
    stroke: {
      show: true,
      width: 4,
      colors: ["transparent"],
    },
    xaxis: {
      axisBorder: {
        show: false,
      },
      axisTicks: {
        show: false,
      },
      labels: {
        show: false,
      },
    },
    yaxis: {
      labels: {
        show: false,
      },
    },
    axisBorder: {
      show: false,
    },
    fill: {
      opacity: 1,
    },
    tooltip: {
      theme: "dark",
      style: {
        fontSize: "12px",
        fontFamily: "inherit",
      },
      x: {
        show: false,
      },
      y: {
        formatter: undefined,
      },
    },
  };

  var chart_column_basic = new ApexCharts(
    document.querySelector("#download-count"),
    option_Download_count
  );
  chart_column_basic.render();
  // -----------------------------------------------------------------------
  // Download count
  // -----------------------------------------------------------------------

  var download_count_big = {
    series: [
      {
        name: "Premium ",
        data: [5, 4, 3, 7, 5, 10, 3],
      },
      {
        name: "Free ",
        data: [3, 2, 9, 5, 4, 6, 4],
      },
    ],
    chart: {
      fontFamily: "inherit",
      type: "bar",
      height: 350,
      offsetY: 10,
      offsetX:-15,
      toolbar: {
        show: false,
      },
    },
    grid: {
      show: true,
      strokeDashArray: 3,
      borderColor: "rgba(0,0,0,0.2)",
    },
    colors: ["var(--bs-indigo", "var(--bs-secondary"],
    plotOptions: {
      bar: {
        horizontal: false,
        columnWidth: "30%",
        endingShape: "flat",
        borderRadius: 4,
      },
    },
    dataLabels: {
      enabled: false,
    },
    stroke: {
      show: true,
      width: 5,
      colors: ["transparent"],
    },
    xaxis: {
      type: "category",
      categories: ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"],
      tickAmount: "16",
      tickPlacement: "on",
      axisTicks: {
        show: false,
      },
      labels: {
        style: {
          colors: "#a1aab2",
        },
      },
      axisTicks: {
        show: false,
      },
      axisBorder: {
        show: false,
      },
    },
    yaxis: {
      labels: {
        style: {
          colors: "#a1aab2",
        },
      },

    },
    fill: {
      opacity: 1,
    },
    tooltip: {
      theme: "dark",
    },
    legend: {
      show: false,
    },
  };

  var chart_column_basic = new ApexCharts(
    document.querySelector("#download-count-big"),
    download_count_big
  );
  chart_column_basic.render();
});
// -----------------------------------------------------------------------
// doughnut chart option
// -----------------------------------------------------------------------

var Visit_Source = {
  labels: ["Desktop", "Tablet", "Mobile", "Other"],
  series: [100, 40, 80, 90],
  chart: {
    type: "donut",
    height: 230,
    fontFamily: "inherit",
  },
  dataLabels: {
    enabled: false,
  },
  stroke: {
    width: 0,
  },

  plotOptions: {
    pie: {
      expandOnClick: true,
      donut: {
        size: "90%",
        labels: {
          show: true,
          name: {
            show: false,
            offsetY: 7,
          },
          value: {
            show: true,
            fontSize: "20px",
          },
          total: {
            show: false,
            color: "#a1aab2",
            fontSize: "13px",
            label: "Visits",
          },
        },
      },
    },
  },
  colors: ["var(--bs-indigo", "var(--bs-danger", "var(--bs-secondary", "#dadada"],
  tooltip: {
    show: true,
    fillSeriesColor: false,
  },
  legend: {
    show: false,
  },
  responsive: [
    {
      breakpoint: 480,
      options: {
        chart: {
          width: 200,
        },
      },
    },
  ],
};

var chart_pie_donut = new ApexCharts(
  document.querySelector("#visit-source"),
  Visit_Source
);
chart_pie_donut.render();
