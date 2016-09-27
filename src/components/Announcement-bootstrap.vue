<template>
    <div v-for="announcement in announcements"
        v-if="show"
        transition="{{ announcement.transition }}"
        class="alert alert-{{ announcement.type }} alert-dismissible animated"
    >
        <button type="button" class="close" @click="show = false"><span aria-hidden="true">&times;</span></button>
        <strong>{{ announcement.title }}</strong> {{ announcement.message }}
        <a href="{{ announcement.url }}">{{ announcement.url }}</a>
    </div>
</template>

<script>
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
