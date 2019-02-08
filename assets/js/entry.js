
import Hex from "./desk/Hex.js";
import Orientation from "./desk/Orientation.js";
import Point from "./desk/Point.js";
import HexUtils from "./HexUtils.js";
import Vue from "vue";
import Character from "./Character.vue";

function character(element, data) {
    new Vue({
        el: element,
        data: data,
        ...Character,
    });
}

function rectangle(mapWidth, mapHeight) {
    let hexas = [];
    for (let r = 0; r < mapHeight; r++) {
        let offset = Math.floor(r/2); // or r>>1
        for (let q = -offset; q < mapWidth - offset; q++) {
            hexas.push(new Hex(q, r, -q-r));
        }
    }

    return hexas;
}

function renderHexagon(points) {
    return "\
        <g className='hexagon-group'>\n\
            <g className='hexagon'>\n\
                <polygon points=\"" + points + "\" fill={fillId} style={cellStyle} />\n\
            </g>\n\
        </g>";
}

function getPointOffset(corner, orientation, size) {
    let angle = 2.0 * Math.PI * (corner + orientation.startAngle) / 6;
    return new Point(size.x * Math.cos(angle), size.y * Math.sin(angle));
}
  
function calculateCoordinates(center, orientation) {
    var corners = [];
//    const center = new Point(0, 0);
    const size = new Point(10, 10);

    for (let i = 0; i < 6; i++) {
        const offset = getPointOffset(i, orientation, size);
        console.log(center, offset);
        const point = new Point(center.x + offset.x, center.y + offset.y);
        corners.push(point);
    }
    
    return corners;
}

function render() {
    let flat = true;
    const LAYOUT_FLAT = new Orientation(3.0 / 2.0, 0.0, Math.sqrt(3.0) / 2.0, Math.sqrt(3.0),2.0 / 3.0, 0.0, -1.0 / 3.0, Math.sqrt(3.0) / 3.0, 0.0);
    const LAYOUT_POINTY = new Orientation(Math.sqrt(3.0), Math.sqrt(3.0) / 2.0, 0.0, 3.0 / 2.0, Math.sqrt(3.0) / 3.0, -1.0 / 3.0, 0.0, 2.0 / 3.0, 0.5);
    var layout = {
        spacing: 1.0,
        orientation: (flat) ? LAYOUT_FLAT : LAYOUT_POINTY,
        origin: new Point(10, 10),
        size: new Point(100, 100)
    };
    let hexas = rectangle(10, 10);
    let cornerCoords = calculateCoordinates(HexUtils.hexToPixel(hexas[1], layout), layout.orientation);
    console.log(cornerCoords);
    var points = '';
    cornerCoords.forEach(function(point) {
        points = points + point.x + ',' + point.y + ' ';
    })
    return points;
}
    
function test() {
    console.log('ok');
//    console.log(rectangle(10,10));
    console.log(renderHexagon(render()));
}

export {
    test,
    rectangle,
    character,
}
