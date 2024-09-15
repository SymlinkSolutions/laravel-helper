document.addEventListener('DOMContentLoaded', function() {
    window.addEventListener('beforeunload', function() {
        document.getElementById('spinner-overlay').style.display = 'flex';
    });

    window.addEventListener('load', function() {
        document.getElementById('spinner-overlay').style.display = 'none';
    });

    function checkLoadingStatus() {
        if (document.readyState === 'complete') {
            document.getElementById('spinner-overlay').style.display = 'none';
            clearInterval(loadingCheckInterval);
        }
    }

    var loadingCheckInterval = setInterval(checkLoadingStatus, 1000);
});
