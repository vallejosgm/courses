function graphBar(dataName2) {
  var can, ctx,
  minVal, maxVal,
  xScalar, yScalar,
  numSamples, y;
  // data sets -- set literally or obtain from an ajax call
  var dataName = [];
  var dataValue = [];
  for (var i = 0; i < dataName2.length; i++) {
    dataName.push(dataName2[i]["country"]);
    dataValue.push(dataName2[i]["vote_percentage"]);
  }
  
  // set these values for your data
  numSamples = 4;
  maxVal = 100;
  var stepSize = 10;
  var colHead = 50;
  var rowHead = 100;
  var margin = 10;
  var header = "Percentage"
  can = document.getElementById("can");
  ctx = can.getContext("2d");
  ctx.fillStyle = "white"
  ctx.fillRect(0,0,650,400);
  ctx.fillStyle = "black"
  yScalar = (can.height - colHead - margin) / (maxVal);
  xScalar = (can.width - rowHead) / (numSamples + 1);
  ctx.strokeStyle = "rgba(128,128,255, 0.5)"; // light blue line
  ctx.beginPath();
  // print  column header
  ctx.font = "14pt Helvetica"
  ctx.fillText(header, 0, colHead - margin);
  // print row header and draw horizontal grid lines
  ctx.font = "12pt Helvetica"
  var count =  0;
  for (scale = maxVal; scale >= 0; scale -= stepSize) {
    y = colHead + (yScalar * count * stepSize);
    ctx.fillText(scale, margin,y + margin);
    ctx.moveTo(rowHead, y)
    ctx.lineTo(can.width, y)
    count++;
  }
  ctx.stroke();
  // label samples
  ctx.font = "14pt Helvetica";
  ctx.textBaseline = "bottom";
  for (i = 0; i < 4; i++) {
    y = calcY(dataValue[i], yScalar);
    ctx.fillText(dataName[i], xScalar * (i + 1), y - margin);
  }
  // set a color and a shadow
  ctx.fillStyle = "green";
  ctx.shadowColor = 'rgba(128,128,128, 0.5)';
  ctx.shadowOffsetX = 20;
  ctx.shadowOffsetY = 1;
  // translate to bottom of graph and scale x,y to match data
  ctx.translate(0, can.height - margin);
  ctx.scale(xScalar, -1 * yScalar);
  // draw bars
  for (i = 0; i < 4; i++) {
    ctx.fillRect(i + 1, 0, 0.5, dataValue[i]);
  }                    
}  
 
function calcY(value, ySca) {
  y = can.height - value * ySca;
  return y;
}