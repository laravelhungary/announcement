<template>
    <div v-if="show" :transition="transitionName" class="alert alert-{{ announcement.type }}">
        <button type="button" class="close" @click="show = false">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>{{ announcement.title }}</strong> {{ announcement.message }}
    </div>
</template>

<style>
     .fade-transition {
        transition: all .3s ease;
        height: auto;
    }
    .fade-enter,
    .fade-leave {
        height: 0;
        padding: 0 10px;
        opacity: 0;
    }
</style>

<script>
    export default {
        data() {
            return {
                announcement: {},
                transitionName: '',
                show: false
            };
        },

        ready() {
            this.listen();
        },

        methods: {
            listen() {
                window.Echo
                .channel('public-announcement-channel')
                .listen('NewAnnouncement', (response) => {

                    this.announcement = response.data;

                    this.transitionName = response.data.transition;

                    this.show = true;

                    setTimeout(
                        () =>this.show = false,
                        response.data.ttl
                    );
                });
            }
        },
    }
</script>
