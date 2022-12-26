<?= $this->extend('layout/main'); ?>
<!-- Main Content -->
<?= $this->section('content'); ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><?= $title; ?></h1>
        </div>


        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="fc-overflow">
                                <div id="myEvent"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script type="text/javascript">
    "use strict";
    var events = <?php echo json_encode($data) ?>;

    var date = new Date()
    var d = date.getDate(),
        m = date.getMonth(),
        y = date.getFullYear()

    $('#myEvent').fullCalendar({
        // load plugins
        height: 'auto',
        plugins: ['interaction', 'dayGrid', 'timeGrid', 'list', 'googleCalendar', 'momentTimezonePlugin', 'momentPlugin'],
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay,listMonth'
        },
        buttonText: {
            today: 'Hari ini',
            month: 'Bulan',
            week: 'Minggu',
            day: 'Hari',
            listMonth: 'Agenda',
        },
        selectable: true,
        selectHelper: true,
        buttonIcons: true,
        navLinks: true,
        eventLimit: false,
        locale: 'id',
        timeZone: 'local',
        timeFormat: 'H:mm',
        editable: false,
        events: events,
        eventClick: function(calEvent, jsEvent, view) {
            var split = calEvent.title.split(" | ");

            var date = $.fullCalendar.formatDate(calEvent.start, 'dddd, D/M/Y');
            var start = $.fullCalendar.formatDate(calEvent.start, 'HH:mm');
            var end = $.fullCalendar.formatDate(calEvent.end, 'HH:mm');

            function js_thml() {
                let tbl = "";
                tbl += '<table class="table table-sm">';
                tbl += '  <tbody>';
                tbl += '\t<tr>';
                tbl += '\t  <th scope="row">Tanggal</th>';
                tbl += '\t  <td>:</td>';
                tbl += '\t  <td style="text-align:left">' + date + ', Pukul : ' + start + ' - ' + end + '</td>';
                tbl += '\t</tr>';
                tbl += '\t<tr>';
                tbl += '\t  <th scope="row">Ruang</th>';
                tbl += '\t  <td>:</td>';
                tbl += '\t  <td style="text-align:left">' + split[1] + '</td>';
                tbl += '\t</tr>';
                tbl += '\t<tr>';
                tbl += '\t  <th scope="row">PIC</th>';
                tbl += '\t  <td>:</td>';
                tbl += '\t  <td style="text-align:left">' + calEvent.pic + '</td>';
                tbl += '\t</tr>';
                tbl += '\t<tr>';
                tbl += '\t  <th scope="row">No. Handphone</th>';
                tbl += '\t  <td>:</td>';
                tbl += '\t  <td style="text-align:left"><a href="https://wa.me/62' + calEvent.phone + '">' + calEvent.phone + '</a></td>';
                tbl += '\t</tr>';
                tbl += '\t<tr>';
                if (calEvent.acara != "") {
                    tbl += '\t  <th scope="row">Acara</th>';
                    tbl += '\t  <td>:</td>';
                    tbl += '\t  <td style="text-align:left">' + calEvent.acara + '</td>';
                    tbl += '\t</tr>';
                };
                tbl += '\t<tr>';
                tbl += '\t  <th scope="row">Jumlah Peserta</th>';
                tbl += '\t  <td>:</td>';
                tbl += '\t  <td style="text-align:left">' + calEvent.peserta + ' Peserta</td>';
                tbl += '\t</tr>';
                tbl += '\t<tr>';
                tbl += '\t  <th scope="row"></th>';
                tbl += '\t</tr>';
                tbl += '\t<tr>';

                if (calEvent.motor.split(" ")[1] != "") {
                    tbl += '\t  <th scope="row">Parkir Motor</th>';
                    tbl += '\t  <td>:</td>';
                    tbl += '\t  <td style="text-align:left">' + calEvent.motor + ' Motor</td>';
                    tbl += '\t</tr>';
                };
                if (calEvent.mobil.split(" ")[1] != "") {
                    tbl += '\t<tr>';
                    tbl += '\t  <th scope="row">Parkir Mobil</th>';
                    tbl += '\t  <td>:</td>';
                    tbl += '\t  <td style="text-align:left">' + calEvent.mobil + ' Mobil</td>';
                    tbl += '\t</tr>';
                };
                if (calEvent.ket != "") {
                    tbl += '\t<tr>';
                    tbl += '\t  <th scope="row">Deskripsi</th>';
                    tbl += '\t  <td>:</td>';
                    tbl += '\t  <td style="text-align:left">' + calEvent.ket + '</td>';
                    tbl += '\t</tr>';
                };
                if (calEvent.proposal != "") {
                    tbl += '\t<tr>';
                    tbl += '\t  <th scope="row">Surat</th>';
                    tbl += '\t  <td>:</td>';
                    tbl += '\t  <td style="text-align:left"><a class="btn btn-info btn-xs" href="' + window.location.origin + '/sifilsafat/public/files/proposal/' + calEvent.proposal + '"><i class="fa fa-eye"></i> Lihat</a></td>';
                    tbl += '\t</tr>';
                };
                tbl += '  </tbody>';
                tbl += '</table>';
                return tbl;
            }
            Swal.fire({
                title: split[0],
                html: js_thml(),
                showConfirmButton: false,
                //   confirmButtonColor: '#3085d6',
                showCloseButton: true,
                type: "info",
                themeSystem: 'bootstrap4',
                customClass: 'swal-wide',
                width: '850px'
            });

        },
    })
</script>
<?= $this->endSection(); ?>