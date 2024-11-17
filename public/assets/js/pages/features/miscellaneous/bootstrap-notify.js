"use strict";

// Class definition
var KTBootstrapNotifyDemo = function () {

    // Function to trigger a notification
    var showNotification = function (message, title = 'Notification Title', type = 'success') {
        // Notification content
        var content = {
            message: message,
            title: title,
            icon: 'icon flaticon2-bell', 
        };

        // Static notify configuration
        var notify = $.notify(content, {
            type: type, // Notification type
            allow_dismiss: true, // Allow dismiss
            newest_on_top: true, // Newest notification on top
            mouse_over: 'pause', // Pause on mouse hover
            showProgressbar: false, // Show progress bar
            spacing: 10, // Spacing between notifications
            timer: 2000, // Timer for auto-dismiss
            placement: {
                from: 'top', // Always from top
                align: 'right' // Always align right
            },
            offset: {
                x: 30, // Static offset X
                y: 30 // Static offset Y
            },
            delay: 2000, // Delay before dismissal
            z_index: 9999, // High z-index for visibility
            animate: {
                enter: 'animate__animated animate__fadeInRight', // Entry animation
                exit: 'animate__animated animate__fadeOutRight' // Exit animation
            }
        });

        // Optional: Progress bar update example
        setTimeout(function () {
            // notify.update('message', '<strong>Processing</strong> action.');
            // notify.update('type', 'primary');
            // notify.update('progress', 30);
        }, 1000);

        // setTimeout(function () {
        //     notify.update('message', '<strong>Completing</strong> action.');
        //     notify.update('type', 'success');
        //     notify.update('progress', 100);
        // }, 3000);
    };

    return {
        // Public function to expose the notification trigger
        notify: function (message, title, type) {
            showNotification(message, title, type);
        }
    };
}();

jQuery(document).ready(function () {
    // Initialize the notification system
    KTBootstrapNotifyDemo.init();

    // Example usage
    // You can call this function programmatically from anywhere
    KTBootstrapNotifyDemo.notify('This is a test notification!');
});
