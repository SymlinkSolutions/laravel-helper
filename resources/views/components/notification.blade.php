@if ($message)
    <div class="alert alert-primary fade show custom-alert" role="alert" id="{{ $id }}">
        <span>{{ $message }}</span>
        <div class="progress-bar" id="progress-{{ $id }}"></div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const alertElement = document.getElementById('{{ $id }}');
            const progressBar = document.getElementById('progress-{{ $id }}');
            const displayDuration = 2000; // 3 seconds
            const fadeDuration = 150; // fade out duration

            // Progress bar animation
            progressBar.style.transition = `width ${displayDuration}ms linear`;
            progressBar.style.width = '0%';

            // Fade out and remove the alert after the duration
            setTimeout(function() {
                alertElement.classList.remove('show');
                alertElement.classList.add('fade');
                setTimeout(function() {
                    alertElement.remove();
                }, fadeDuration);
            }, displayDuration);
        });
    </script>
@endif

<style>
.custom-alert {
    position: fixed;
    bottom: 20px;
    right: 20px;
    min-width: 15%;
    padding: 10px;
    z-index: 1050; /* Higher than Bootstrap modal */
}

.custom-alert .btn-close {
    padding: 0;
}

.custom-alert .progress-bar {
    position: absolute;
    bottom: 0;
    left: 0;
    height: 5px;
    background-color: #007bff; /* Progress bar color */
    width: 100%;
    transform: scaleX(-1); /* Flip the progress bar horizontally */
}
</style>
