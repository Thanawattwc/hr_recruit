Number.prototype.numberFormat = function (n = 0, x) {
  var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\.' : '$') + ')';
  return this.toFixed(Math.max(0, ~~n)).replace(new RegExp(re, 'g'), '$&,');
};

Number.prototype.decimalFormat = function () {
  if (this.toString().indexOf('.') != -1) {
    num = this.toFixed(2);
  }
  else {
    num = this;
  }
  return num;
};

String.prototype.splice = function (idx, rem, str) {
  return this.slice(0, idx) + str + this.slice(idx + Math.abs(rem));
};

String.prototype.ucwords = function () {
  str = this.toLowerCase();
  return str.replace(/(^([a-zA-Z\p{M}]))|([ -][a-zA-Z\p{M}])/g,
    function ($1) {
      return $1.toUpperCase();
    });
}

Array.prototype.array_diff = function (a) {
  return this.filter(function (i) { return a.indexOf(i) < 0; });
};