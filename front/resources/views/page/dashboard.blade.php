@extends('index')

@section('style')
    <link rel="stylesheet" href="/admin/assets/css/fullcalendar/core.min.css">
    <link rel="stylesheet" href="/admin/assets/css/fullcalendar/daygrid.min.css">
    <style>
       .fc-title{
            color: white;
        }
    </style>
@endsection

@section('brand')
<a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="./index.html">Dashboard</a>    
@endsection

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <h3 class="text-muted">Event</h3>
        <div id='calendar' class="text-dark"></div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade text-dark" id="modalEdit">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Event</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editForm" action="" method="post">
            <div class="modal-body">
                <input type="hidden" id="idEdit">
                <div class="row">                                   
                <div class="col-md-12">
                    <span class="event-title">Title event</span>
                    <h3 id="titleEvent"></h3>
                </div>
                <div class="col-md-12">
                  <hr>
                  <span class="event-title">Instructor event</span>
                  <div id="instructorEvent">
                    <ul></ul>
                  </div>
                </div>
                <div class="col-md-12">
                    <hr>
                    <span class="event-title">Desc event</span>
                    <p id="descEvent" class="text-dark"></p>
                </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>                    
            </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('script')
    <!--   Core   -->
  <script src="/admin/assets/js/plugins/jquery/dist/jquery.min.js"></script>
  <script src="/admin/assets/js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!--   Optional JS   -->
  <script src="/admin/assets/js/plugins/chart.js/dist/Chart.min.js"></script>
  <script src="/admin/assets/js/plugins/chart.js/dist/Chart.extension.js"></script>
  <!--   Argon JS   -->
  <script src="/admin/assets/js/argon-dashboard.min.js?v=1.1.0"></script>

  <script src="/admin/assets/js/plugins/fullcalendar/core.min.js"></script>
  <script src="/admin/assets/js/plugins/fullcalendar/daygrid.min.js"></script>
  <script src="/admin/assets/js/plugins/fullcalendar/interaction.min.js"></script>

  <script>
  let calendarEl = document.getElementById('calendar');

let calendar = new FullCalendar.Calendar(calendarEl, {
  plugins: [ 'dayGrid', 'interaction' ],
  defaultView: 'dayGridMonth',          
  eventLimit: true, // for all non-TimeGrid views
  views: {
        timeGrid: {
        eventLimit: 6 // adjust to 6 only for timeGridWeek/timeGridDay
        }
   },           
   events: '/student/event',
    eventClick: function(info) {
        $('#modalEdit').modal('show')
        // alert('Event: ' + info.event.id);                
        const id =  info.event.id
        $('#idEdit').val(id)         
        $.ajax({
            type: "GET",
            headers: {
            "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
            },                
            data: {id : id},
            url: "/student/event/"+id,
            dataType: "json",
            success: (data) => {                
              $('#titleEvent').text(data.event.title)                                                            
              $('#descEvent').text(data.event.desc)     
              $.each(data.instructor_name, function (index, val) {                        
                $('#instructorEvent ul').append('<li>'+val+'</li>')
              })
                                                                     
            }
        })       
    }
});            

calendar.render();
  </script>
@endpush