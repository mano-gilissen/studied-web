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
            '2024': [76, 107, 90, 124, 179, 223, 245, 178, 194, 78, 74, 74],
            '2025': [77, 112, 146, 201, 213, 178, 194, 78, 74, 74, 65, 76],
        },
    }
};

var graph_revenue_canvas                                    = null;
var graph_studies_canvas                                    = null;

var graph_revenue_chart                                     = null;
var graph_studies_chart                                     = null;





function graph_draw() {

    graph_revenue_canvas                                    = document.getElementById('graph_statistics');
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
        plugins: [ graph_plugin_crosshair ]
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
        datasets: [
            {
                data: graph_data_all['revenue']['losse_lessen'],
                borderColor: '#FFDD34',
                backgroundColor: function(context) { return graph_gradient(context, '#FFDD34') },
            },
            {
                data: graph_data_all['revenue']['structureel'],
                borderColor: '#DD34FF',
                backgroundColor: function(context) { return graph_gradient(context, '#DD34FF') },
            },
            {
                data: graph_data_all['revenue']['totaal'],
                borderColor: '#4CD976',
                backgroundColor: function(context) { return graph_gradient(context, '#4CD976') },
            },
        ]
    };
}



function graph_data_studies() {

    return {
        datasets: [
            {
                data: graph_data_all['studies']['gerapporteerd'],
                borderColor: '#4CD976',
                backgroundColor: function(context) { return graph_gradient(context, '#4CD976') },
            },
            {
                data: graph_data_all['studies']['ingepland'],
                borderColor: '#FFDD34',
                backgroundColor: function(context) { return graph_gradient(context, '#FFDD34') },
            },
            {
                data: graph_data_all['studies']['geannuleerd'],
                borderColor: '#DD34FF',
                backgroundColor: function(context) { return graph_gradient(context, '#DD34FF') },
            },
            {
                data: graph_data_all['studies']['verzuimd'],
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
                    align: 'start',
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
                ticks: {
                    color: '#000000',
                    align: 'center',
                    maxTicksLimit: 12,
                    padding: 8,
                    includeBounds: false,
                    callback: function(value, index, ticks) { return graph_callback_ticks_x(value, index, ticks, type); }
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



function graph_move(view_token, data_token, index) {

    chart.tooltip                                           .setActiveElements([{datasetIndex: 0, index: index,}]);
    chart                                                   .setActiveElements([{datasetIndex: 0, index: index,}]);
    chart                                                   .update();
}





/**-- Graph callback functions --**/

function graph_callback_ticks_x(value, index, ticks, type) {

    return Object.keys(graph_data[type])[index];

}



function graph_callback_ticks_y(value, index, ticks, type) {

    return '€ ' + format_currency(value);

}



function graph_callback_tooltip_title(canvas, type) {

    const index = canvas[0].parsed.x;

    return Object.keys(graph_data[type])[index];
}



function graph_callback_tooltip_label(canvas, type) {

    const value = canvas.parsed.y;

    switch (type) {

        case 'revenue':
            return '€ ' + format_currency(value) + ' omzet';

        case 'studies':
            return value + ' lessen';
    }
}
