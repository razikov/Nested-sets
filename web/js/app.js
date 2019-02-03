var NS = (function (exports) {
  'use strict';

  class Hex {
    constructor(q, r, s) {
      this.q = q;
      this.r = r;
      this.s = s;
    }

  }

  class Orientation {
    constructor(f0, f1, f2, f3, b0, b1, b2, b3, startAngle) {
      this.f0 = f0;
      this.f1 = f1;
      this.f2 = f2;
      this.f3 = f3;
      this.b0 = b0;
      this.b1 = b1;
      this.b2 = b2;
      this.b3 = b3;
      this.startAngle = startAngle;
    }

  }

  class Point {
    constructor(x, y) {
      this.x = x;
      this.y = y;
    }

  }

  function _defineProperty(obj, key, value) {
    if (key in obj) {
      Object.defineProperty(obj, key, {
        value: value,
        enumerable: true,
        configurable: true,
        writable: true
      });
    } else {
      obj[key] = value;
    }

    return obj;
  }

  class HexUtils {
    static equals(a, b) {
      return a.q == b.q && a.r == b.r && a.s == b.s;
    }

    static add(a, b) {
      return new Hex(a.q + b.q, a.r + b.r, a.s + b.s);
    }

    static subtract(a, b) {
      return new Hex(a.q - b.q, a.r - b.r, a.s - b.s);
    }

    static multiply(a, k) {
      return new Hex(a.q * k, a.r * k, a.s * k);
    }

    static lengths(hex) {
      return parseInt((Math.abs(hex.q) + Math.abs(hex.r) + Math.abs(hex.s)) / 2);
    }

    static distance(a, b) {
      return HexUtils.lengths(HexUtils.subtract(a, b));
    }

    static direction(direction) {
      return HexUtils.DIRECTIONS[(6 + direction % 6) % 6];
    }

    static neighbour(hex, direction) {
      return HexUtils.add(hex, HexUtils.direction(direction));
    }

    static neighbours(hex) {
      const array = [];

      for (let i = 0; i < HexUtils.DIRECTIONS.length; i += 1) {
        array.push(HexUtils.neighbour(hex, i));
      }

      return array;
    }

    static round(hex) {
      let rq = Math.round(hex.q);
      let rr = Math.round(hex.r);
      let rs = Math.round(hex.s);
      const qDiff = Math.abs(rq - hex.q);
      const rDiff = Math.abs(rr - hex.r);
      const sDiff = Math.abs(rs - hex.s);
      if (qDiff > rDiff && qDiff > sDiff) rq = -rr - rs;else if (rDiff > sDiff) rr = -rq - rs;else rs = -rq - rr;
      return new Hex(rq, rr, rs);
    }

    static hexToPixel(hex, layout) {
      const s = layout.spacing;
      const M = layout.orientation;
      let x = (M.f0 * hex.q + M.f1 * hex.r) * layout.size.x;
      let y = (M.f2 * hex.q + M.f3 * hex.r) * layout.size.y; // Apply spacing

      x = x * s;
      y = y * s;
      return new Point(x + layout.origin.x, y + layout.origin.y);
    }

    static pixelToHex(point, layout) {
      const M = layout.orientation;
      const pt = new Point((point.x - layout.origin.x) / layout.size.x, (point.y - layout.origin.y) / layout.size.y);
      const q = M.b0 * pt.x + M.b1 * pt.y;
      const r = M.b2 * pt.x + M.b3 * pt.y;
      const hex = new Hex(q, r, -q - r);
      return HexUtils.round(hex);
    }

    static lerp(a, b, t) {
      return a + (b - a) * t;
    }

    static hexLerp(a, b, t) {
      return new Hex(HexUtils.lerp(a.q, b.q, t), HexUtils.lerp(a.r, b.r, t), HexUtils.lerp(a.s, b.s, t));
    }

    static getID(hex) {
      return `${hex.q},${hex.r},${hex.s}`;
    }

  }

  _defineProperty(HexUtils, "DIRECTIONS", [new Hex(1, 0, -1), new Hex(1, -1, 0), new Hex(0, -1, 1), new Hex(-1, 0, 1), new Hex(-1, 1, 0), new Hex(0, 1, -1)]);

  function rectangle(mapWidth, mapHeight) {
    let hexas = [];

    for (let r = 0; r < mapHeight; r++) {
      let offset = Math.floor(r / 2); // or r>>1

      for (let q = -offset; q < mapWidth - offset; q++) {
        hexas.push(new Hex(q, r, -q - r));
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
    var corners = []; //    const center = new Point(0, 0);

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
    const LAYOUT_FLAT = new Orientation(3.0 / 2.0, 0.0, Math.sqrt(3.0) / 2.0, Math.sqrt(3.0), 2.0 / 3.0, 0.0, -1.0 / 3.0, Math.sqrt(3.0) / 3.0, 0.0);
    const LAYOUT_POINTY = new Orientation(Math.sqrt(3.0), Math.sqrt(3.0) / 2.0, 0.0, 3.0 / 2.0, Math.sqrt(3.0) / 3.0, -1.0 / 3.0, 0.0, 2.0 / 3.0, 0.5);
    var layout = {
      spacing: 1.0,
      orientation: flat ? LAYOUT_FLAT : LAYOUT_POINTY,
      origin: new Point(10, 10),
      size: new Point(100, 100)
    };
    let hexas = rectangle(10, 10);
    let cornerCoords = calculateCoordinates(HexUtils.hexToPixel(hexas[1], layout), layout.orientation);
    console.log(cornerCoords);
    var points = '';
    cornerCoords.forEach(function (point) {
      points = points + point.x + ',' + point.y + ' ';
    });
    return points;
  }

  function test() {
    console.log('ok'); //    console.log(rectangle(10,10));

    console.log(renderHexagon(render()));
  }

  exports.test = test;
  exports.rectangle = rectangle;

  return exports;

}({}));
