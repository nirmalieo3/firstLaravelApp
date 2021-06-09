<!DOCTYPE html>
<html>
<head>
    <title>Laravel fullcalendar with add,edit,delete and view event example</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
</head>
<!--https://devnote.in/laravel-fullcalendar-with-add-edit-delete-and-view-event/-->
<body style="background-color:aquamarine;">
   <div style="padding-top:30px; margin-left:50px; font-size:30px; cursor:pointer;">
     <a href="/home" style="color:black; font-weight:bold" >Home</a>
    </div>


   <div style="text-align:center" class="container">
      <h1>Course calander</h1>
     <!-- <a href="/">home</a>-->
      <div id='calendar_id'></div>
   </div>
   <script>
      $(document).ready(function () {
         var SITEURL = "{{ url('/home') }}";
         $.ajaxSetup({
           headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
         });
         var calendar = $('#calendar_id').fullCalendar({
             editable: true,
             // events: SITEURL + "/calender",
             events: function(start, end, timezone, callback) {
                 var start = $.fullCalendar.formatDate(start, "Y-MM-DD");
                 var end = $.fullCalendar.formatDate(end, "Y-MM-DD");
             $.ajax({
                 type: 'GET',
                 url: SITEURL + "/calender",
                 data: {
                     start: start,
                     end: end,
                 },
                 dataType: 'json',
                 success: function(data) {
                     var events = [];
                     $(data).each(function() {
                         events.push({
                             id: $(this).attr('id'),
                             title: $(this).attr('title'),
                             start: $(this).attr('start_date'),
                             end: $(this).attr('end_date'),
                         });
                     });
                     callback(events);
                 },
                 error : function(data) {
                     alert("Ajax call error");
                     return false;
                 },
             });
         },
         displayEventTime: false,
         editable: true,
         eventRender: function (event, element, view) {
             if (event.allDay === 'true') {
                 event.allDay = true;
             } else {
                 event.allDay = false;
             }
         },
         selectable: true,
         selectHelper: true,
         select: function (start, end, allDay) {
             var title = prompt('Enter Event Title :');
             if (title) {
                 var start = $.fullCalendar.formatDate(start, "Y-MM-DD");
                 var end = $.fullCalendar.formatDate(end, "Y-MM-DD");
                 $.ajax({
                     url: SITEURL + "/calenderAjax",
                     data: {
                         title: title,
                         start: start,
                         end: end,
                         type: 'add'
                     },
                     type: "POST",
                     success: function (data) {
                         displayMessage("Event successfully created!");
                         calendar.fullCalendar('renderEvent',{
                             id: data.id,
                             title: title,
                             start: start,
                             end: end,
                             allDay: allDay
                         },true);
                         calendar.fullCalendar('unselect');
                     }
                 });
             }
         },
         eventDrop: function (event, data) {
           var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD");
           var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD");
           $.ajax({
                 url: SITEURL + '/calenderAjax',
                 data: {
                     title: event.title,
                     start: start,
                     end: end,
                     id: event.id,
                     type: 'update'
                 },
                 type: "POST",
                 success: function (response) {
                     displayMessage("Event successfully updated!");
                 }
             });
         },
         eventClick: function (event) {
             var deleteMsg = confirm("Do you really want to delete this event?");
             if (deleteMsg) {
                 $.ajax({
                     type: "POST",
                     url: SITEURL + '/calenderAjax',
                     data: {
                             id: event.id,
                             type: 'delete'
                     },
                     success: function (response) {
                         calendar.fullCalendar('removeEvents', event.id);
                         displayMessage("Event successfully deleted!");
                     }
                 });
             }
         }
     });
 });

function displayMessage(message) {
    toastr.success(message, 'Event');
} 
</script>

</body>
</html>