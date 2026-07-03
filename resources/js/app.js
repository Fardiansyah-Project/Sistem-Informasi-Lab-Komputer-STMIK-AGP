// Sidebar Toggle and Mobile Handling
document.addEventListener('DOMContentLoaded', () => {
    const sidebarToggle = document.getElementById('sidebar-toggle');
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebar-overlay');

    if (sidebarToggle && sidebar && overlay) {
        sidebarToggle.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        });

        overlay.addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        });
    }

    // Auto-dismiss Flash Success messages
    const flashSuccess = document.getElementById('flash-success');
    if (flashSuccess) {
        setTimeout(() => {
            flashSuccess.classList.add('opacity-0', 'transition-opacity', 'duration-500');
            setTimeout(() => flashSuccess.remove(), 500);
        }, 4000);
    }
});
