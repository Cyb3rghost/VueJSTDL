<template>
    <div class="container">
        <br/>
        <input type="text" class="form-control" @keyup="search" v-model="q" />


        <add-task @task-added="refresh"></add-task>
        <ul class="list-group">
            <li class="list-group-item"  v-for="task in tasks.data" :key="task.id">
                <a href="">{{ task.tache }}</a>  
                <button type="button" class="btn btn-danger float-right" @click="deleteTask(task.id)">
                Delete
                </button>      
                <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#editModal" @click="getTask(task.id)">
                Editez
                </button>
                <edit-task v-bind:taskToEdit="taskToEdit" @task-updated="refresh" @task-deleted="refresh"></edit-task>
            </li>
        </ul>
        <pagination :data="tasks" @pagination-change-page="getResults" class="mt-5"></pagination>
    </div>
</template>

<script>
    export default {

        data() {

            return {
                tasks: {},
                taskToEdit: '',
                q: ''
            }

        },

        created() { // APPEL AU NIVEAU DU SERVER SIDE

            axios.get('/tasksList')
                .then(response => this.tasks = response.data)
                .catch(error => console.log(error));

        },

        methods: {
            // Our method to GET results from a Laravel endpoint
            getResults(page = 1) {
                axios.get('/tasksList?page=' + page)
                    .then(response => {
                        this.tasks = response.data;
                    });
            },
            
            refresh(tasks) {
                this.tasks = tasks.data

            },

            getTask(id) {
                axios.get('/tasks/edit/' + id)
                .then(response => this.taskToEdit = response.data)
                .catch(error => console.log(error));
            },

            deleteTask(id) {
                axios.delete('/tasks/delete/' + id)
                .then(response => this.tasks = response.data) // .$emit crée un evenement personnalisé
                .catch(error => console.log(error))
            },

            search() {

                if(this.q.length >= 3)
                {

                    axios.get('/tasksList/' + this.q)
                    .then(response => this.tasks = response.data)
                    .catch(error => console.log(error));

                }
                else
                {

                    axios.get('/tasksList')
                    .then(response => this.tasks = response.data)
                    .catch(error => console.log(error));

                }


            }

        },

        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
