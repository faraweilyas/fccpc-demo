"use strict";

// Shared Colors Definition
const primary = '#135c40';
const success = '#1BC5BD';
const info = '#8950FC';
const warning = '#FFA800';
const danger = '#F64E60';

// Class definition
var KTWidgets = function () {

    var _localChart = function (section, category) {
        var element = document.getElementById(section);

        $.ajax({
            url: '/report-amount-paid/'+category,
            type: 'GET',
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: {},
            success: function(response)
            {
                var result = JSON.parse(response);
                var result_small_array = $.map(result.response.small, function(value, index){
                    return [value];
                });

                var result_large_array = $.map(result.response.large, function(value, index){
                    return [value];
                });

                $('#report-loader').addClass('hide');
                $("#local_chart").removeClass('hide');

                if (!element) {
                    return;
                }

                var options = {
                    series: [{
                        name: 'Small',
                        data: result_small_array
                    },{
                        name: 'Large',
                        data: result_large_array
                    }],
                    chart: {
                        type: 'bar',
                        height: 350,
                        toolbar: {
                            show: true
                        }
                    },
                    plotOptions: {
                        bar: {
                            horizontal: false,
                            columnWidth: ['50%'],
                            endingShape: 'rounded'
                        },
                    },
                    legend: {
                        show: true
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        show: true,
                        width: 2,
                        colors: ['transparent']
                    },
                    xaxis: {
                        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                        axisBorder: {
                            show: false,
                        },
                        axisTicks: {
                            show: false
                        },
                        labels: {
                            style: {
                                colors: KTApp.getSettings()['colors']['gray']['gray-500'],
                                fontSize: '12px',
                                fontFamily: KTApp.getSettings()['font-family']
                            }
                        }
                    },
                    yaxis: {
                        labels: {
                            style: {
                                colors: KTApp.getSettings()['colors']['gray']['gray-500'],
                                fontSize: '12px',
                                fontFamily: KTApp.getSettings()['font-family']
                            }
                        }
                    },
                    fill: {
                        opacity: 1
                    },
                    states: {
                        normal: {
                            filter: {
                                type: 'none',
                                value: 0
                            }
                        },
                        hover: {
                            filter: {
                                type: 'none',
                                value: 0
                            }
                        },
                        active: {
                            allowMultipleDataPointsSelection: false,
                            filter: {
                                type: 'none',
                                value: 0
                            }
                        }
                    },
                    tooltip: {
                        style: {
                            fontSize: '12px',
                            fontFamily: KTApp.getSettings()['font-family']
                        },
                        y: {
                            formatter: function(val)
                            {
                                let validatedAmount = Number(val),
                                    formatter       = new Intl.NumberFormat('en-US');

                                return "₦" + formatter.format(validatedAmount);
                            }
                        }
                    },
                    colors: ['#F4A261', '#E76F51'],
                    grid: {
                        borderColor: KTApp.getSettings()['colors']['gray']['gray-200'],
                        strokeDashArray: 4,
                        yaxis: {
                            lines: {
                                show: true
                            }
                        }
                    }
                };

                var chart = new ApexCharts(element, options);
                chart.render();
            }
        });
    }

    // Public methods
    return {
        init: function () {
            _localChart('local_chart', 'REG');
            _localChart('ffm_chart',   'FFM');
            _localChart('ffx_chart',   'FFX');
        }
    }
}();

// Webpack support
if (typeof module !== 'undefined') {
    module.exports = KTWidgets;
}

// jQuery(document).ready(function () {
//     KTWidgets.init();
// });
