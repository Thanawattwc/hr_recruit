function base_url(path) {
  var url, basepath, pathname, start, end, site;

  if (location.hostname == 'localhost') {
    pathname = location.pathname;
    start = pathname.indexOf(pathname) + 1;
    end = pathname.indexOf('/', start);
    site = pathname.substr(start, end);

    if (path) {
      path = '/' + path;
      path = path.replace('//', '/');
      path = site + path;
    }
    else {
      path = site;
    }
  }

  if (path) {
    path = '/' + path;
    path = path.replace('//', '/');

    url = location.protocol + '//' + location.hostname + (location.port && ':' + location.port) + path;
  }
  else {
    url = location.protocol + '//' + location.hostname + (location.port && ':' + location.port) + '/';
  }

  return url;
}

function get_param(param) {
  var urlParamString = location.search.split(param + '=');

  if (urlParamString.length <= 1) {
    return false;
  }
  else {
    var tmp = urlParamString[1].split('&');
    return tmp[0];
  }
}

function query_string() {
  var query_string = {};
  var query = window.location.search.substring(1);
  var vars = query.split('&');
  for (var i = 0; i < vars.length; i++) {
    var pair = vars[i].split('=');
    if (typeof query_string[pair[0]] === 'undefined') {
      query_string[pair[0]] = decodeURIComponent(pair[1]);
    }
    else if (typeof query_string[pair[0]] === 'string') {
      var arr = [query_string[pair[0]], decodeURIComponent(pair[1])];
      query_string[pair[0]] = arr;
    }
    else {
      query_string[pair[0]].push(decodeURIComponent(pair[1]));
    }
  }
  return query_string;
}

function table_compare(index) {
  return function (a, b) {
    var valA = get_cell_value(a, index);
    var valB = get_cell_value(b, index);
    return $.isNumeric(valA) && $.isNumeric(valB) ? valA - valB : valA.toString().localeCompare(valB);
  }
}

function get_cell_value(row, index) {
  if ($(row).children('td').eq(index).hasClass('create_date') || $(row).children('td').eq(index).hasClass('last_modified')) {
    return $(row).children('td').eq(index).data('unixtime');
  }
  else {
    return $(row).children('td').eq(index).text();
  }
}

function switch_language(lang) {
  var exp = 10 * 365 * 1000 * 36000;

  set_cookie('language', lang, exp);
  location.reload();
}

function set_cookie(cname, cvalue, exp) {
  var d = new Date();
  d.setTime(d.getTime() + exp);
  var expires = 'expires=' + d.toUTCString();
  document.cookie = encodeURIComponent(cname) + '=' + encodeURIComponent(cvalue) + ';' + expires + ';path=/';
}

function get_cookie(cname) {
  var name = cname + '=';
  var decodedCookie = decodeURIComponent(document.cookie);
  var ca = decodedCookie.split(';');
  for (var i = 0; i < ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return '';
}