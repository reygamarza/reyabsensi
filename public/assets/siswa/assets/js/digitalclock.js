function clock(){
    var monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
    var dayNames = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];
    var today = new Date();
    document.getElementById('date').innerHTML = (dayNames[today.getDay()] + ", " + today.getDate() + ' ' + monthNames[today.getMonth()] + ' ' + today.getFullYear());

    var j = today.getHours();
    var m = today.getMinutes();
    var d = today.getSeconds();
    var day = j<11 ? 'AM' : 'PM';

    j = j<10? '0'+j: j;
    m = m<10? '0'+m: m;
    d = d<10? '0'+d: d;
    
    document.getElementById('jam').innerHTML = j;
    document.getElementById('menit').innerHTML = m;
    document.getElementById('detik').innerHTML = d;

} var inter = setInterval(clock, 400)