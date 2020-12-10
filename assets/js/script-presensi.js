const flashData = $('.flash-data').data('flashdata');

$('.tombol-hadir').on('click', function (e) {
    e.preventDefault();
    const href = $(this).attr('href');

    Swal.fire({
        title: 'Apakah anda yakin',
        text: "peserta tersebut hadir?",
        icon: 'warning',
        showCancelButton: true,
        cancelButtonColor: '#d33',
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Ya, peserta hadir'
    }).then((result) => {
        if (result.value) {
            document.location.href = href;
        }
    })
});