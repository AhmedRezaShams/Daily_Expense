// Auto-hide toast after 3 seconds
setTimeout(function() {
    let toasts = document.querySelectorAll('.toast .alert');
    toasts.forEach(function(toast) {
        toast.style.display = 'none';
    });
}, 3000); // 3000ms = 3 seconds
