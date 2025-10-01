function pad(num) {
    return num.toString().padStart(2, '0');
}

function updateClock() {
    const now = new Date();
    const hours = pad(now.getHours());
    const minutes = pad(now.getMinutes());
    const seconds = pad(now.getSeconds());
    const day = pad(now.getDate());
    const month = pad(now.getMonth() + 1);
    const year = now.getFullYear();

    const timeString = `${hours}:${minutes}:${seconds}`;
    const dateString = `${day}/${month}/${year}`;

    const clock = document.getElementById('hora');
    const date = document.getElementById('fecha');

    if (clock && date) {
        clock.textContent = timeString;
        date.textContent = dateString;

        // Animation: toggle 'active' class for border effect
        clock.classList.toggle('active');
    }
}

// Initial call and interval
window.onload = function() {
    updateClock();
    setInterval(updateClock, 1000);
};