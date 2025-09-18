// -------------------------------------------------------------------------------------------------------------------------------------------
// Dashboard 1 : Chart Init Js
// -------------------------------------------------------------------------------------------------------------------------------------------
document.addEventListener("DOMContentLoaded", function () {

  //****************************
  // Theme Onload Toast
  //****************************
  window.addEventListener("load", () => {
    let myAlert = document.querySelectorAll('.toast')[0];
    if (myAlert) {
      let bsAlert = new bootstrap.Toast(myAlert);
      bsAlert.show();
    }
  })


  // -----------------------------------------------------------------------
  // Sales overview
  // -----------------------------------------------------------------------

  var options_Sales_Overview = {
    series: [
      {
        name: "Pixel ",
        data: [9, 5, 3, 7, 5, 10, 3],
      },
      {
        name: "Ample ",
        data: [6, 3, 9, 5, 4, 6, 4],
      },
    ],
    chart: {
      fontFamily: "inherit",
      type: "bar",
      height: 330,
      foreColor: "#adb0bb",
      offsetY: 10,
      offsetX: -15,
      toolbar: {
        show: false,
      },

    },
    grid: {
      show: true,
      strokeDashArray: 3,
      borderColor: "rgba(0,0,0,.1)",
    },
    colors: ["var(--bs-primary)", "var(--bs-secondary)"],
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
      axisTicks: {
        show: false,
      },
      axisBorder: {
        show: false,
      },
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
    fill: {
      opacity: 1,
      colors: ["var(--bs-primary)", "var(--bs-secondary)"],
    },
    tooltip: {
      theme: "dark",
    },
    legend: {
      show: false,
    },
    responsive: [
      {
        breakpoint: 767,
        options: {
          stroke: {
            show: false,
            width: 5,
            colors: ["transparent"],
          },
        },
      },
    ],
  };

  var chart_column_basic = new ApexCharts(
    document.querySelector("#sales-overview"),
    options_Sales_Overview
  );
  chart_column_basic.render();

  // -----------------------------------------------------------------------
  // Newsletter
  // -----------------------------------------------------------------------

  var Newsletter_Campaign = {
    series: [
      { name: "Inbound Calls", data: [65, 80, 80, 60, 60, 45, 45, 80, 80, 70, 70, 90, 90, 80, 80, 80, 60, 60, 50] },
      { name: "Outbound Calls", data: [90, 110, 110, 95, 95, 85, 85, 95, 95, 115, 115, 100, 100, 115, 115, 95, 95, 85, 85] },
    ],
    chart: { fontFamily: "inherit", type: "area", height: 300, offsetX: -15, toolbar: { show: !1 } },
    plotOptions: {},
    legend: { show: !1 },
    dataLabels: { enabled: !1 },
    fill: { type: "solid", opacity: 0.07, colors: ["#1B84FF", "#43CED7"] },
    stroke: { curve: "smooth", show: !0, width: 2, colors: ["var(--bs-primary)", "var(--bs-secondary)"] },
    xaxis: {
      categories: ["", "8 AM", "81 AM", "9 AM", "10 AM", "11 AM", "12 PM", "13 PM", "14 PM", "15 PM", "16 PM", "17 PM", "18 PM", "18:20 PM", "18:20 PM", "19 PM", "20 PM", "21 PM", ""],
      axisBorder: { show: !1 },
      axisTicks: { show: !1 },
      tickAmount: 6,
      labels: { rotate: 0, rotateAlways: !0, style: { fontSize: "12px", colors: "#a1aab2" } },
      crosshairs: { position: "front", stroke: { color: ["var(--bs-primary)", "var(--bs-secondary)"], width: 1, dashArray: 3 } },

    },
    yaxis: { max: 120, min: 30, tickAmount: 6, labels: { style: { fontSize: "12px", colors: "#a1aab2" } } },
    states: { normal: { filter: { type: "none", value: 0 } }, hover: { filter: { type: "none", value: 0 } }, active: { allowMultipleDataPointsSelection: !1, filter: { type: "none", value: 0 } } },
    tooltip: {
      theme: "dark",
    },
    colors: ["var(--bs-primary)", "var(--bs-secondary)"],
    grid: { borderColor: "var(--bs-border-color)", strokeDashArray: 4, yaxis: { lines: { show: !0 } } },
    markers: { strokeColor: ["var(--bs-primary)", "var(--bs-secondary)"], strokeWidth: 3 },
  };

  var chart_area_spline = new ApexCharts(
    document.querySelector("#newsletter-campaign"),
    Newsletter_Campaign
  );
  chart_area_spline.render();


  // -----------------------------------------------------------------------
  // Our visitor
  // -----------------------------------------------------------------------

// 1️⃣ Resolve CSS variables first
function getCssVariableColor(varName) {
    // getComputedStyle returns the actual color
    return getComputedStyle(document.documentElement)
        .getPropertyValue(varName)
        .trim();
}

// Build the colors array
const colors = [
    getCssVariableColor('--bs-primary'),    // Mobile
    getCssVariableColor('--bs-secondary'),  // Tablet
    '#eceff180',                             // Other
    getCssVariableColor('--bs-purple'),     // Desktop
];


// 2️⃣ Prepare series and labels dynamically
const labels = Object.keys(visitorsData); // from your backend
const series = Object.values(visitorsData);

// 3️⃣ ApexCharts options
var option_Our_Visitors = {
    series: series,     // e.g., [50, 40, 10, 5]
    labels: labels,     // e.g., ["Mobile", "Tablet", "Other", "Desktop"]
    chart: { type: "donut", height: 250, fontFamily: "inherit" },
    colors: colors,      // ✅ use the resolved colors here
    dataLabels: { enabled: false },
    stroke: { width: 0 },
    plotOptions: {
        pie: {
            expandOnClick: true,
            donut: {
                size: "83",
                labels: {
                    show: true,
                    name: { show: true, offsetY: 7 },
                    value: { show: false },
                    total: { show: true, color: "#a1aab2", fontSize: "13px", label: "Our Visitor" },
                },
            },
        },
    },
    tooltip: { show: true, fillSeriesColor: false },
    legend: { show: false },
};



// 4️⃣ Render chart
var chart = new ApexCharts(document.querySelector("#our-visitors"), option_Our_Visitors);
chart.render();

// 5️⃣ Build dynamic legend with the same colors
const legendContainer = document.getElementById("our-visitors-legend");
labels.forEach((label, idx) => {
    const color = colors[idx % colors.length];
    const li = document.createElement("li");
    li.className = "list-inline-item px-2 me-0";
    li.innerHTML = `
        <div class="d-flex align-items-center gap-2 fs-3" style="color:${color}">
            <iconify-icon icon="ri:circle-fill" class="fs-2"></iconify-icon>${label}
        </div>
    `;
    legendContainer.appendChild(li);
});


//   document.addEventListener('DOMContentLoaded', function () {

//   // 1) Basic checks
//   if (typeof ApexCharts === 'undefined') {
//     console.error('ApexCharts not found. Make sure apexcharts script is loaded before dashboard1.js.');
//     return;
//   }

//   const container = document.querySelector('#our-visitors');
//   if (!container) {
//     console.error('#our-visitors element not found in DOM.');
//     return;
//   }

//   // 2) If you pass dynamic data from Blade, optionally override option_Our_Visitors.series
//   // Example in blade: <script>window.visitorData = @json($data);</script>
//   if (window.visitorData) {
//     // adapt property names to your backend variable names
//     // e.g. window.visitorData = { mobile: 120, tablet: 80, other: 40, desktop: 10 }
//     option_Our_Visitors.series = [
//       Number(window.visitorData.mobile || option_Our_Visitors.series[0] || 0),
//       Number(window.visitorData.tablet || option_Our_Visitors.series[1] || 0),
//       Number(window.visitorData.other  || option_Our_Visitors.series[2] || 0),
//       Number(window.visitorData.desktop|| option_Our_Visitors.series[3] || 0)
//     ];
//     // If backend order differs, adjust above mapping.
//   }

//   // 3) Destroy existing chart if present (prevents duplicate SVG if re-running)
//   if (window.chartVisitors && typeof window.chartVisitors.destroy === 'function') {
//     try { window.chartVisitors.destroy(); } catch (e) { console.warn('destroy error', e); }
//     window.chartVisitors = null;
//   }

//   // 4) Ensure series are numbers
//   option_Our_Visitors.series = (option_Our_Visitors.series || []).map(v => Number(v) || 0);
//   option_Our_Visitors.labels = option_Our_Visitors.labels || ['A','B','C','D'];

//   // 5) Create and render chart
//   window.chartVisitors = new ApexCharts(container, option_Our_Visitors);
//   window.chartVisitors.render().then(() => {
//     // 6) After render -> populate a single legend UL if present
//     const series = option_Our_Visitors.series;
//     const labels = option_Our_Visitors.labels;
//     const colors = option_Our_Visitors.colors || ['#0d6efd','#6c757d','#eceff1','#6f42c1'];

//     const ul = document.getElementById('our-visitors-legend');
//     if (ul) {
//       ul.innerHTML = ''; // clear
//       labels.forEach((label, i) => {
//         const li = document.createElement('li');
//         li.className = 'list-inline-item px-2 me-0';
//         li.innerHTML = `
//           <div class="d-flex align-items-center gap-2 fs-6">
//             <span style="display:inline-block;width:12px;height:12px;background:${colors[i] || '#ccc'};border-radius:50%;"></span>
//             <span class="text-muted">${label}: <strong>${series[i] ?? 0}</strong></span>
//           </div>`;
//         ul.appendChild(li);
//       });
//       return;
//     }

//     // 7) Fallback: update individual placeholders if present
//     const fallbackMap = [
//       { sel: '.legend-mobile', idx: 0 },
//       { sel: '.legend-tablet', idx: 1 },
//       { sel: '.legend-other', idx: 2 },
//       { sel: '.legend-desktop', idx: 3 },
//     ];
//     fallbackMap.forEach(m => {
//       const node = document.querySelector(m.sel);
//       if (node) {
//         const i = m.idx;
//         node.innerHTML = `<iconify-icon icon="ri:circle-fill" class="fs-5"></iconify-icon> ${labels[i] || ''}: <b>${series[i] ?? 0}</b>`;
//       }
//     });

//   }).catch(err => {
//     console.error('ApexCharts render error:', err);
//   });

// });


  var chart_pie_donut = new ApexCharts(
    document.querySelector("#our-visitors"),
    option_Our_Visitors
  );
  chart_pie_donut.render();

  // -----------------------------------------------------------------------
  // Badnwidth usage
  // -----------------------------------------------------------------------

  var option_Bandwidth_usage = {
    series: [
      {
        name: "",
        labels: ["0", "4", "8", "12", "16", "20", "24", "30"],
        data: [0, 8, 12, 10, 6, 8, 15, 23],
      },
    ],
    chart: {
      height: 50,
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
      height: 50,
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
});
