document.addEventListener('DOMContentLoaded', function() {
    window.addEventListener('beforeunload', function(){
        document.getElementById('spinner-overlay').style.display = 'flex';
    });

    window.addEventListener('load', function(){
        document.getElementById('spinner-overlay').style.display = 'none';
    });
});