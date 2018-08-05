/* $Id : lefttime.js 4865 2007-01-31 14:04:10Z paulgao $ */

/* *
 * 给定一个剩余时间（s）动态显示一个剩余时间.
 * 当大于一天时。只显示还剩几天。小于一天时显示剩余多少小时，多少分钟，多少秒。秒数每秒减1 *
 */

// 初始化变量
var auctionDate = 0;
var _GMTEndTime = 0;
var showTime = "leftTime";
var _day = 'day';
var _hour = 'hour';
var _minute = 'minute';
var _second = 'second';
var _end = 'end';

var cur_date = new Date();
var startTime = cur_date.getTime();
var Temp;
var timerID = null;
var timerRunning = false;

function showtime()
{
  now = new Date();
  var ts = parseInt((startTime - now.getTime()) / 1000) + auctionDate;
  var dateLeft = 0;
  var hourLeft = 0;
  var minuteLeft = 0;
  var secondLeft = 0;
  var hourZero = '';
  var minuteZero = '';
  var secondZero = '';
  if (ts < 0)
  {
    ts = 0;
    CurHour = 0;
    CurMinute = 0;
    CurSecond = 0;
  }
  else
  {
    dateLeft = parseInt(ts / 86400);
    ts = ts - dateLeft * 86400;
    hourLeft = parseInt(ts / 3600);
    ts = ts - hourLeft * 3600;
    minuteLeft = parseInt(ts / 60);
    secondLeft = ts - minuteLeft * 60;
  }

  if (hourLeft < 10)
  {
    hourZero = '0';
  }
  if (minuteLeft < 10)
  {
    minuteZero = '0';
  }
  if (secondLeft < 10)
  {
    secondZero = '0';
  }

  if (dateLeft > 0)
  {
    Temp = dateLeft + ":" + hourZero + hourLeft + ":" + minuteZero + minuteLeft + ":" + secondZero + secondLeft;
  }
  else
  {
    if (hourLeft > 0)
    {
      Temp = hourLeft + _hour + minuteZero + minuteLeft + _minute + secondZero + secondLeft + _second;
    }
    else
    {
      if (minuteLeft > 0)
      {
        Temp = minuteLeft + _minute + secondZero + secondLeft + _second;
      }
      else
      {
        if (secondLeft > 0)
        {
          Temp = secondLeft + _second;
        }
        else
        {
          Temp = '';
        }
      }
    }
  }

  if (auctionDate <= 0 || Temp == '')
  {
    Temp = "<strong>" + _end + "（请刷新页面查看结果）</strong>";
    stopclock();
  }

  if (document.getElementById(showTime))
  {
    document.getElementById(showTime).innerHTML = Temp;
  }

  timerID = setTimeout("showtime()", 1000);
  timerRunning = true;
}

var timerID = null;
var timerRunning = false;
function stopclock()
{
  if (timerRunning)
  {
    clearTimeout(timerID);
  }
  timerRunning = false;
}

function macauclock()
{
  stopclock();
  showtime();
}

function onload_leftTime(now_time)
{
  /* 第一次运行时初始化语言项目 */
  try
  {
    _GMTEndTime = gmt_end_time;
    // 剩余时间
    _day = day;
    _hour = hour;
    _minute = minute;
    _second = second;
    _end = end;
  }
  catch (e)
  {
  }
  if (_GMTEndTime > 0)
  {
    if (now_time == undefined)
    {
      var tmp_val = parseInt(_GMTEndTime) - parseInt(cur_date.getTime() / 1000 + cur_date.getTimezoneOffset() * 60);
    }
    else
    {
      var tmp_val = parseInt(_GMTEndTime) - parseInt((new Date()).valueOf()/1000);
    }
    if (tmp_val > 0)
    {
      auctionDate = tmp_val;
    }
  }

  macauclock();
  try
  {
    initprovcity();
  }
  catch (e)
  {
  }
}
