var o;

Object.defineProperty(exports, "__esModule", {
    value: !0
}), exports.replaceCodePoint = exports.fromCodePoint = void 0;

var e = new Map([ [ 0, 65533 ], [ 128, 8364 ], [ 130, 8218 ], [ 131, 402 ], [ 132, 8222 ], [ 133, 8230 ], [ 134, 8224 ], [ 135, 8225 ], [ 136, 710 ], [ 137, 8240 ], [ 138, 352 ], [ 139, 8249 ], [ 140, 338 ], [ 142, 381 ], [ 145, 8216 ], [ 146, 8217 ], [ 147, 8220 ], [ 148, 8221 ], [ 149, 8226 ], [ 150, 8211 ], [ 151, 8212 ], [ 152, 732 ], [ 153, 8482 ], [ 154, 353 ], [ 155, 8250 ], [ 156, 339 ], [ 158, 382 ], [ 159, 376 ] ]);

function r(o) {
    var r;
    return o >= 55296 && o <= 57343 || o > 1114111 ? 65533 : null !== (r = e.get(o)) && void 0 !== r ? r : o;
}

exports.fromCodePoint = null !== (o = String.fromCodePoint) && void 0 !== o ? o : function(o) {
    var e = "";
    return o > 65535 && (o -= 65536, e += String.fromCharCode(o >>> 10 & 1023 | 55296), 
    o = 56320 | 1023 & o), e += String.fromCharCode(o);
}, exports.replaceCodePoint = r, exports.default = function(o) {
    return (0, exports.fromCodePoint)(r(o));
};