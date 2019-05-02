
// 声明所需变量
var canvas1,ctx1;
var canvas2,ctx2;
var canvas3,ctx3;
// 图表属性
var cWidth, cHeight, cMargin, cSpace;
// 饼状图属性
var radius,ox,oy;//半径 圆心
var tWidth, tHeight;//图例宽高
var posX, posY, textX, textY;
var startAngle, endAngle;
var totleNb;
// 运动相关变量
var ctr, numctr, speed;
//鼠标移动
var mousePosition = {};

//     //线条和文字
// var lineStartAngle,line,textPadding,textMoveDis;

  function goChart(dataArr1,chartID1,dataArr2,chartID2,dataArr3,chartID3){


    // 获得canvas上下文
    canvas1 = document.getElementById(chartID1);
    if(canvas1 && canvas1.getContext){
        ctx1 = canvas1.getContext("2d");
    }

    canvas2 = document.getElementById(chartID2);
    if(canvas2 && canvas2.getContext){
        ctx2 = canvas2.getContext("2d");
    }

    canvas3 = document.getElementById(chartID3);
    if(canvas3 && canvas3.getContext){
        ctx3 = canvas3.getContext("2d");
    }

    // ctx1.beginPath();
    initChart(canvas1,dataArr1);
    drawMarkers(ctx1,dataArr1);
    drawPie(ctx1,dataArr1,canvas1);


    // ctx1.closePath();
    // alert("data1 "+dataArr1[2][0]);

    // ctx2.beginPath();
    initChart(canvas2,dataArr2);
    drawMarkers(ctx2,dataArr2);
    drawPie(ctx2,dataArr2,canvas2);
    // ctx2.closePath();
    // // alert("data2 "+dataArr2[2][0]);
    //
    // // ctx3.beginPath();
    initChart(canvas3,dataArr3);
    drawMarkers(ctx3,dataArr3);
    drawPie(ctx3,dataArr3,canvas3);
    // ctx3.closePath();
    // alert("data3 "+dataArr3[2][0]);

        //监听鼠标移动
        var mouseTimer = null;
        canvas.addEventListener("mousemove",function(e){
            e = e || window.event;
            if( e.offsetX || e.offsetX==0 ){
                mousePosition.x = e.offsetX;
                mousePosition.y = e.offsetY;
            }else if( e.layerX || e.layerX==0 ){
                mousePosition.x = e.layerX;
                mousePosition.y = e.layerY;
            }

            clearTimeout(mouseTimer);
            mouseTimer = setTimeout(function(){
              ctx.clearRect(0,0,canvas.width, canvas.height);
                drawMarkers();
                pieDraw(true);
            },10);
        });

}

// 图表初始化
function initChart(canvas,dataArr){
    // 图表信息
    cMargin = 10;
    cSpace = 80;

    canvas.width = 600;
    canvas.height = 600;
    canvas.style.height = canvas.height/200 + "rem";
    canvas.style.width = canvas.width/200 + "rem";
    cHeight = canvas.height - cMargin*2;
    cWidth = canvas.width - cMargin*2;

    //饼状图信息
      radius = cHeight*2/6;  //半径  高度的2/6
      ox = canvas.width/2 + cSpace;  //圆心
      oy = canvas.height/2+ cSpace;
      tWidth = 60; //图例宽和高
      tHeight = 20;
      posX = cMargin;
      posY = cMargin;   //
      textX = posX + tWidth + 15;
      textY = posY + 18;
      startAngle = endAngle = 90*Math.PI/180; //起始弧度 结束弧度
      rotateAngle = 0; //整体旋转的弧度
      //将传入的数据转化百分比
      totleNb = 0;
      new_data_arr = [];
      for (var i = 0; i < dataArr.length; i++){
          totleNb += dataArr[i][0];
      }
      for (var i = 0; i < dataArr.length; i++){
          new_data_arr.push( dataArr[i][0]/totleNb );
      }
    totalYNomber = 10;
    // 运动相关
    ctr = 1;//初始步骤
    numctr = 50;//步骤
    speed = 1.2; //毫秒 timer速度

    //指示线 和 文字
    // lineStartAngle = -startAngle;
    // line=40;         //画线的时候超出半径的一段线长
    // textPadding=10;  //文字与线之间的间距
    // textMoveDis = 200; //文字运动开始的间距
}


//绘制比例图及文字
function drawMarkers(ctx,dataArr){
  ctx.textAlign="left";
      for (var i = 0; i < dataArr.length; i++){
          //绘制比例图及文字
          ctx.fillStyle = dataArr[i][1];
          ctx.fillRect(posX, posY + 40 * i, tWidth, tHeight);
          ctx.moveTo(posX, posY + 40 * i);
          ctx.font = 'normal 24px 微软雅黑';    //斜体 30像素 微软雅黑字体
          ctx.fillStyle = dataArr[i][1]; //"#000000";7
          var percent = dataArr[i][2] + "：" + parseInt(100 * new_data_arr[i]) + "%";
          ctx.fillText(percent, textX, textY + 40 * i);
      }
}

//绘制动画
function drawPie(ctxInput,arrInput,canvasInput){
  var dataArr = arrInput;
  var ctx = ctxInput;
  var canvas = canvasInput;

      //绘制动画
       pieDraw();
       function pieDraw(mouseMove){
         // for (var n = 0; n < dataArr.length; n++){
         //   ctx.fillStyle = ctx.strokeStyle = dataArr[n][1];
         //   ctx.lineWidth=1;
         //   var step = new_data_arr[n]* Math.PI * 2; //旋转弧度
         //   var lineAngle = lineStartAngle+step/2;   //计算线的角度
         //   lineStartAngle += step;//结束弧度

           // ctx.beginPath();
           // var  x0=ox+radius*Math.cos(lineAngle),//圆弧上线与圆相交点的x坐标
           //   y0=oy+radius*Math.sin(lineAngle),//圆弧上线与圆相交点的y坐标
           //   x1=ox+(radius+line)*Math.cos(lineAngle),//圆弧上线与圆相交点的x坐标
           //   y1=oy+(radius+line)*Math.sin(lineAngle),//圆弧上线与圆相交点的y坐标
           //   x2=x1,//转折点的x坐标
           //   y2=y1,
             // linePadding=ctx.measureText(dataArr[n][2]).width+10; //获取文本长度来确定折线的长度

             // ctx.moveTo(x0,y0);
             //对x1/y1进行处理，来实现折线的运动
             // yMove = y0+(y1-y0)*ctr/numctr;
             // ctx.lineTo(x1,yMove);
             // if(x1<=x0){
             //   x2 -= line;
             //   ctx.textAlign="right";
             //   ctx.lineTo(x2-linePadding,yMove);
             //   ctx.fillText(dataArr[n][2],x2-textPadding-textMoveDis*(numctr-ctr)/numctr,y2-textPadding);
             // }else{
             //   x2 += line;
             //   ctx.textAlign="left";
             //   ctx.lineTo(x2+linePadding,yMove);
             //   ctx.fillText(dataArr[n][2],x2+textPadding+textMoveDis*(numctr-ctr)/numctr,y2-textPadding);
             // }
             //
             // ctx.stroke();

         // }



         //设置旋转
       ctx.save();
       ctx.translate(ox, oy);
       ctx.rotate((Math.PI*2/numctr)*ctr/2);

       //绘制一个圆圈
       // ctx.strokeStyle = "black";
       ctx.strokeStyle = "rgba(0,0,0,"+0.5 +")";
       ctx.beginPath();
       ctx.arc(0, 0 ,(radius+20), 0, Math.PI*2, false);
       ctx.stroke();
       // alert("radius:"+(radius+20)*ctr/numctr);
         for (var j = 0; j < dataArr.length; j++){
             //绘制饼图
             endAngle = endAngle + new_data_arr[j] * Math.PI * 2; //结束弧度
             ctx.beginPath();
             ctx.moveTo(0,0); //移动到到圆心
             ctx.arc(0, 0, radius, startAngle, endAngle, false); //绘制圆弧

             ctx.fillStyle = dataArr[j][1];
             if(mouseMove && ctx.isPointInPath(mousePosition.x*2, mousePosition.y*2)){
                 ctx.globalAlpha = 0.8;
             }

             ctx.closePath();
             ctx.fill();
   ctx.globalAlpha = 1;

             startAngle = endAngle; //设置起始弧度
             if( j == dataArr.length-1 ){
                 startAngle = endAngle = 90*Math.PI/180; //起始弧度 结束弧度
             }
         }


   }
}



//  	var chartData = [[50,"#2dc6c8","Major"], [100,"#b6a2dd", "University"], [100,"#5ab1ee","Gender ratio"]];

//    goChart(chartData);
