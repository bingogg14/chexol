// Cookie Start
// Set cookie.
function setCookie(name, value, expires, path, domain, secure) {
  document.cookie = name + "=" + escape(value) +
    ((expires) ? "; expires=" + expires : "") +
    ((path) ? "; path=" + path : "") +
    ((domain) ? "; domain=" + domain : "") +
    ((secure) ? "; secure" : "");
}

// Just set cookie:
setCookie('name', 'value');
// Set cookie for 1 hour:
date = new Date();
date.setHours(date.getHours() + 1);
setCookie('name', 'value', date.toUTCString());

// Get cookie.
function getCookie(name) {
  var cookie = " " + document.cookie;
  var search = " " + name + "=";
  var setStr = null;
  var offset = 0;
  var end = 0;
  if (cookie.length > 0) {
    offset = cookie.indexOf(search);
    if (offset != -1) {
      offset += search.length;
      end = cookie.indexOf(";", offset)
      if (end == -1) {
        end = cookie.length;
      }
      setStr = unescape(cookie.substring(offset, end));
    }
  }
  return(setStr);
};
// Cookie End

function getTimeRemaining (endtime) {
  var t = Date.parse(endtime) - Date.parse(new Date()),
    hours = Math.floor((t % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)),
    minutes = Math.floor((t % (1000 * 60 * 60)) / (1000 * 60)),
    seconds = Math.floor((t % (1000 * 60)) / 1000);
  return {
    'total': t,
    'hours': hours,
    'minutes': minutes,
    'seconds': seconds
  }
}

function initializeClock (id, endtime) {
  var clock = document.getElementById(id)
  var hoursSpan = clock.querySelector('.hours')
  var minutesSpan = clock.querySelector('.minutes')
  var secondsSpan = clock.querySelector('.seconds')

  function updateClock () {
    if (Date.parse(endtime) <= Date.parse(new Date())) {
      if (document.cookie && document.cookie.match('myClock')) {
        endtime = new Date()
      } else {
        endtime = SetTimer()
      }
    }

    var t = getTimeRemaining(endtime)

    hoursSpan.innerHTML = ('0' + t.hours).slice(-2)
    minutesSpan.innerHTML = ('0' + t.minutes).slice(-2)
    secondsSpan.innerHTML = ('0' + t.seconds).slice(-2)
    if (t.total <= 0) {
      clearInterval(timeinterval)
    }
  }

  updateClock()
  var timeinterval = setInterval(updateClock, 1000)
}

function SetTimer () {
  var timeInMinutes = 2,
    currentTime = Date.parse(new Date()),
    deadline = new Date(currentTime + timeInMinutes * 60 * 1000),
    deadlineEnd = new Date(currentTime + (timeInMinutes + 1) * 60 * 1000);

  $.cookie('myClock', deadline, { expires: deadlineEnd });
  return deadline
}

document.addEventListener('DOMContentLoaded', function(){ // Аналог $(document).ready(function(){
  // if there's a cookie with the name myClock, use that value as the deadline
  if (document.cookie && document.cookie.match('myClock')) {
    // get deadline value from cookie
    var deadline = $.cookie('myClock')
  }

  // otherwise, set a deadline 10 minutes from now and
  // save it in a cookie with that name
  else {
    // create deadline 10 minutes from now
    var deadline = SetTimer();
  }

  initializeClock('clockdiv', deadline);
  // eslint-disable-next-line no-undef
  $('.phone').inputmask('+38 (099) 999-99-99')
});
