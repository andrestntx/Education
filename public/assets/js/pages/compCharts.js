var CompCharts = function() {
    return {
        init: function() {
            var chart = $("#chart-bars");
            var url_json_chart = chart.data('url-json');

            $.ajax({
                type: "GET",
                url: url_json_chart
            }).done(function(json) {
                json = $.parseJSON(json);
                console.log(json);
                $.plot(chart,
                    json["content"],
                    {
                        colors: ["#5ccdde", "#454e59"],
                        legend: {show: true, position: "nw", backgroundOpacity: 0},
                        bars: {show: true, lineWidth: 0},
                        grid: {borderWidth: 0},
                        yaxis: {ticks: 3, tickColor: "#f5f5f5"},
                        xaxis: {ticks: json["names"], tickColor: "#f5f5f5"}
                    }
                );
            });
        }
    };
}();