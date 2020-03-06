<script src="{{ mix('js/admin-master.js') }}"></script>
<script type="text/javascript">
    window.Laravel = <?php echo json_encode([
        'csrfToken' => csrf_token(),
    ]); ?>
</script>
@if(!auth()->guest())
    <script>
        window.Laravel.userId = <?php echo auth()->user()->id; ?>
    </script>
@endif
<script type="text/javascript">
    const app = new Vue({
        el: 'body'
    });

    var notifications = [];

    const NOTIFICATION_TYPES = {
        newMessage: 'App\\Notifications\\NewMessage'
    };

    $(document).ready(function() {
        // check if there's a logged in user
        if(Laravel.userId) {
            $.get('{{ route('user.notifications') }}', function (data) {
                addNotifications(data, "#notifications");
            });
        }
    });

    function addNotifications(newNotifications, target) {
        notifications = _.concat(notifications, newNotifications);
        // show only last 5 notifications
        notifications.slice(0, 5);
        showNotifications(notifications, target);
    }
    function showNotifications(notifications, target) {
        if(notifications.length) {
            var htmlElements = notifications.map(function (notification) {
                return makeNotification(notification);
            });
            $(target + 'Menu').html(htmlElements.join(''));
            $(target).addClass('has-notifications')
        } else {
            $(target + 'Menu').html('<li class="dropdown-header">No notifications</li>');
            $(target).removeClass('has-notifications');
        }
    }
    // Make a single notification string
    function makeNotification(notification) {
        var to = routeNotification(notification);
        var notificationText = makeNotificationText(notification);
        return '<li><a href="' + to + '">' + notificationText + '</a></li>';
    }

    // get the notification route based on it's type
    function routeNotification(notification) {
        var to = `?read=${notification.id}`;
         if(notification.type === NOTIFICATION_TYPES.newMessage) {
            const messageId = notification.data.message_id;
            to = `message/${messageId}` + to;
        }
        return '/' + to;
    }

    // get the notification text based on it's type
    function makeNotificationText(notification) {
        var text = '';
        if(notification.type === NOTIFICATION_TYPES.newMessage) {
            const subject = notification.data.subject;
            text += `<strong>${subject}</strong>`;
        }
        return text;
    }

</script>
@yield('scripts')