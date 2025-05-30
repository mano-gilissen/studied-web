function graph_setup() {

    Chart.defaults.font.family                              = 'Circular, serif';
    Chart.defaults.font.weight                              = 200;
    Chart.defaults.font.size                                = 10;
}



function graph_gradient(context, color, transparency = '88') {

    const chart                                             = context.chart;
    const {ctx, chartArea}                                  = chart;

    if (!chartArea) {

        return;

    }

    let gradient                                            = ctx.createLinearGradient(0, chartArea.bottom, 0, chartArea.top);
    gradient                                                .addColorStop(0, color + transparency);
    gradient                                                .addColorStop(1, color + 'FF');

    return gradient;
}
