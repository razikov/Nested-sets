
(function () {
    var canvas = document.getElementById('hexagonCanvas');
    var hexHeight,
        hexRadius,
        hexRectangleHeight,
        hexRectangleWidth,
        hexagonAngle = 0.523598776, //30 градусов в радианах
        sideLength = 16, //длина стороны, пикcелов
        boardWidth = 100, //ширина "доски" по вертикали
        boardHeight = 100; //высота "доски" по вертикали

    hexHeight = Math.sin(hexagonAngle) * sideLength;
    hexRadius = Math.cos(hexagonAngle) * sideLength;
    hexRectangleHeight = sideLength + 2 * hexHeight;
    hexRectangleWidth = 2 * hexRadius;

    if (canvas.getContext) {
        var ctx = canvas.getContext('2d');
        ctx.fillStyle = "#000000";
        ctx.strokeStyle = "#333333";
        ctx.lineWidth = 1;
        drawBoard(ctx, boardWidth, boardHeight); //первичная отрисовка
//        canvas.addEventListener("mousemove", function (eventInfo) { //слушатель перемещения мыши
//            var x = eventInfo.offsetX || eventInfo.layerX;
//            var y = eventInfo.offsetY || eventInfo.layerY;
//            var hexY = Math.floor(y / (hexHeight + sideLength));
//            var hexX = Math.floor((x - (hexY % 2) * hexRadius) / hexRectangleWidth);
//            console.log(hexY, hexX);
//            var screenX = hexX * hexRectangleWidth + ((hexY % 2) * hexRadius);
//            var screenY = hexY * (hexHeight + sideLength);
//            ctx.clearRect(0, 0, canvas.width, canvas.height);
//            drawBoard(ctx, boardWidth, boardHeight); //перерисовка на mousemove
//            //На доске ли координаты грызуна?
//            if (hexX >= -boardWidth / 2 && hexX <= boardWidth) {
//                if (hexY >= -boardHeight / 2 && hexY <= boardHeight) {
//                    ctx.fillStyle = "#008000";
//                    drawHexagon(ctx, screenX, screenY, true);
//                }
//            }
//        });
    }
    
    function drawBoard(canvasContext, width, height) {
        for (var i = 0; i < width; i++) {
            for (var j = 0; j < height; j++) {
                drawHexagon(ctx, i * hexRectangleWidth + ((j % 2) * hexRadius),
                j * (sideLength + hexHeight), false);
            }
        }
    }

    function drawHexagon(canvasContext, x, y, fill) {
        var fill = fill || false;
        canvasContext.beginPath();
        canvasContext.moveTo(x + hexRadius, y);
        canvasContext.lineTo(x + hexRectangleWidth, y + hexHeight);
        canvasContext.lineTo(x + hexRectangleWidth, y + hexHeight + sideLength);
        canvasContext.lineTo(x + hexRadius, y + hexRectangleHeight);
        canvasContext.lineTo(x, y + sideLength + hexHeight);
        canvasContext.lineTo(x, y + hexHeight);
        canvasContext.closePath();
        if (fill) {
            canvasContext.fill();
        } else {
            canvasContext.stroke();
        }
    }
    
})();
