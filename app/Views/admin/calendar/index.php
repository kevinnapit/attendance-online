<?php $this->extend('front/layout/main') ?>
<?php $this->section('content') ?>


<body>
    <div id='calendar'></div>
</body>


<?php $this->endSection() ?>

<?php $this->section('script') ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const calendarEl = document.getElementById('calendar')
        const calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth'
        })
        calendar.render()
    })
</script>
<?php $this->endSection() ?>