<template>
    <transition :name="transitionName">
        <div v-if="show" class="alert alert-{{ announcement.type }}">
            <button type="button" class="close" @click="show = false">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong>{{ announcement.title }}</strong> {{ announcement.message }}
        </div>
    </transition>
</template>

<style scoped>
    .fade-enter-active, .fade-leave-active {
      transition: all .3s ease;
      height: auto;
    }
    .fade-enter,
    .fade-leave-active {
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
                transitionName: 'fade',
                show: false
            };
        },

        created() {
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
