$(document).ready(function () {
  function getTimeRemaining (endtime) {
    var t = Date.parse(endtime) - Date.parse(new Date())
    var hours = Math.floor((t % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60))
    var minutes = Math.floor((t % (1000 * 60 * 60)) / (1000 * 60))
    var seconds = Math.floor((t % (1000 * 60)) / 1000)
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

  // if there's a cookie with the name myClock, use that value as the deadline
  if (document.cookie && document.cookie.match('myClock')) {
    // get deadline value from cookie
    var deadline = $.cookie('myClock')
  }

  // otherwise, set a deadline 10 minutes from now and
  // save it in a cookie with that name
  else {
    // create deadline 10 minutes from now
    var deadline = SetTimer()
  }
  initializeClock('clockdiv', deadline)

  function SetTimer () {
    var timeInMinutes = 2
    var currentTime = Date.parse(new Date())
    var deadline = new Date(currentTime + timeInMinutes * 60 * 1000)
    var deadline_end = new Date(currentTime + (timeInMinutes + 1) * 60 * 1000)

    // store deadline in cookie for future reference
    $.cookie('myClock', deadline, { expires: deadline_end })
    return deadline
  }

  $('.phone').inputmask('+38 (099) 999-99-99')
})
