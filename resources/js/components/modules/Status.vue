<template>
    <div>

        <template v-if="status">
            <div class="alert alert-dismissible fade show text-center" :class="status.statusColor" role="alert">
                {{ status.message }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </template>

    </div>
</template>

<script>
export default {
    data() {
        return {
            status: null
        }
    },
    methods: {
        setStatusData(status) {
            this.status = status;
        }
    },
    created() {
        window.eventBus.$on('status', this.setStatusData)
    }
}
</script>
