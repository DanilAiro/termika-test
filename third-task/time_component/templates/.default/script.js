document.addEventListener('DOMContentLoaded', function() {
    const timeElement = document.querySelector('.current-time .time-display');
    if (!timeElement) return;

    const interval = parseInt(timeElement.closest('.current-time').dataset.interval) * 1000;
    const timeFormat = timeElement.closest('.current-time').dataset.format || 'H:i:s';
    
    function updateTime() {
        const date = new Date();
        let hours = date.getHours();
        let minutes = date.getMinutes();
        let seconds = date.getSeconds();
        
        let formattedTime = '';
        if (timeFormat === 'h:i:s A') {
            const ampm = hours >= 12 ? 'PM' : 'AM';
            hours = hours % 12 || 12;
            formattedTime = `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')} ${ampm}`;
        } else if (timeFormat === 'H:i') {
            formattedTime = `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}`;
        } else {
            formattedTime = `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
        }
        
        timeElement.textContent = formattedTime;
    }

    updateTime();
    setInterval(updateTime, interval);
});