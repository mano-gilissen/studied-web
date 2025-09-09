/*var graph_data_all = {

    'revenue': {
        'bijles': {
            '2024': [23, 42, 12, 34, 56, 78, 90, 123, 145, 55, 32, 62],
            '2025': [12, 34, 56, 78, 90, 123, 145, 55, 32, 62, 23, 42],
        },
        'training': {
            '2024': [12, 34, 56, 78, 90, 123, 145, 55, 32, 62, 23, 42],
            '2025': [34, 56, 78, 90, 123, 145, 55, 32, 62, 23, 42, 12],
        },
        'huiswerkbegeleiding': {
            '2024': [6, 12, 18, 24, 30, 36, 42, 48, 54, 60, 66, 72],
            '2025': [12, 18, 24, 30, 36, 42, 48, 54, 60, 66, 72, 78],
        },
        'taalles': {
            '2024': [94, 53, 44, 80, 79, 82, 32, 26, 61, 12, 71, 16],
            '2025': [23, 78, 34, 52, 39, 10, 65, 26, 61, 44, 71, 16],
        },
        'taalcursus': {
            '2024': [94, 53, 44, 80, 79, 82, 32, 26, 61, 20, 17, 16],
            '2025': [123, 18, 24, 52, 39, 10, 65, 26, 61, 20, 17, 16],
        },
        'coaching': {
            '2024': [45, 67, 89, 123, 145, 167, 189, 210, 234, 256, 278, 300],
            '2025': [56, 78, 90, 112, 134, 156, 178, 200, 222, 244, 266, 288],
        },
        'total': {
            '2024': [94, 153, 144, 180, 279, 382, 432, 426, 461, 200, 171, 176],
            '2025': [123, 178, 204, 252, 339, 410, 465, 426, 461, 200, 171, 176],
        }
    },

    'studies': {
        4: {
            '2024': [23, 42, 12, 34, 56, 78, 90, 123, 145, 55, 32, 62],
            '2025': [12, 34, 56, 78, 90, 123, 145, 55, 32, 62, 23, 42],
        },
        5: {
            '2024': [12, 34, 56, 78, 90, 123, 145, 55, 32, 62, 23, 42],
            '2025': [34, 56, 78, 90, 123, 145, 55, 32, 62, 23, 42, 12],
        },
        6: {
            '2024': [6, 12, 18, 24, 30, 36, 42, 48, 54, 60, 66, 72],
            '2025': [12, 18, 24, 30, 36, 42, 48, 54, 60, 66, 72, 78],
        },
        'total': {
            '2024': [94, 153, 144, 180, 279, 382, 432, 426, 461, 200, 171, 176],
            '2025': [123, 178, 204, 252, 339, 410, 465, 426, 461, 200, 171, 176],
        },
    }
};*/



var graph_data_all;

var graph_revenue_canvas                                    = null;
var graph_studies_canvas                                    = null;

var graph_revenue_chart                                     = null;
var graph_studies_chart                                     = null;

var graph_revenue_year                                      = 2025;
var graph_studies_year                                      = 2025;

var graph_revenue_split                                     = true;
var graph_studies_split                                     = true;

var LABELS_MONTHS                                           = ['Jan', 'Feb', 'Mrt', 'Apr', 'Mei', 'Jun', 'Jul', 'Aug', 'Sep', 'Okt', 'Nov', 'Dec'];
var LABELS_MONTHS_FULL                                      = ['Januari', 'Februari', 'Maart', 'April', 'Mei', 'Juni', 'Juli', 'Augustus', 'September', 'Oktober', 'November', 'December'];





$(function() {

    //

});



function graph_draw() {

    graph_revenue_canvas                                    = document.getElementById('canvas_revenue');
    graph_studies_canvas                                    = document.getElementById('canvas_studies');

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

    graph_revenue_chart.data.datasets[3].categoryPercentage = 0.7;
    graph_studies_chart.data.datasets[3].categoryPercentage = 0.7;

    graph_revenue_chart.update();
    graph_studies_chart.update();
}



function graph_create(type, canvas) {

    return new Chart(canvas, {
        type: type === 'revenue' ? 'line' : 'bar',
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
        datasets: [

            {
                label: 'Bijles',
                data: graph_data_all['revenue']['bijles'][graph_revenue_year],
                borderColor: '#FFDD34',
                hidden: !graph_revenue_split,
                tension: 0.4,
                pointStyle: 'circle',
                pointRadius: 0,
                pointHoverRadius: 4,
                pointBackgroundColor: '#FFDD34',
            },
            {
                label: 'Coaching',
                data: graph_data_all['revenue']['coaching'][graph_revenue_year],
                borderColor: '#DD34FF',
                hidden: !graph_revenue_split,
                tension: 0.4,
                pointStyle: 'circle',
                pointRadius: 0,
                pointHoverRadius: 4,
                pointBackgroundColor: '#DD34FF',
            },
            {
                label: 'Huiswerkbegeleiding',
                data: graph_data_all['revenue']['huiswerkbegeleiding'][graph_revenue_year],
                borderColor: '#34FFDD',
                hidden: !graph_revenue_split,
                tension: 0.4,
                pointStyle: 'circle',
                pointRadius: 0,
                pointHoverRadius: 4,
                pointBackgroundColor: '#34FFDD',
            },
            {
                label: 'Taalcursus',
                data: graph_data_all['revenue']['taalcursus'][graph_revenue_year],
                borderColor: '#4CD976',
                hidden: !graph_revenue_split,
                tension: 0.4,
                pointStyle: 'circle',
                pointRadius: 0,
                pointHoverRadius: 4,
                pointBackgroundColor: '#4CD976',
            },
            {
                label: 'Taalles',
                data: graph_data_all['revenue']['taalles'][graph_revenue_year],
                borderColor: '#FF5F5F',
                hidden: !graph_revenue_split,
                tension: 0.4,
                pointStyle: 'circle',
                pointRadius: 0,
                pointHoverRadius: 4,
                pointBackgroundColor: '#FF5F5F',
            },
            {
                label: 'Training',
                data: graph_data_all['revenue']['training'][graph_revenue_year],
                borderColor: '#FFBF5F',
                hidden: !graph_revenue_split,
                tension: 0.4,
                pointStyle: 'circle',
                pointRadius: 0,
                pointHoverRadius: 4,
                pointBackgroundColor: '#FFBF5F',
            },
            {
                label: 'Totaal',
                data: graph_data_all['revenue']['total'][graph_revenue_year],
                borderColor: '#FFDD34',
                backgroundColor: function(context) { return graph_gradient(context, '#FFDD34', '22', '88') },
                hidden: graph_revenue_split,
                fill: true,
                tension: 0.4,
                pointStyle: 'circle',
                pointRadius: 0,
                pointHoverRadius: 4,
                pointBackgroundColor: '#FFDD34',
            }
        ]
    };
}



function graph_data_studies() {

    return {
        datasets: [
            {
                label: 'Ingepland',
                data: graph_data_all['studies'][1][graph_studies_year],
                borderColor: '#FFBF5F',
                backgroundColor: function(context) { return graph_gradient(context, '#FFBF5F') },
                hidden: !graph_studies_split,
            },
            {
                label: 'Gerapporteerd',
                data: graph_data_all['studies'][4][graph_studies_year],
                borderColor: '#4CD976',
                backgroundColor: function(context) { return graph_gradient(context, '#4CD976') },
                hidden: !graph_studies_split,
            },
            {
                label: 'Geannuleerd',
                data: graph_data_all['studies'][5][graph_studies_year],
                borderColor: '#FF5F5F',
                backgroundColor: function(context) { return graph_gradient(context, '#FF5F5F') },
                hidden: !graph_studies_split,
            },
            {
                label: 'Verzuimd',
                data: graph_data_all['studies'][6][graph_studies_year],
                borderColor: '#FF5F5F',
                backgroundColor: function(context) { return graph_gradient(context, '#FF5F5F') },
                hidden: !graph_studies_split,
            },
            {
                label: 'Totaal',
                data: graph_data_all['studies']['total'][graph_studies_year],
                borderColor: function(context) { return graph_studies_total_color(context) },
                backgroundColor: function(context) { return graph_gradient(context, graph_studies_total_color(context)) },
                hidden: graph_studies_split,
            }
        ]
    };
}



function graph_options(type) {


    switch (type) {

        case 'revenue':
            return graph_options_revenue();

        case 'studies':
            return graph_options_studies();
    }
}



function graph_options_revenue() {

    return {
        layout: {
            padding: {
                top: 0,
                bottom: 0,
            }
        },
        categoryPercentage: 0.8,
        barPercentage: 1.0,
        maintainAspectRatio: false,
        interaction: {
            mode: 'nearest',
            axis: 'x',
            intersect: false
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    align: 'center',
                    maxTicksLimit: 6,
                    padding: 8,
                    includeBounds: true,
                    callback: function(value, index, ticks) { return graph_callback_ticks_y(value, index, ticks, 'revenue'); }
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
                    callback: function(value, index, ticks) { return graph_callback_ticks_x(value, index, ticks); }
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
                backgroundColor: '#000000AA',
                titleMarginBottom: 6,
                bodySpacing: 4,
                footerMarginTop: 0,
                titleFont: {
                    family: 'Source Sans Pro, serif',
                    weight: 600,
                    size: 13
                },
                bodyFont: {
                    family: 'Source Sans Pro, serif',
                    weight: 400,
                    size: 13
                },
                callbacks: {
                    title: (canvas) => { return graph_callback_tooltip_title(canvas, 'revenue'); },
                    label: (canvas) => {

                        const label = canvas.dataset.label || '';
                        const value = canvas.parsed.y;

                        const formattedValue = format_currency(value);

                        return `${label}: ${formattedValue}`;
                    }
                }
            }
        }
    }
}



function graph_options_studies() {

    return {
        layout: {
            padding: {
                top: 0,
                bottom: 0,
            }
        },
        categoryPercentage: 0.8,
        barPercentage: 1.0,
        maintainAspectRatio: false,
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    stepSize: 1,
                    align: 'center',
                    maxTicksLimit: 6,
                    padding: 8,
                    includeBounds: true,
                    callback: function(value, index, ticks) { return graph_callback_ticks_y(value, index, ticks, 'studies'); }
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
                    padding: 8,
                    includeBounds: false,
                    callback: function(value, index, ticks) { return graph_callback_ticks_x(value, index, ticks); }
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
                backgroundColor: '#000000AA',
                titleMarginBottom: 6,
                bodySpacing: 4,
                footerMarginTop: 0,
                titleFont: {
                    family: 'Source Sans Pro, serif',
                    weight: 600,
                    size: 13
                },
                bodyFont: {
                    family: 'Source Sans Pro, serif',
                    weight: 400,
                    size: 13
                },
                callbacks: {
                    label: (canvas) => { return graph_callback_tooltip_label(canvas, 'studies'); },
                    title: (canvas) => { return graph_callback_tooltip_title(canvas, 'studies'); }
                }
            }
        }
    }
}



function graph_studies_total_color(context) {

    const future = (new Date(context.dataIndex) >= new Date().getMonth() + 1) &&
                   (new Date().getFullYear() === graph_studies_year);

    return future ? '#CCCCCC' : '#FFDD34';
}



function module_graphs_statistics__set_year(type, year) {

    switch (type) {

        case 'revenue':
            graph_revenue_year = year;
            break;

        case 'studies':
            graph_studies_year = year;
            break;
    }

    $('#graph_' + type + ' .option.year').removeClass('selected');
    $('#graph_' + type + '-option-year-' + year).addClass('selected');

    module_graphs_statistics__update(type);
}



function module_graphs_statistics__set_data(type, split) {

    switch (type) {

        case 'revenue':
            graph_revenue_split = split;
            break;

        case 'studies':
            graph_studies_split = split;
            break;
    }

    $('#graph_' + type + '-option-' + (!split ? 'split' : 'total')).removeClass('selected');
    $('#graph_' + type + '-option-' + (split ? 'split' : 'total')).addClass('selected');

    module_graphs_statistics__update(type);
}



function module_graphs_statistics__update(type) {

    if (type === 'revenue' && graph_revenue_chart !== null) {

        graph_revenue_chart.data.datasets[0].data = graph_data_all['revenue']['bijles'][graph_revenue_year];
        graph_revenue_chart.data.datasets[1].data = graph_data_all['revenue']['training'][graph_revenue_year];
        graph_revenue_chart.data.datasets[2].data = graph_data_all['revenue']['huiswerkbegeleiding'][graph_revenue_year];
        graph_revenue_chart.data.datasets[3].data = graph_data_all['revenue']['taalles'][graph_revenue_year];
        graph_revenue_chart.data.datasets[4].data = graph_data_all['revenue']['taalcursus'][graph_revenue_year];
        graph_revenue_chart.data.datasets[5].data = graph_data_all['revenue']['coaching'][graph_revenue_year];
        graph_revenue_chart.data.datasets[6].data = graph_data_all['revenue']['total'][graph_revenue_year];

        graph_revenue_chart.data.datasets[0].hidden = !graph_revenue_split;
        graph_revenue_chart.data.datasets[1].hidden = !graph_revenue_split;
        graph_revenue_chart.data.datasets[2].hidden = !graph_revenue_split;
        graph_revenue_chart.data.datasets[3].hidden = !graph_revenue_split;
        graph_revenue_chart.data.datasets[4].hidden = !graph_revenue_split;
        graph_revenue_chart.data.datasets[5].hidden = !graph_revenue_split;
        graph_revenue_chart.data.datasets[6].hidden = graph_revenue_split;

        graph_revenue_chart.update();
    }

    if (type === 'studies' && graph_studies_chart !== null) {

        graph_studies_chart.data.datasets[0].data = graph_data_all['studies'][1][graph_studies_year];
        graph_studies_chart.data.datasets[1].data = graph_data_all['studies'][4][graph_studies_year];
        graph_studies_chart.data.datasets[2].data = graph_data_all['studies'][5][graph_studies_year];
        graph_studies_chart.data.datasets[3].data = graph_data_all['studies'][6][graph_studies_year];
        graph_studies_chart.data.datasets[4].data = graph_data_all['studies']['total'][graph_studies_year];

        graph_studies_chart.data.datasets[0].hidden = !graph_studies_split;
        graph_studies_chart.data.datasets[1].hidden = !graph_studies_split;
        graph_studies_chart.data.datasets[2].hidden = !graph_studies_split;
        graph_studies_chart.data.datasets[3].hidden = !graph_studies_split;
        graph_studies_chart.data.datasets[4].hidden = graph_studies_split;

        graph_studies_chart.update();
    }
}





/**-- Graph callback functions --**/

function graph_callback_ticks_x(value, index, ticks) {

    return LABELS_MONTHS[value];

}

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

    return LABELS_MONTHS_FULL[index];
}



function graph_callback_tooltip_label(canvas, type) {

    const dataset = canvas.chart.data.datasets[canvas.datasetIndex];
    const value = canvas.parsed.y;

    switch (type) {

        case 'revenue':
            return [dataset.label, format_currency(value) + ' omzet'];

        case 'studies':
            return [dataset.label, value + ' uren'];
    }
}
