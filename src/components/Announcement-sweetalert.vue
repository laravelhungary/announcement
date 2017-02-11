<template></template>

<script>
    export default {

        data: function () {
            return {
                announcement: {}
            };
        },

        created() {
            this.listen();
        },

        methods: {
            listen() {
                window.Echo
                .channel('public-announcement-channel')
                .listen('NewAnnouncement', (e) => {
                    this.announcement = e.data;

                    swal({
                        type: this.announcement.type,
                        title: this.announcement.message,
                        text: this.announcement.title,
                        allowOutsideClick: true,
                        showConfirmButton: true,
                        confirmButtonText: "Got it!",
                        timer: this.announcement.ttl
                    });
                });
            }
        },
    }
</script>
