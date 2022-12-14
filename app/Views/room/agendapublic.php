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
    })
</script>
<?= $this->endSection(); ?>