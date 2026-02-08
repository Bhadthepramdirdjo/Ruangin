<!-- Custom Notification Modal -->
<div id="notificationModal" class="notification-modal" style="display: none;">
    <div class="notification-overlay"></div>
    <div class="notification-container">
        <div class="notification-content">
            <div class="notification-icon">
                <span id="notificationIcon">ℹ️</span>
            </div>
            <div class="notification-message">
                <h3 id="notificationTitle">Pemberitahuan</h3>
                <p id="notificationText"></p>
            </div>
            <button class="notification-close" onclick="hideNotification()">
                <span>✕</span>
            </button>
        </div>
        <div class="notification-actions">
            <button class="notification-btn notification-btn-primary" onclick="closeNotification()">
                OK
            </button>
        </div>
    </div>
</div>

<style>
    /* Notification Modal Styles */
    .notification-modal {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 9999;
        display: flex;
        align-items: center;
        justify-content: center;
        animation: fadeIn 0.3s ease-out;
    }

    .notification-modal.show {
        display: flex;
    }

    .notification-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(4px);
    }

    .notification-container {
        position: relative;
        z-index: 10000;
        background: linear-gradient(135deg, rgba(15, 23, 42, 0.95) 0%, rgba(30, 41, 59, 0.95) 100%);
        border: 1px solid rgba(148, 163, 184, 0.3);
        border-radius: 16px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.6),
                    0 0 40px rgba(99, 102, 241, 0.2);
        max-width: 450px;
        width: 90%;
        overflow: hidden;
        animation: slideUp 0.3s ease-out;
    }

    .notification-content {
        padding: 2rem 1.5rem;
        display: flex;
        gap: 1.5rem;
        align-items: flex-start;
    }

    .notification-icon {
        flex-shrink: 0;
        font-size: 2.5rem;
        line-height: 1;
        animation: bounce 0.5s ease-out;
    }

    .notification-message {
        flex: 1;
        min-width: 0;
    }

    .notification-message h3 {
        color: #e5e7eb;
        font-size: 1.1rem;
        font-weight: 600;
        margin: 0 0 0.5rem 0;
        text-transform: capitalize;
    }

    .notification-message p {
        color: #cbd5e1;
        font-size: 0.95rem;
        line-height: 1.5;
        margin: 0;
    }

    .notification-close {
        flex-shrink: 0;
        background: transparent;
        border: none;
        color: #94a3b8;
        font-size: 1.5rem;
        cursor: pointer;
        padding: 0;
        width: 2rem;
        height: 2rem;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        transition: all 0.2s ease;
    }

    .notification-close:hover {
        background: rgba(148, 163, 184, 0.1);
        color: #e2e8f0;
    }

    .notification-actions {
        display: flex;
        gap: 0.75rem;
        padding: 0 1.5rem 1.5rem;
        justify-content: flex-end;
    }

    .notification-btn {
        padding: 0.75rem 1.5rem;
        border: none;
        border-radius: 10px;
        font-size: 0.95rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
        min-width: 100px;
    }

    .notification-btn-primary {
        background: linear-gradient(135deg, #6366f1 0%, #0ea5e9 100%);
        color: white;
        box-shadow: 0 4px 15px rgba(99, 102, 241, 0.4);
    }

    .notification-btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(99, 102, 241, 0.6);
    }

    .notification-btn-primary:active {
        transform: translateY(0);
    }

    .notification-btn-secondary {
        background: rgba(148, 163, 184, 0.2);
        color: #cbd5f5;
        border: 1px solid rgba(148, 163, 184, 0.3);
    }

    .notification-btn-secondary:hover {
        background: rgba(148, 163, 184, 0.3);
        border-color: rgba(148, 163, 184, 0.5);
    }

    /* Animations */
    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    @keyframes slideUp {
        from {
            transform: translateY(30px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    @keyframes bounce {
        0%, 100% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.1);
        }
    }

    /* Type-specific styling */
    .notification-modal.type-success .notification-content {
        border-left: 4px solid #10b981;
    }

    .notification-modal.type-success .notification-icon {
        color: #10b981;
    }

    .notification-modal.type-error .notification-content {
        border-left: 4px solid #ef4444;
    }

    .notification-modal.type-error .notification-icon {
        color: #ef4444;
    }

    .notification-modal.type-warning .notification-content {
        border-left: 4px solid #f59e0b;
    }

    .notification-modal.type-warning .notification-icon {
        color: #f59e0b;
    }

    .notification-modal.type-info .notification-content {
        border-left: 4px solid #0ea5e9;
    }

    .notification-modal.type-info .notification-icon {
        color: #0ea5e9;
    }

    /* Responsive */
    @media (max-width: 640px) {
        .notification-container {
            max-width: 95%;
        }

        .notification-content {
            padding: 1.5rem 1rem;
            gap: 1rem;
        }

        .notification-message h3 {
            font-size: 1rem;
        }

        .notification-message p {
            font-size: 0.9rem;
        }

        .notification-actions {
            padding: 0 1rem 1rem;
        }
    }
</style>

<script>
    /**
     * Show custom notification
     * @param {string} message - Notification message
     * @param {string} type - Type: 'success', 'error', 'warning', 'info' (default)
     * @param {string} title - Custom title (optional)
     * @param {number} timeout - Auto close timeout in ms (0 = no auto close, default 5000 for info)
     */
    function showNotification(message, type = 'info', title = null, timeout = null) {
        const modal = document.getElementById('notificationModal');
        const messageEl = document.getElementById('notificationText');
        const titleEl = document.getElementById('notificationTitle');
        const iconEl = document.getElementById('notificationIcon');

        // Set content
        messageEl.textContent = message;
        
        // Set title
        if (title) {
            titleEl.textContent = title;
        } else {
            titleEl.textContent = type.charAt(0).toUpperCase() + type.slice(1);
        }

        // Remove all type classes
        modal.classList.remove('type-success', 'type-error', 'type-warning', 'type-info');
        
        // Add type class
        modal.classList.add(`type-${type}`);

        // Set icon based on type
        const icons = {
            success: '✓',
            error: '✕',
            warning: '⚠',
            info: 'ℹ'
        };
        iconEl.textContent = icons[type] || '●';

        // Show modal
        modal.classList.add('show');
        modal.style.display = 'flex';

        // Auto close if timeout is set
        if (timeout === null) {
            timeout = type === 'info' ? 5000 : 0;
        }

        if (timeout > 0) {
            setTimeout(() => {
                closeNotification();
            }, timeout);
        }
    }

    /**
     * Close notification (with callback)
     */
    function closeNotification() {
        hideNotification();
        
        // Execute callback if set
        if (window.notificationCallback) {
            const callback = window.notificationCallback;
            window.notificationCallback = null;
            callback();
        }
    }

    /**
     * Hide notification
     */
    function hideNotification() {
        const modal = document.getElementById('notificationModal');
        modal.classList.remove('show');
        modal.style.display = 'none';
    }

    /**
     * Replace browser alert with custom notification
     */
    window.alert = function(message) {
        showNotification(message, 'info', 'Pemberitahuan', 0);
    };

    /**
     * Show success notification
     */
    function showSuccess(message, title = 'Berhasil', timeout = 3000) {
        showNotification(message, 'success', title, timeout);
    }

    /**
     * Show error notification
     */
    function showError(message, title = 'Kesalahan', timeout = 0) {
        showNotification(message, 'error', title, timeout);
    }

    /**
     * Show warning notification
     */
    function showWarning(message, title = 'Peringatan', timeout = 0) {
        showNotification(message, 'warning', title, timeout);
    }

    /**
     * Show info notification
     */
    function showInfo(message, title = 'Informasi', timeout = 5000) {
        showNotification(message, 'info', title, timeout);
    }
</script>
