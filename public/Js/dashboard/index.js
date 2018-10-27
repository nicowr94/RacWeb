$(document).ready(function() {

    grafico(1,"activo_fisico","main","Avance de inventario fisico");
    graficoPie1(2,"activo_fisico","main1","Avance de conciliación");


});

async function grafico(num,tabla,id,titulo) {
    $.getJSON( "/grafico"+num+"/"+ tabla.toString()+"/"+idActivo, function( data ) {
        let columnasArray= [];
        let datosJson= [];

        for (let x in data) columnasArray.push(x);

        for (let i=0;i<columnasArray.length;i++) {
            obj={
                "value":data[columnasArray[i].toString()],
                "name":columnasArray[i].toString()
            };
            datosJson.push(obj);
        }

        console.log(columnasArray);
        console.log(datosJson);

        let myChart = echarts.init(document.getElementById(id));
        myChart.setOption({
            title : {
                text: titulo,
                subtext: 'Estados actuales',
                x:'center'
            },
            tooltip : {
                trigger: 'item',
                formatter: "{a} <br/>{b} : {c} ({d}%)"
            },
            legend: {
                orient: 'vertical',
                left: 'left',
                top:'60px',
                data: columnasArray

            },

            series : [
                {
                    name: 'Activos Fisicos',
                    type: 'pie',
                    radius : '45%',
                    center: ['50%', '60%'],
                    data:datosJson,
                    itemStyle: {
                        emphasis: {
                            shadowBlur: 10,
                            shadowOffsetX: 0,
                            shadowColor: 'rgba(0, 0, 0, 0.5)'
                        }
                    },
                }
            ],


        });
        console.log(myChart.setOption.legend);
    });
}


option = {
    title : {
        text: '某楼盘销售情况',
        subtext: '纯属虚构'
    },
    tooltip : {
        trigger: 'axis'
    },
    legend: {
        data:['意向','预购','成交']
    },
    toolbox: {
        show : true,
        feature : {
            mark : {show: true},
            dataView : {show: true, readOnly: false},
            magicType : {show: true, type: ['line', 'bar', 'stack', 'tiled']},
            restore : {show: true},
            saveAsImage : {show: true}
        }
    },
    calculable : true,
    xAxis : [
        {
            type : 'category',
            boundaryGap : false,
            data : ['周一','周二','周三','周四','周五','周六','周日']
        }
    ],
    yAxis : [
        {
            type : 'value'
        }
    ],
    series : [
        {
            name:'成交',
            type:'line',
            smooth:true,
            itemStyle: {normal: {areaStyle: {type: 'default'}}},
            data:[10, 12, 21, 54, 260, 830, 710]
        },
        {
            name:'预购',
            type:'line',
            smooth:true,
            itemStyle: {normal: {areaStyle: {type: 'default'}}},
            data:[30, 182, 434, 791, 390, 30, 10]
        },
        {
            name:'意向',
            type:'line',
            smooth:true,
            itemStyle: {normal: {areaStyle: {type: 'default'}}},
            data:[1320, 1132, 601, 234, 120, 90, 20]
        }
    ]
};
                    