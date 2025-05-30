var graph_data_all = {

    'revenue': {
        'losse_lessen': {
            '2024': [23, 42, 12, 34, 56, 78, 90, 123, 145, 55, 32, 62],
            '2025': [12, 34, 56, 78, 90, 123, 145, 55, 32, 62, 23, 42],
        },
        'structureel': {
            '2024': [53, 65, 78, 90, 123, 145, 55, 32, 62, 23, 42, 12],
            '2025': [65, 78, 90, 123, 145, 55, 32, 62, 23, 42, 12, 34],
        },
        'totaal': {
            '2024': [76, 107, 90, 124, 179, 223, 245, 178, 194, 78, 74, 74],
            '2025': [77, 112, 146, 201, 213, 178, 194, 78, 74, 74, 65, 76],
        },
    },

    'studies': {
        'gerapporteerd': {
            '2024': [23, 42, 12, 34, 56, 78, 90, 123, 145, 55, 32, 62],
            '2025': [12, 34, 56, 78, 90, 123, 145, 55, 32, 62, 23, 42],
        },
        'ingepland': {
            '2024': [53, 65, 78, 90, 123, 145, 55, 32, 62, 23, 42, 12],
            '2025': [65, 78, 90, 123, 145, 55, 32, 62, 23, 42, 12, 34],
        },
        'geannuleerd': {
            '2024': [12, 34, 56, 78, 90, 123, 145, 55, 32, 62, 23, 42],
            '2025': [34, 56, 78, 90, 123, 145, 55, 32, 62, 23, 42, 12],
        },
        'verzuimd': {
            '2024': [6, 12, 18, 24, 30, 36, 42, 48, 54, 60, 66, 72],
            '2025': [12, 18, 24, 30, 36, 42, 48, 54, 60, 66, 72, 78],
        },
    }
};

var graph_revenue_canvas                                    = null;
var graph_studies_canvas                                    = null;

var graph_revenue_chart                                     = null;
var graph_studies_chart                                     = null;

var graph_revenue_year                                      = '2025';
var graph_studies_year                                      = '2025';

var LABELS_MONTHS                                           = ['Jan', 'Feb', 'Mrt', 'Apr', 'Mei', 'Jun', 'Jul', 'Aug', 'Sep', 'Okt', 'Nov', 'Dec'];





function graph_draw() {

    graph_revenue_canvas                                    = document.getElementById('graph_revenue');
    graph_studies_canvas                                    = document.getElementById('graph_studies');

    if (graph_revenue_chart !== null)                       {

        graph_revenue_chart.destroy();

    }

    if (graph_studies_chart !== null)                       {

        graph_studies_chart.destroy();

    }

    graph_setup();

    if (graph_revenue_canvas !== null)                             {

        graph_revenue_chart                                 = graph_create('revenue', graph_revenue_canvas);

    }

    if (graph_studies_canvas !== null)                             {

        graph_studies_chart                                 = graph_create('studies', graph_studies_canvas);

    }
}



function graph_create(type, canvas) {

    return new Chart(canvas, {
        type: 'bar',
        data: graph_data(type),
        options: graph_options(type),
        responsive: true,
    });
}



function graph_data(type) {

    switch (type) {

        case 'revenue':
            return graph_data_revenue();

        case 'studies':
            return graph_data_studies();
    }
}



function graph_data_revenue() {

    return {
        labels: LABELS_MONTHS,
        datasets: [
            {
                data: graph_data_all['revenue']['losse_lessen'][graph_revenue_year],
                borderColor: '#FFDD34',
                backgroundColor: function(context) { return graph_gradient(context, '#FFDD34') },
            },
            {
                data: graph_data_all['revenue']['structureel'][graph_revenue_year],
                borderColor: '#DD34FF',
                backgroundColor: function(context) { return graph_gradient(context, '#DD34FF') },
            },
            {
                data: graph_data_all['revenue']['totaal'][graph_revenue_year],
                borderColor: '#4CD976',
                backgroundColor: function(context) { return graph_gradient(context, '#4CD976') },
            },
        ]
    };
}



function graph_data_studies() {

    return {
        labels: LABELS_MONTHS,
        datasets: [
            {
                data: graph_data_all['studies']['gerapporteerd'][graph_studies_year],
                borderColor: '#4CD976',
                backgroundColor: function(context) { return graph_gradient(context, '#4CD976') },
            },
            {
                data: graph_data_all['studies']['ingepland'][graph_studies_year],
                borderColor: '#FFDD34',
                backgroundColor: function(context) { return graph_gradient(context, '#FFDD34') },
            },
            {
                data: graph_data_all['studies']['geannuleerd'][graph_studies_year],
                borderColor: '#DD34FF',
                backgroundColor: function(context) { return graph_gradient(context, '#DD34FF') },
            },
            {
                data: graph_data_all['studies']['verzuimd'][graph_studies_year],
                borderColor: '#FF5F5F',
                backgroundColor: function(context) { return graph_gradient(context, '#FF5F5F') },
            },
        ]
    };
}



function graph_options(type) {

    return {
        layout: {
            padding: {
                top: 0,
                bottom: 0,
            }
        },
        maintainAspectRatio: false,
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    align: 'center',
                    maxTicksLimit: 6,
                    padding: 8,
                    includeBounds: true,
                    callback: function(value, index, ticks) { return graph_callback_ticks_y(value, index, ticks, type); }
                },
                grid: {
                    color: '#E6E6E6',
                    tickLength: 0,
                },
                border: {
                    width: 0,
                    color: '#CCCCCC'
                }
            },
            x: {
                barPercentage: 1,
                ticks: {
                    color: '#000000',
                    align: 'center',
                    padding: 8,
                    includeBounds: false,
                },
                grid: {
                    display: false
                },
                border: {
                    width: 1,
                    color: '#CCCCCC'
                }
            }
        },
        animation: false,
        plugins: {
            legend: {
                display: false
            },
            tooltip: {
                caretSize: 0,
                position: 'nearest',
                displayColors: false,
                cornerRadius: 10,
                titleColor: '#FFFFFF',
                backgroundColor: '#000000',
                titleMarginBottom: 6,
                bodySpacing: 4,
                footerMarginTop: 0,
                titleFont: {
                    weight: 200,
                    size: 12
                },
                bodyFont: {
                    weight: 300,
                    size: 12
                },
                callbacks: {
                    label: (canvas) => { return graph_callback_tooltip_label(canvas, type); },
                    title: (canvas) => { return graph_callback_tooltip_title(canvas, type); }
                }
            }
        }
    }
}



function module_graphs_statistics__set_year(type, year) {

    switch (type) {

        case 'revenue':

            graph_revenue_year = year;

            if (graph_revenue_chart !== null) {
                graph_revenue_chart.data.datasets[0].data = graph_data_all['revenue']['losse_lessen'][year];
                graph_revenue_chart.data.datasets[1].data = graph_data_all['revenue']['structureel'][year];
                graph_revenue_chart.data.datasets[2].data = graph_data_all['revenue']['totaal'][year];
                graph_revenue_chart.update();
            }
            break;

        case 'studies':

            graph_studies_year = year;

            if (graph_studies_chart !== null) {
                graph_studies_chart.data.datasets[0].data = graph_data_all['studies']['gerapporteerd'][year];
                graph_studies_chart.data.datasets[1].data = graph_data_all['studies']['ingepland'][year];
                graph_studies_chart.data.datasets[2].data = graph_data_all['studies']['geannuleerd'][year];
                graph_studies_chart.data.datasets[3].data = graph_data_all['studies']['verzuimd'][year];
                graph_studies_chart.update();
            }
            break;
    }
}





/**-- Graph callback functions --**/

function graph_callback_ticks_y(value, index, ticks, type) {


    switch (type) {

        case 'revenue':
            return format_currency(value);

        case 'studies':
            return value;
    }
}



function graph_callback_tooltip_title(canvas, type) {

    const index = canvas[0].parsed.x;

    return LABELS_MONTHS[index];
}



function graph_callback_tooltip_label(canvas, type) {

    const value = canvas.parsed.y;

    switch (type) {

        case 'revenue':
            return format_currency(value) + ' omzet';

        case 'studies':
            return value + ' lessen';
    }
}
