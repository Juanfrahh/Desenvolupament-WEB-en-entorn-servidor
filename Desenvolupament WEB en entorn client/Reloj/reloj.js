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

    const timeStr = `${hours}:${minutes}:${seconds}`;
    const dateStr = `${day}/${month}/${year}`;

    const clock = document.getElementById('clock');
    const frame = document.getElementById('frame');
    if (clock) clock.textContent = `${dateStr} ${timeStr}`;

    // Simple animation: toggle frame class every second
    if (frame) {
        frame.classList.toggle('animate');
    }
}

window.onload = function() {
    updateClock();
    setInterval(updateClock, 1000);
};