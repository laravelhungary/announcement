<template>
    <div v-if="show"
        transition="fade"
        v-for="announcement in announcements"
        class="alert alert-{{ announcement.type }} alert-dismissible animated">
        <button type="button" class="close" @click="show = false"><span aria-hidden="true">&times;</span></button>
        <strong>{{ announcement.title }}</strong> {{ announcement.message }}
        <a href="{{ announcement.url }}">{{ announcement.url }}</a>
    </div>
</template>

<script>
    Vue.transition('fade', {
        enterClass: 'fadeInDown',
        leaveClass: 'fadeOutUp'
    });

    export default {
        data() {
            return {
                announcements: {},
                show: true
            };
        },

        ready() {
            this.listen();
        },

        methods: {
            listen() {
                window.Echo.channel('public-announcement-channel')
                .listen('NewAnnouncement', (response) => {
                    this.announcements = response;
                    this.show = true;

                    setTimeout(
                        () =>this.show = false,
                        response.ttl
                    );
                });
            }
        },
    }
</script>
