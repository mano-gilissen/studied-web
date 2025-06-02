function graph_setup() {

    Chart.defaults.font.family                              = 'Circular, serif';
    Chart.defaults.font.weight                              = 200;
    Chart.defaults.font.size                                = 10;
}



function graph_gradient(context, color, transparency_from = '88', transparency_to = 'FF') {

    const chart                                             = context.chart;
    const {ctx, chartArea}                                  = chart;

    if (!chartArea) {

        return;

    }

    let gradient                                            = ctx.createLinearGradient(0, chartArea.bottom, 0, chartArea.top);
    gradient                                                .addColorStop(0, color + transparency_from);
    gradient                                                .addColorStop(1, color + transparency_to);

    return gradient;
}



const graph_plugin_crosshair = {

    id: 'crosshair',

    afterDraw(chart, args, options) {

        if (chart.tooltip?._active?.length) {

            let x                                           = chart.tooltip._active[0].element.x;
            let yAxis                                       = chart.scales.y;
            let ctx                                         = chart.ctx;

            ctx.save();
            ctx.beginPath();
            ctx.moveTo(x, yAxis.top);
            ctx.lineTo(x, yAxis.bottom);
            ctx.setLineDash([4, 4]);
            ctx.lineWidth = 1;
            ctx.strokeStyle = '#6B6B6B';
            ctx.stroke();
            ctx.restore();
        }
    }
};
