var selectedDate = "";
var today;
var todayString;
var form = document.getElementById("formday");
var xmlHttp;
function load() {
document.getElementById("selectedDay").innerText = todayString;
document.getElementById("today").value=todayString;
document.getElementById("today").innerText=todayString;
var phpGetDay = document.getElementById("dayforjs").value;
var selectedMonth = phpGetDay.substr(6,1);
var table = document.getElementById("calendarTable");
var tds = table.getElementsByTagName('td');
for(var i = 0; i < tds.length; i++) {
  // alert(tds[i].getAttribute('data'));
  var cellDay = tds[i].getAttribute('data');
  var cellDayStr = cellDay.substr(0,4) + "-"+cellDay.substr(4,2)+"-"+cellDay.substr(6,2);
  if( phpGetDay == cellDayStr){
    //alert(phpGetDay);
      tds[i].className = "clicked";
      var cellDay123 = cellDay.substr(0,4) + "."+cellDay.substr(4,2)+"."+cellDay.substr(6,2);
      document.getElementById("selectedDay").innerText=cellDay123;
  }


}
}


(function(){
    /*
     * 用于记录日期，显示的时候，根据dateObj中的日期的年月显示
     */
    var dateObj = (function(){
        var _date = new Date();    // 默认为当前系统时间
        return {
            getDate : function(){
                return _date;
            },
            setDate : function(date) {
                _date = date;
            }
        };
    })();

    // 设置calendar div中的html部分
    renderHtml();
    // 表格中显示日期
    showCalendarData();
    // 绑定事件
    bindEvent();

    /**
     * 渲染html结构
     */
    function renderHtml() {
        var calendar = document.getElementById("calendar");
        var titleBox = document.createElement("div");  // 标题盒子 设置上一月 下一月 标题
        var bodyBox = document.createElement("div");  // 表格区 显示数据

        // 设置标题盒子中的html
        titleBox.className = 'calendar-title-box';
        titleBox.innerHTML = "<span class='prev-month' id='prevMonth'></span>" +
            "<span class='calendar-title' id='calendarTitle'></span>" +
            "<span id='nextMonth' class='next-month'></span>";
        calendar.appendChild(titleBox);    // 添加到calendar div中

        // 设置表格区的html结构
        bodyBox.className = 'calendar-body-box';
        var _headHtml = "<tr id='week'>" +
            "<th>SUN</th>" +
            "<th>MON</th>" +
            "<th>TUE</th>" +
            "<th>WED</th>" +
            "<th>THU</th>" +
            "<th>FRI</th>" +
            "<th>SAT</th>" +
            "</tr>";
        var _bodyHtml = "";

        // 一个月最多31天，所以一个月最多占6行表格
        for(var i = 0; i < 6; i++) {
            _bodyHtml += "<tr>" +
                "<td class='unclicked' onclick='setOtherToUnclicked()'></td>" +
                "<td class='unclicked' onclick='setOtherToUnclicked()'></td>" +
                "<td class='unclicked' onclick='setOtherToUnclicked()'></td>" +
                "<td class='unclicked' onclick='setOtherToUnclicked()'></td>" +
                "<td class='unclicked' onclick='setOtherToUnclicked()'></td>" +
                "<td class='unclicked' onclick='setOtherToUnclicked()'></td>" +
                "<td class='unclicked' onclick='setOtherToUnclicked()'></td>" +
                "</tr>";
        }
        bodyBox.innerHTML = "<table id='calendarTable' class='calendar-table'>" +
            _headHtml + _bodyHtml +
            "</table>";
        // 添加到calendar div中
        calendar.appendChild(bodyBox);
    }

    /**
     * 表格中显示数据，并设置类名
     */
    function showCalendarData() {
        var _year = dateObj.getDate().getFullYear();
        var _month = dateObj.getDate().getMonth() + 1;
        var _dateStr = getDateStr(dateObj.getDate());

        // 设置顶部标题栏中的 年、月信息
        var calendarTitle = document.getElementById("calendarTitle");
        var monthNum = _dateStr.substr(4,2);
        if(monthNum === "01"){
            var monthStr = "Jan"
        }else if(monthNum === "02"){
            var monthStr = "Feb"
        }else if(monthNum === "03"){
            var monthStr = "Mar"
        }else if(monthNum === "04"){
            var monthStr = "Apr"
        }else if(monthNum === "05"){
            var monthStr = "May"
        }else if(monthNum === "06"){
            var monthStr = "Jun"
        }else if(monthNum === "07"){
            var monthStr = "Jul"
        }else if(monthNum === "08"){
            var monthStr = "Aug"
        }else if(monthNum === "09"){
            var monthStr = "Sep"
        }else if(monthNum === "10"){
            var monthStr = "Oct"
        }else if(monthNum === "11"){
            var monthStr = "Nov"
        }else if(monthNum === "12"){
            var monthStr = "Dec"
        }
        var titleStr = monthStr + " "+_dateStr.substr(0, 4);
        calendarTitle.innerText = titleStr;

        // 设置表格中的日期数据
        var _table = document.getElementById("calendarTable");
        var _tds = _table.getElementsByTagName("td");
        var _firstDay = new Date(_year, _month - 1, 1);  // 当前月第一天
        for(var i = 0; i < _tds.length; i++) {
            var _thisDay = new Date(_year, _month - 1, i + 1 - _firstDay.getDay());
             var _thisDayStr = getDateStr(_thisDay);
            _tds[i].innerText = _thisDay.getDate();
            //_tds[i].data = _thisDayStr;
            _tds[i].setAttribute('data', _thisDayStr);
            if(_thisDayStr == getDateStr(new Date())) {    // 当前天
                today = _thisDayStr;
                todayString = _thisDayStr.substr(0,4) + "."+_thisDayStr.substr(4,2)+"."+_thisDayStr.substr(6,2);
                _tds[i].className = 'currentDay';
            }else if(_thisDayStr.substr(0, 6) == getDateStr(_firstDay).substr(0, 6)) {
                _tds[i].className = 'currentMonth';  // 当前月
            }else {    // 其他月
                _tds[i].className = 'otherMonth';
            }
        }
    }

    /**
     * 绑定上个月下个月事件
     */
    function bindEvent() {
        var prevMonth = document.getElementById("prevMonth");
        var nextMonth = document.getElementById("nextMonth");
        addEvent(prevMonth, 'click', toPrevMonth);
        addEvent(nextMonth, 'click', toNextMonth);
        var table = document.getElementById("calendarTable");
        var tds = table.getElementsByTagName('td');
        for(var i = 0; i < tds.length; i++) {
            addEvent(tds[i], 'click', function(e){
                console.log(e.target.getAttribute('data'));
                selectedDate = e.target.getAttribute('data');
                e.target.className="clicked";
                e.target.id="clickedCell";
                var selectedDayStr = selectedDate.substr(0,4) + "."+selectedDate.substr(4,2)+"."+selectedDate.substr(6,2);
                document.getElementById("selectedDay").innerText = selectedDayStr;
                document.getElementById("today").value=selectedDayStr;
                document.getElementById("today").innerText=selectedDayStr;
              //  document.getElementById("form1").submit();
                document.getElementById("form1").submit();

            });
        }
    }


    /**
     * 绑定事件
     */
    function addEvent(dom, eType, func) {
        if(dom.addEventListener) {  // DOM 2.0
            dom.addEventListener(eType, function(e){
                func(e);
            });
        } else if(dom.attachEvent){  // IE5+
            dom.attachEvent('on' + eType, function(e){
                func(e);
            });
        } else {  // DOM 0
            dom['on' + eType] = function(e) {
                func(e);
            }
        }
    }

    /**
     * 点击上个月图标触发
     */
    function toPrevMonth() {
        var date = dateObj.getDate();
        dateObj.setDate(new Date(date.getFullYear(), date.getMonth() - 1, 1));
        showCalendarData();
    }

    /**
     * 点击下个月图标触发
     */
    function toNextMonth() {
        var date = dateObj.getDate();
        dateObj.setDate(new Date(date.getFullYear(), date.getMonth() + 1, 1));
        showCalendarData();
    }

    /**
     * 日期转化为字符串， 4位年+2位月+2位日
     */
    function getDateStr(date) {
        var _year = date.getFullYear();
        var _month = date.getMonth() + 1;    // 月从0开始计数
        var _d = date.getDate();

        _month = (_month > 9) ? ("" + _month) : ("0" + _month);
        _d = (_d > 9) ? ("" + _d) : ("0" + _d);
        return _year + _month + _d;
    }
})();

var table = document.getElementById("calendarTable");
var tds = table.getElementsByTagName('td');
for(var i = 0; i < tds.length; i++) {
    addEvent(tds[i], 'click', function(e){
        console.log(e.target.getAttribute('data'));
    });
}

function setOtherToUnclicked(){
    var previousClickedCell = document.getElementById("clickedCell");
    if(previousClickedCell.getAttribute('data')==today){
        previousClickedCell.className = "currentDay";
    }
    else{
        previousClickedCell.className = "unclicked";
    }
    previousClickedCell.id="";
}

function getDay(str){
  if (window.XMLHttpRequest) {
    // IE7+, Firefox, Chrome, Opera, Safari 执行代码
    xmlhttp=new XMLHttpRequest();
  } else {
    // IE6, IE5 执行代码
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
      document.getElementById("poll").innerHTML=xmlhttp.responseText;
    }
  }
  xmlhttp.open("GET","../html/backEndday.php?vote="+int,true);
  xmlhttp.send();

}
