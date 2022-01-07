document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    $("#loader").css("display", "none");
    $("#myDiv").css("display", "block");
    var calendar = new FullCalendar.Calendar(calendarEl, {
        locale: 'he',
        plugins: ['dayGrid', 'interaction'],
        eventSources: ["http://mytiferet.com/pages/event/eventos.php",
            "https://www.hebcal.com/hebcal?cfg=fc&v=1&i=off&maj=on&min=on&nx=on&mf=on&ss=on&mod=on&lg=s&s=on",
        ],
        color: "#FF0F0",
        textColor: "#FFFFFF",
        header: {
            left: 'title',
            right: 'prev,next today',
        },
        //timezone: Asia/Jerusalem,
        eventClick: function(info) {

            options = { weekday: 'short', month: 'large', day: 'numeric' };
            datetime = new Date(info.event.start);
            day = (datetime.getDate() < 10) ? "0" + datetime.getDate() : datetime.getDate();
            month = ((datetime.getMonth() + 1) < 10) ? "0" + (datetime.getMonth() + 1) : datetime.getMonth() + 1; //month: 0-11
            year = datetime.getFullYear();
            date = day + "/" + month + "/" + year;
            hours = (datetime.getHours() < 10) ? "0" + datetime.getHours() : datetime.getHours();
            minutes = (datetime.getMinutes() < 10) ? "0" + datetime.getMinutes() : datetime.getMinutes();
            time = hours + ":" + minutes;
            $('#titulo').html(info.event.title);
            $('#fecha').html("Fecha: " + date + " - Hora: " + time + " hrs");
            if (info.event.extendedProps.img === null) {
                $('#cimg').hide();
            } else {
                $('#cimg').show();
                $('#imagen').attr("src", info.event.extendedProps.img);
            }
            if (info.event.extendedProps.audio === null) {
                $('#caudio').hide();
            } else {
                $('#caudio').show();
                $('#audio').attr("src", info.event.extendedProps.audio);
            }

            if (info.event.extendedProps.img) {
                $('#evento').modal();
                $('#boton').click(function() {

                    if ($('#boton').val() === "pausa") {
                        $('#icono').html("play_arrow")
                        $('#boton').val("play");
                        document.getElementById('audio').pause();
                    } else {
                        $('#icono').html("pause")
                        $('#boton').val("pausa");
                        document.getElementById('audio').play();
                    }
                })
            }



        },
    });

    calendar.setOption('locale', 'He');

    calendar.render();

})