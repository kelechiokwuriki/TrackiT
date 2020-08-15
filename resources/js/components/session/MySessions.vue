<template>
    <div class="container">
        <div class="card shadow">

            <!-- Card Header -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <div>
                    <h6 class="m-0 font-weight-bold text-primary">My Sessions</h6>
                </div>
                <div>
                    <a href="/sessions/create" class="btn btn-success">Add a session</a>
                </div>
            </div>

            <!-- Card Body -->
            <div class="card-body">
                <div id="data-table_wrapper" class="dataTables_wrapper no-footer">
                    <table id="countryTable" class="table display table-hover text-center" style="width:100%">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Body Weight at session</th>
                                <th scope="col">Total Weight Lifted at Session</th>
                                <th scope="col">Exercises Performed</th>
                                <th scope="col" class="d-none d-sm-none d-md-block d-sm-block">Date</th>
                            </tr>
                        </thead>
                        <tbody class="sessions-table-data">
                            <tr v-for="(session, index) in sessions" v-bind:key="index" @click="navigateTo(session.slug)">
                                <td><a :href="'/sessions/'+ session.slug">{{session.name}}</a></td>
                                <td>{{session.body_weight}}</td>
                                <td>{{session.total_weight_lifted_at_session}} kg</td>
                                <td>{{session.exercises}}</td>
                                <td>{{ moment(session.created_at).format("MMM Do YYYY hh:mm a") }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            sessions: []
        }
    },
    created() {
        this.getSessions();
    },
    methods: {
        navigateTo(slug) {
            window.location = '/sessions/'+slug;
        },
        moment(date) {
            return moment(date);
        },
        getSessions() {
            axios.get('/api/mysessions').then(response => {
                console.log(response);
                this.sessions = response.data.data;
            })
            .catch(error => {})
            .finally(() => {
                $('#countryTable').DataTable({
                    // "aaSorting": [[2, "asc"]],
                    pageLength: 5,
                    lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'Everything']]
                });
            })
        }
    }
}
</script>

<style scoped>
    .sessions-table-data {
        cursor: pointer;
    }
</style>
